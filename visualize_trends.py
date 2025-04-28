import json
import re
from collections import Counter
import matplotlib.pyplot as plt
import pandas as pd
import seaborn as sns
import matplotlib.gridspec as gridspec
import os
import sys
import ssl

def fix_ssl_certificate():
    """
    Fix SSL certificate verification issues on macOS
    """
    # Try unverified context for NLTK downloads if needed
    try:
        _create_unverified_https_context = ssl._create_unverified_context
    except AttributeError:
        pass
    else:
        ssl._create_default_https_context = _create_unverified_https_context
    
    # For macOS, check for the certificate file
    if sys.platform == 'darwin':
        print("Detected macOS, checking SSL certificates...")
        cert_paths = [
            '/Applications/Python 3.x/Install Certificates.command',
            '/Applications/Python 3.x/Python Launcher.app/Contents/MacOS/Python',
            '/Applications/XAMPP/xamppfiles/htdocs/LesCousettesDeCaro/cert.pem'
        ]
        for path in cert_paths:
            if os.path.exists(path.replace('3.x', '3.' + str(sys.version_info.minor))):
                print(f"Found certificate path: {path}")
                print("Consider running the 'Install Certificates.command' script in your Python installation folder")

try:
    # Try fixing SSL issues first
    fix_ssl_certificate()
    
    # Now try to import and download NLTK resources
    try:
        import nltk
        
        # Create NLTK data directory if it doesn't exist
        nltk_data_dir = os.path.expanduser('~/nltk_data')
        os.makedirs(nltk_data_dir, exist_ok=True)
        
        # Try to download with SSL verification disabled
        try:
            print("Attempting to download NLTK resources...")
            nltk.download('stopwords', quiet=False)
            nltk.download('punkt', quiet=False)
            from nltk.corpus import stopwords
            from nltk.tokenize import word_tokenize
            print("Successfully downloaded NLTK resources")
            NLTK_AVAILABLE = True
        except Exception as e:
            print(f"Failed to download NLTK resources: {e}")
            print("Continuing without NLTK - using manual stopwords list")
            NLTK_AVAILABLE = False
    except ImportError:
        print("NLTK not installed. Continuing with basic functionality.")
        NLTK_AVAILABLE = False
except Exception as e:
    print(f"SSL Certificate fix failed: {e}")
    NLTK_AVAILABLE = False

# Fallback stopwords if NLTK fails
FALLBACK_STOPWORDS = {
    'i', 'me', 'my', 'myself', 'we', 'our', 'ours', 'ourselves', 'you', 'your', 'yours',
    'yourself', 'yourselves', 'he', 'him', 'his', 'himself', 'she', 'her', 'hers',
    'herself', 'it', 'its', 'itself', 'they', 'them', 'their', 'theirs', 'themselves',
    'what', 'which', 'who', 'whom', 'this', 'that', 'these', 'those', 'am', 'is', 'are',
    'was', 'were', 'be', 'been', 'being', 'have', 'has', 'had', 'having', 'do', 'does',
    'did', 'doing', 'a', 'an', 'the', 'and', 'but', 'if', 'or', 'because', 'as', 'until',
    'while', 'of', 'at', 'by', 'for', 'with', 'about', 'against', 'between', 'into',
    'through', 'during', 'before', 'after', 'above', 'below', 'to', 'from', 'up', 'down',
    'in', 'out', 'on', 'off', 'over', 'under', 'again', 'further', 'then', 'once', 'here',
    'there', 'when', 'where', 'why', 'how', 'all', 'any', 'both', 'each', 'few', 'more',
    'most', 'other', 'some', 'such', 'no', 'nor', 'not', 'only', 'own', 'same', 'so',
    'than', 'too', 'very', 's', 't', 'can', 'will', 'just', 'don', 'should', 'now'
}

# Pinterest-specific additions to stopwords
PINTEREST_STOPWORDS = {
    'pin', 'pinterest', 'image', 'photo', 'picture', 'pic', 'like', 'saved', 'from', 'upload',
    'board', 'jpg', 'png', 'posted', 'uploaded', 'jpeg', 'user', 'profile'
}

try:
    from wordcloud import WordCloud
    WORDCLOUD_AVAILABLE = True
except ImportError:
    print("WordCloud not installed. Skipping word cloud visualization.")
    WORDCLOUD_AVAILABLE = False

def load_pinterest_data(filename):
    """Load the Pinterest data from the JSON file"""
    with open(filename, 'r') as file:
        data = json.load(file)
    return data

def clean_text(text):
    """Clean text by removing special characters and converting to lowercase"""
    if not text:
        return ""
    text = re.sub(r'[^\w\s]', ' ', text.lower())
    return text

def simple_tokenize(text):
    """Simple tokenization function as fallback if NLTK isn't available"""
    return [word.strip() for word in text.split() if word.strip()]

