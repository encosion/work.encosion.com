# Paramount Careers Job Scraper

A comprehensive web scraping solution to extract all job vacancies and descriptions from the Paramount careers website.

## Features

- **Complete Job Extraction**: Scrapes all available job listings from the Paramount careers site
- **Detailed Descriptions**: Fetches full job descriptions, requirements, and benefits from individual job pages
- **Multiple Output Formats**: Saves data in JSON, CSV, and Excel formats
- **Robust Error Handling**: Includes comprehensive logging and error recovery
- **Rate Limiting**: Respectful scraping with appropriate delays between requests
- **Deduplication**: Removes duplicate job listings
- **Two Scraping Methods**: Basic (requests + BeautifulSoup) and Enhanced (Selenium)

## Files Overview

### Core Scrapers
- `paramount_scraper.py` - Basic scraper using requests and BeautifulSoup
- `paramount_scraper_enhanced.py` - Enhanced scraper using Selenium for JavaScript-heavy sites
- `run_scraper.py` - Simple runner script with command-line options

### Configuration
- `requirements.txt` - Python package dependencies
- `README.md` - This documentation file

## Installation

1. **Install Python Dependencies**:
   ```bash
   pip install -r requirements.txt
   ```

2. **Install ChromeDriver** (for enhanced scraper):
   - Download ChromeDriver from https://chromedriver.chromium.org/
   - Make sure it's in your PATH or place it in the same directory as the script
   - Ensure your Chrome browser version matches the ChromeDriver version

## Usage

### Quick Start
```bash
# Run enhanced scraper (recommended)
python run_scraper.py --enhanced

# Run basic scraper
python run_scraper.py --basic

# Check dependencies
python run_scraper.py --check-deps
```

### Command Line Options
- `--basic`: Use basic scraper (requests + BeautifulSoup)
- `--enhanced`: Use enhanced scraper (Selenium) in headless mode
- `--headless`: Run enhanced scraper in headless mode (default)
- `--visible`: Run enhanced scraper with visible browser window
- `--check-deps`: Check if all dependencies are installed

### Direct Usage
```python
# Basic scraper
from paramount_scraper import ParamountJobScraper
scraper = ParamountJobScraper()
scraper.run()

# Enhanced scraper
from paramount_scraper_enhanced import EnhancedParamountJobScraper
scraper = EnhancedParamountJobScraper(headless=True)
scraper.run()
```

## Output Files

The scraper generates several output files:

### JSON Format (`paramount_jobs*.json`)
```json
[
  {
    "title": "Software Engineer",
    "job_function": "Technology",
    "location": "Los Angeles, CA",
    "brand": "Paramount Pictures",
    "job_type": "Full-Time",
    "date_posted": "Oct 23, 2025",
    "job_url": "https://careers.paramount.com/job/12345",
    "description": "Full job description...",
    "requirements": "Job requirements...",
    "benefits": "Benefits and perks..."
  }
]
```

### CSV Format (`paramount_jobs*.csv`)
Comma-separated values with all job fields as columns.

### Excel Format (`paramount_jobs*.xlsx`)
Excel spreadsheet with multiple sheets for easy analysis.

## Data Fields Extracted

- **title**: Job title
- **job_function**: Department/function (e.g., Technology, Marketing)
- **location**: Job location (city, state, country)
- **brand**: Paramount brand/division (e.g., CBS, Paramount Pictures)
- **job_type**: Employment type (Full-Time, Part-Time, etc.)
- **date_posted**: When the job was posted
- **job_url**: Direct link to the job posting
- **description**: Full job description
- **requirements**: Job requirements and qualifications
- **benefits**: Benefits and perks offered
- **raw_text**: Raw text content for additional analysis

## Scraper Methods

### Basic Scraper (`paramount_scraper.py`)
- Uses `requests` and `BeautifulSoup`
- Faster and lighter weight
- Good for static content
- May miss JavaScript-rendered content

### Enhanced Scraper (`paramount_scraper_enhanced.py`)
- Uses `Selenium` with Chrome WebDriver
- Handles JavaScript-rendered content
- More robust for modern websites
- Supports infinite scroll and dynamic loading
- Can run in headless or visible mode

## Configuration Options

### Enhanced Scraper Options
```python
scraper = EnhancedParamountJobScraper(
    headless=True,  # Run browser in background
)
```

### Customization
You can modify the scraper by adjusting:
- **Delays**: Change `time.sleep()` values for different request rates
- **Selectors**: Update CSS selectors if the website structure changes
- **Output formats**: Add additional output formats as needed
- **Fields**: Extract additional job fields by modifying extraction methods

## Troubleshooting

### Common Issues

1. **ChromeDriver not found**:
   - Install ChromeDriver and ensure it's in your PATH
   - Check ChromeDriver version compatibility with your Chrome browser

2. **No jobs found**:
   - The website structure may have changed
   - Check if the site requires authentication
   - Verify the URL is still correct

3. **Rate limiting**:
   - Increase delays between requests
   - Use a VPN or different IP address
   - Check if the site has anti-bot measures

4. **Import errors**:
   - Install missing packages: `pip install -r requirements.txt`
   - Check Python version compatibility

### Debugging

Enable debug logging by modifying the logging level:
```python
logging.basicConfig(level=logging.DEBUG)
```

Run with visible browser to see what's happening:
```bash
python run_scraper.py --visible
```

## Legal and Ethical Considerations

- **Respect robots.txt**: Check the site's robots.txt file
- **Rate limiting**: Use appropriate delays between requests
- **Terms of service**: Review Paramount's terms of service
- **Personal use**: This tool is for personal/educational use only
- **No commercial use**: Do not use scraped data for commercial purposes without permission

## Performance Notes

- **Basic scraper**: Faster, uses less resources
- **Enhanced scraper**: Slower but more comprehensive
- **Memory usage**: Enhanced scraper uses more memory due to browser instance
- **Network usage**: Both scrapers make multiple HTTP requests

## Future Enhancements

Potential improvements:
- Add support for other career sites
- Implement database storage
- Add job filtering and search capabilities
- Create a web interface for the scraper
- Add email notifications for new jobs
- Implement job comparison features

## Support

For issues or questions:
1. Check the troubleshooting section
2. Review the log files for error details
3. Ensure all dependencies are properly installed
4. Verify the website structure hasn't changed

## License

This project is for educational and personal use only. Please respect Paramount's terms of service and use responsibly.
