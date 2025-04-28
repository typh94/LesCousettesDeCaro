import asyncio
from playwright.async_api import async_playwright
import json
import matplotlib.pyplot as plt
from collections import Counter
async def scrape_pinterest(query):
    url = f"https://www.pinterest.com/search/pins/?q={query}&rs=typed"
    results = []
    async with async_playwright() as p:
        browser = await p.chromium.launch(headless=True)
        page = await browser.new_page()
        await page.goto(url)

        # Scroll and load more pins
        for _ in range(5):  # Adjust the range for more scrolling (e.g., 5 scrolls)
            await page.evaluate("window.scrollTo(0, document.body.scrollHeight)")
            await asyncio.sleep(2)  # Wait for new pins to load

        # Scrape pins
        pins = await page.query_selector_all("div[data-test-id='pinWrapper']")
        for pin in pins:
            title_element = await pin.query_selector("a")
            title = await title_element.get_attribute("aria-label") if title_element else "No title"
            pin_url = await title_element.get_attribute("href") if title_element else "No URL"
            image_element = await pin.query_selector("img")
            image_url = await image_element.get_attribute("src") if image_element else "No image"
            results.append({"title": title, "url": pin_url, "image": image_url})
        await browser.close()
    return results
async def scrape_trending_posts():
    url = "https://www.pinterest.com/trending/"
    results = []
    async with async_playwright() as p:
        browser = await p.chromium.launch(headless=True)
        page = await browser.new_page()
        await page.goto(url)
        await asyncio.sleep(2)
        posts = await page.query_selector_all("div[data-test-id='pinWrapper']")  # Adjust selector if needed
        for post in posts:
            title_element = await post.query_selector("a")
            title = await title_element.get_attribute("aria-label") if title_element else "No title"
            post_url = await title_element.get_attribute("href") if title_element else "No URL"
            image_element = await post.query_selector("img")
            image_url = await image_element.get_attribute("src") if image_element else "No image"
            results.append({"title": title, "url": post_url, "image": image_url})
        await browser.close()
    return results

async def main():
    # Scrape trending posts
    data = await scrape_trending_posts()
    with open("trending_posts.json", "w") as file:
        json.dump(data, file, indent=4)

    # Load the saved JSON data
    with open("trending_posts.json", "r") as file:
        data = json.load(file)

    # Debug: Print the titles to verify the data
    print("Scraped Titles:")
    for post in data:
        print(post["title"])

    # Analyze the data: Count occurrences of keywords in titles
    keywords = [    "floral dress", "linen pants", "knitwear", "wool coat", "spring outfit", "fall jacket",
        "summer dress", "sweater", "trendy outfit", "casual wear", "fashion trends", "stylish clothes",
        "vintage style", "bohemian dress", "chic outfit", "street style", "fashionable attire", "elegant dress",
       "accessories", "fashion accessories", "trendy shoes", "designer bags", "luxury fashion",]
    title_counts = Counter()
    for post in data:
        title = post["title"].lower() if post["title"] else ""
        for keyword in keywords:
            if keyword in title:
                title_counts[keyword] += 1

    # Check if any keywords were found
    if not title_counts:
        print("No matching keywords found in the titles.")
        return

    # Create a bar chart
    plt.figure(figsize=(10, 6))
    plt.bar(title_counts.keys(), title_counts.values(), color="skyblue")
    plt.title("Keyword Frequency in Trending Posts", fontsize=16)
    plt.xlabel("Keywords", fontsize=12)
    plt.ylabel("Frequency", fontsize=12)
    plt.grid(axis="y", linestyle="--", alpha=0.7)
    plt.tight_layout()

    # Save the graph as an image
    plt.savefig("trending_keyword_frequency.png")
    plt.show()

if __name__ == "__main__":
    asyncio.run(main())