def analyze_titles(data):
    """Analyze titles and extract insights"""
    # Extract titles
    titles = [item.get('title', '') for item in data if item.get('title')]
    
    # Clean titles
    clean_titles = [clean_text(title) for title in titles]
    
    # Get stopwords list - either from NLTK or our fallback
    if NLTK_AVAILABLE:
        stop_words = set(stopwords.words('english'))
        tokenize_function = word_tokenize
    else:
        stop_words = FALLBACK_STOPWORDS
        tokenize_function = simple_tokenize
    
    # Add Pinterest-specific stopwords
    stop_words.update(PINTEREST_STOPWORDS)
    
    all_words = []
    for title in clean_titles:
        words = tokenize_function(title)
        # Keep only alphabetic words that aren't stopwords and are at least 3 chars long
        filtered_words = [word for word in words if word.isalpha() and word not in stop_words and len(word) >= 3]
        all_words.extend(filtered_words)
    
    # Count word frequencies
    word_counts = Counter(all_words)
    
    # Extract clothing types, colors, and styles
    clothing_types = ['dress', 'shirt', 'pants', 'jeans', 'skirt', 'sweater', 'jacket', 
                      'coat', 'shorts', 'tshirt', 'blouse', 'hoodie', 'suit', 'top', 
                      'leggings', 'jumpsuit', 'cardigan', 'blazer', 'vest', 'romper']
    
    colors = ['black', 'white', 'red', 'blue', 'green', 'yellow', 'purple', 'pink', 
              'orange', 'brown', 'gray', 'grey', 'beige', 'navy', 'cream', 'ivory',
              'maroon', 'teal', 'mint', 'olive', 'burgundy', 'mustard', 'gold', 'silver']
    
    styles = ['casual', 'formal', 'vintage', 'modern', 'elegant', 'chic', 'bohemian', 
              'minimalist', 'streetwear', 'classic', 'trendy', 'athleisure', 'retro',
              'preppy', 'punk', 'grunge', 'hipster', 'urban', 'sporty', 'business',
              'summer', 'winter', 'spring', 'fall', 'autumn', 'holiday', 'party', 'office']
    
    clothing_counts = {item: all_words.count(item) for item in clothing_types if all_words.count(item) > 0}
    color_counts = {item: all_words.count(item) for item in colors if all_words.count(item) > 0}
    style_counts = {item: all_words.count(item) for item in styles if all_words.count(item) > 0}
    
    return {
        'word_counts': word_counts,
        'clothing_counts': clothing_counts,
        'color_counts': color_counts,
        'style_counts': style_counts,
        'clean_titles': clean_titles,
        'title_count': len(titles)
    }

def visualize_trends(analysis_results, search_query):
    """Create visualizations based on analysis results"""
    plt.figure(figsize=(20, 16))
    gs = gridspec.GridSpec(3, 2, height_ratios=[1, 1, 1.5])
    
    # 1. Word Cloud (if available)
    ax1 = plt.subplot(gs[0, 0])
    if WORDCLOUD_AVAILABLE and analysis_results['word_counts']:
        wordcloud = WordCloud(width=800, height=400, background_color='white', max_words=100).generate_from_frequencies(analysis_results['word_counts'])
        plt.imshow(wordcloud, interpolation='bilinear')
        plt.axis('off')
        plt.title(f'Most Common Words in "{search_query}" Pin Titles', fontsize=16)
    else:
        plt.text(0.5, 0.5, 'WordCloud visualization not available', 
                 horizontalalignment='center', fontsize=12, transform=ax1.transAxes)
        plt.axis('off')
        plt.title(f'Most Common Words in "{search_query}" Pin Titles', fontsize=16)
    
    # 2. Top 15 Words Bar Chart
    ax2 = plt.subplot(gs[0, 1])
    most_common = analysis_results['word_counts'].most_common(15)
    if most_common:
        words, counts = zip(*most_common)
        sns.barplot(x=list(counts), y=list(words), palette='viridis', ax=ax2)
        ax2.set_title(f'Top 15 Words in "{search_query}" Pin Titles', fontsize=16)
        ax2.set_xlabel('Frequency')
    else:
        plt.text(0.5, 0.5, 'No common words found', 
                 horizontalalignment='center', fontsize=12, transform=ax2.transAxes)
        ax2.set_title(f'Top 15 Words in "{search_query}" Pin Titles', fontsize=16)
        ax2.axis('off')
    
    # 3. Clothing Types Bar Chart
    ax3 = plt.subplot(gs[1, 0])
    if analysis_results['clothing_counts']:
        clothing_df = pd.DataFrame({
            'Clothing': list(analysis_results['clothing_counts'].keys()),
            'Count': list(analysis_results['clothing_counts'].values())
        }).sort_values('Count', ascending=False)
        
        sns.barplot(x='Count', y='Clothing', data=clothing_df, palette='Blues_d', ax=ax3)
        ax3.set_title('Clothing Types Mentioned', fontsize=16)
        ax3.set_xlabel('Frequency')
    else:
        plt.text(0.5, 0.5, 'No clothing types detected', 
                 horizontalalignment='center', fontsize=12, transform=ax3.transAxes)
        ax3.set_title('Clothing Types Mentioned', fontsize=16)
        ax3.axis('off')
    
    # 4. Colors Bar Chart
    ax4 = plt.subplot(gs[1, 1])
    if analysis_results['color_counts']:
        color_df = pd.DataFrame({
            'Color': list(analysis_results['color_counts'].keys()),
            'Count': list(analysis_results['color_counts'].values())
        }).sort_values('Count', ascending=False)
        
        # Use actual color names as the palette where possible
        color_palette = []
        for color in color_df['Color']:
            if color in ['black', 'white', 'red', 'blue', 'green', 'yellow', 'purple', 'pink', 'orange', 'brown']:
                color_palette.append(color)
            else:
                color_palette.append('gray')  # Default for colors that can't be directly mapped
                
        sns.barplot(x='Count', y='Color', data=color_df, palette=color_palette, ax=ax4)
        ax4.set_title('Colors Mentioned', fontsize=16)
        ax4.set_xlabel('Frequency')
    else:
        plt.text(0.5, 0.5, 'No colors detected', 
                 horizontalalignment='center', fontsize=12, transform=ax4.transAxes)
        ax4.set_title('Colors Mentioned', fontsize=16)
        ax4.axis('off')
    
    # 5. Style Trends Chart
    ax5 = plt.subplot(gs[2, :])
    if analysis_results['style_counts']:
        style_df = pd.DataFrame({
            'Style': list(analysis_results['style_counts'].keys()),
            'Count': list(analysis_results['style_counts'].values())
        }).sort_values('Count', ascending=False)
        
        sns.barplot(x='Style', y='Count', data=style_df, palette='rocket', ax=ax5)
        ax5.set_title('Fashion Styles Mentioned', fontsize=16)
        ax5.set_ylabel('Frequency')
        ax5.set_xticklabels(ax5.get_xticklabels(), rotation=45, ha='right')
    else:
        plt.text(0.5, 0.5, 'No style terms detected', 
                 horizontalalignment='center', fontsize=12, transform=ax5.transAxes)
        ax5.set_title('Fashion Styles Mentioned', fontsize=16)
        ax5.axis('off')
    
    plt.tight_layout()
    output_file = f'{search_query}_title_trends.png'
    plt.savefig(output_file, dpi=300, bbox_inches='tight')
    plt.close()
    
    print(f"Visualization saved as '{output_file}'")

