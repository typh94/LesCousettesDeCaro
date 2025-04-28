import asyncio
from playwright.async_api import async_playwright
import json

user_agent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36"


async def scrape_pins(query):
    search_url = f"https://www.pinterest.com/search/pins/?q={query}&rs=typed"
    scraped_data = []

    async with async_playwright() as p:
        browser = await p.chromium.launch()
        page = await browser.new_page(user_agent=user_agent)
        response = await page.goto(search_url)
        await asyncio.sleep(2)

        try:
            # Scroll and scrape multiple pages
            for _ in range(5):  # Adjust the range for more or fewer pages
                # Find the pins on the current view
                pins = await page.query_selector_all("div[data-test-id='pinWrapper']")

                for pin in pins:
                    title_link = await pin.query_selector("a")
                    pin_url = await title_link.get_attribute("href")
                    title = await title_link.get_attribute("aria-label")
                    img = await title_link.query_selector("img")
                    img_src = await img.get_attribute("src")

                    extracted_data = {
                        "title": title,
                        "url": pin_url,
                        "img": img_src
                    }

                    # Avoid duplicates
                    if extracted_data not in scraped_data:
                        scraped_data.append(extracted_data)

                # Scroll down to load more pins
                await page.evaluate("window.scrollBy(0, document.body.scrollHeight)")
                await asyncio.sleep(2)  # Wait for new content to load

        except Exception as e:
            print(f"Failed to scrape pins at {search_url}: {e}")
        finally:
            await browser.close()

    # Everything has finished, return our scraped data
    return scraped_data

async def main():
    search_query = "clothes"
    office_results = await scrape_pins(search_query)

    with open(f"{search_query}-results.json", "w") as file:
        try:
            json.dump(office_results, file, indent=4)
        except Exception as e:
            print(f"Failed to save results: {e}")

if __name__ == "__main__":
    asyncio.run(main())