def generate_insights(analysis_results):
    """Generate text insights based on the analysis"""
    insights = []
    
    insights.append(f"Analyzed {analysis_results['title_count']} Pinterest pins")
    
    # Most common words
    top_words = analysis_results['word_counts'].most_common(5)
    if top_words:
        words_text = ", ".join([f"'{word}' ({count})" for word, count in top_words])
        insights.append(f"Most common words: {words_text}")
    
    # Most mentioned clothing items
    if analysis_results['clothing_counts']:
        top_clothing = sorted(analysis_results['clothing_counts'].items(), key=lambda x: x[1], reverse=True)[:3]
        clothing_text = ", ".join([f"'{item}' ({count})" for item, count in top_clothing])
        insights.append(f"Top clothing items: {clothing_text}")
    
    # Most mentioned colors
    if analysis_results['color_counts']:
        top_colors = sorted(analysis_results['color_counts'].items(), key=lambda x: x[1], reverse=True)[:3]
        colors_text = ", ".join([f"'{color}' ({count})" for color, count in top_colors])
        insights.append(f"Popular colors: {colors_text}")
    
    # Most mentioned styles
    if analysis_results['style_counts']:
        top_styles = sorted(analysis_results['style_counts'].items(), key=lambda x: x[1], reverse=True)[:3]
        styles_text = ", ".join([f"'{style}' ({count})" for style, count in top_styles])
        insights.append(f"Trending styles: {styles_text}")
    
    return insights

def main():
    search_query = "clothes"  # Change this to match your JSON file name
    file_name = f"{search_query}-results.json"
    
    try:
        # Load data
        data = load_pinterest_data(file_name)
        
        if not data:
            print("No data found in the file. Make sure the scraping was successful.")
            return
            
        print(f"Loaded {len(data)} Pinterest pins. Analyzing title trends...")
        
        # Analyze titles
        analysis_results = analyze_titles(data)
        
        # Generate insights
        insights = generate_insights(analysis_results)
        print("\n=== PINTEREST TITLE ANALYSIS INSIGHTS ===")
        for insight in insights:
            print(insight)
        print("========================================\n")
        
        # Create visualizations
        visualize_trends(analysis_results, search_query)
        
    except FileNotFoundError:
        print(f"File '{file_name}' not found. Make sure you've run the scraping script first.")
        print(f"Looking for: {os.path.abspath(file_name)}")
    except json.JSONDecodeError:
        print(f"Error parsing '{file_name}'. The file might be empty or contain invalid JSON.")
    except Exception as e:
        print(f"An error occurred: {e}")
        import traceback
        traceback.print_exc()

if __name__ == "__main__":
    main()