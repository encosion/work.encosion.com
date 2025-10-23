#!/usr/bin/env python3
"""
Enhanced Paramount Careers Job Scraper with Selenium

This script uses Selenium to handle JavaScript-rendered content and provides
more robust scraping capabilities for the Paramount careers website.

Author: AI Assistant
Date: 2025-01-27
"""

import requests
from bs4 import BeautifulSoup
import json
import csv
import time
import re
from urllib.parse import urljoin, urlparse
import logging
from typing import List, Dict, Optional
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.chrome.options import Options
from selenium.common.exceptions import TimeoutException, NoSuchElementException
import pandas as pd

# Configure logging
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(levelname)s - %(message)s',
    handlers=[
        logging.FileHandler('paramount_scraper_enhanced.log'),
        logging.StreamHandler()
    ]
)
logger = logging.getLogger(__name__)

class EnhancedParamountJobScraper:
    def __init__(self, headless: bool = True):
        self.base_url = "https://careers.paramount.com"
        self.search_url = "https://careers.paramount.com/search/"
        self.jobs_data = []
        self.headless = headless
        self.driver = None
        
    def setup_driver(self):
        """Setup Chrome WebDriver with appropriate options"""
        chrome_options = Options()
        if self.headless:
            chrome_options.add_argument("--headless")
        chrome_options.add_argument("--no-sandbox")
        chrome_options.add_argument("--disable-dev-shm-usage")
        chrome_options.add_argument("--disable-gpu")
        chrome_options.add_argument("--window-size=1920,1080")
        chrome_options.add_argument("--user-agent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36")
        
        try:
            self.driver = webdriver.Chrome(options=chrome_options)
            self.driver.implicitly_wait(10)
            logger.info("Chrome WebDriver initialized successfully")
        except Exception as e:
            logger.error(f"Failed to initialize WebDriver: {e}")
            raise
    
    def close_driver(self):
        """Close the WebDriver"""
        if self.driver:
            self.driver.quit()
            logger.info("WebDriver closed")
    
    def wait_for_element(self, by: By, value: str, timeout: int = 10):
        """Wait for an element to be present"""
        try:
            element = WebDriverWait(self.driver, timeout).until(
                EC.presence_of_element_located((by, value))
            )
            return element
        except TimeoutException:
            logger.warning(f"Element not found: {by}={value}")
            return None
    
    def scroll_to_load_more(self):
        """Scroll to trigger loading more jobs"""
        try:
            # Scroll to bottom of page
            self.driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
            time.sleep(2)
            
            # Look for "Load More", "Show More", or "Loading more jobs" button
            load_more_selectors = [
                "button[data-testid*='load']",
                "button[class*='load']",
                "a[class*='load']",
                "button:contains('Load More')",
                "button:contains('Show More')",
                "button:contains('Loading more jobs')",
                "a:contains('Load More')",
                "a:contains('More Search Results')"
            ]
            
            for selector in load_more_selectors:
                try:
                    if ":contains" in selector:
                        # Use XPath for text-based selection
                        xpath = f"//button[contains(text(), 'Load More')] | //button[contains(text(), 'Show More')] | //button[contains(text(), 'Loading more jobs')] | //a[contains(text(), 'Load More')] | //a[contains(text(), 'More Search Results')]"
                        elements = self.driver.find_elements(By.XPATH, xpath)
                    else:
                        elements = self.driver.find_elements(By.CSS_SELECTOR, selector)
                    
                    if elements:
                        element = elements[0]
                        if element.is_displayed() and element.is_enabled():
                            self.driver.execute_script("arguments[0].click();", element)
                            logger.info(f"Clicked load more button: {element.text}")
                            time.sleep(3)
                            return True
                except Exception as e:
                    continue
            
            # Also try clicking on any clickable element that might trigger pagination
            try:
                # Look for pagination links or buttons
                pagination_elements = self.driver.find_elements(By.XPATH, "//a[contains(text(), 'More Search Results')] | //button[contains(text(), 'More')]")
                if pagination_elements:
                    element = pagination_elements[0]
                    if element.is_displayed() and element.is_enabled():
                        self.driver.execute_script("arguments[0].click();", element)
                        logger.info(f"Clicked pagination element: {element.text}")
                        time.sleep(3)
                        return True
            except Exception as e:
                pass
            
            return False
        except Exception as e:
            logger.error(f"Error scrolling/loading more: {e}")
            return False
    
    def extract_jobs_from_page(self) -> List[Dict]:
        """Extract job listings from the current page"""
        jobs = []
        
        try:
            # Wait for job listings to load
            self.wait_for_element(By.CSS_SELECTOR, "[data-testid*='job'], .job, [class*='job'], li", 15)
            
            # Get page source and parse with BeautifulSoup
            soup = BeautifulSoup(self.driver.page_source, 'html.parser')
            
            # Look for job listings - Paramount uses list items with specific structure
            job_containers = []
            
            # First try to find list items that contain job information
            list_items = soup.find_all('li')
            for li in list_items:
                text = li.get_text()
                if 'Job Function' in text and 'Location' in text and 'Title' in text:
                    job_containers.append(li)
            
            # If no list items found, try other selectors
            if not job_containers:
                job_selectors = [
                    "[data-testid*='job']",
                    ".job-listing",
                    ".job-item",
                    ".search-result",
                    "[class*='job']",
                    "li[class*='job']",
                    "div[class*='job']"
                ]
                
                for selector in job_selectors:
                    containers = soup.select(selector)
                    if containers:
                        job_containers.extend(containers)
                        logger.info(f"Found {len(containers)} jobs with selector: {selector}")
            
            # Remove duplicates
            job_containers = list(set(job_containers))
            
            if not job_containers:
                # Fallback: look for any element containing job-related text
                all_elements = soup.find_all(['div', 'li', 'article'])
                job_containers = [elem for elem in all_elements 
                                if any(keyword in elem.get_text().lower() 
                                      for keyword in ['job function', 'location', 'title'])]
            
            logger.info(f"Processing {len(job_containers)} job containers")
            
            for container in job_containers:
                job_data = self.extract_job_info_from_container(container)
                if job_data and job_data.get('title'):
                    jobs.append(job_data)
            
        except Exception as e:
            logger.error(f"Error extracting jobs from page: {e}")
        
        return jobs
    
    def extract_job_info_from_container(self, container) -> Optional[Dict]:
        """Extract job information from a job container"""
        try:
            job_data = {}
            
            # Extract title and URL
            title_selectors = ['h1', 'h2', 'h3', 'h4', 'a[href*="/job/"]', '[data-testid*="title"]']
            for selector in title_selectors:
                title_elem = container.select_one(selector)
                if title_elem:
                    job_data['title'] = title_elem.get_text(strip=True)
                    if title_elem.name == 'a' and title_elem.get('href'):
                        job_data['job_url'] = urljoin(self.base_url, title_elem.get('href'))
                    break
            
            # Extract job function
            function_text = self.extract_field_by_label(container, ['Job Function', 'Function', 'Department'])
            if function_text:
                job_data['job_function'] = function_text
            
            # Extract location
            location_text = self.extract_field_by_label(container, ['Location', 'City', 'State'])
            if location_text:
                job_data['location'] = location_text
            
            # Extract brand/company
            brand_text = self.extract_field_by_label(container, ['Custom Field 2', 'Brand', 'Company', 'Division'])
            if brand_text:
                job_data['brand'] = brand_text
            
            # Extract job type
            type_text = self.extract_field_by_label(container, ['Custom Field 3', 'Job Type', 'Employment Type'])
            if type_text:
                job_data['job_type'] = type_text
            
            # Extract date
            date_text = self.extract_field_by_label(container, ['Date', 'Posted', 'Posted Date'])
            if date_text:
                job_data['date_posted'] = date_text
            
            # Extract any additional text content
            job_data['raw_text'] = container.get_text(strip=True)
            
            return job_data
            
        except Exception as e:
            logger.error(f"Error extracting job info: {e}")
            return None
    
    def extract_field_by_label(self, container, labels: List[str]) -> Optional[str]:
        """Extract field value by looking for specific labels"""
        text = container.get_text()
        
        for label in labels:
            pattern = rf"{re.escape(label)}[:\s]*([^\n\r]+)"
            match = re.search(pattern, text, re.IGNORECASE)
            if match:
                return match.group(1).strip()
        
        return None
    
    def get_detailed_job_description(self, job_url: str) -> Dict:
        """Fetch detailed job description from individual job page"""
        try:
            self.driver.get(job_url)
            time.sleep(2)
            
            soup = BeautifulSoup(self.driver.page_source, 'html.parser')
            details = {}
            
            # Extract job description
            desc_selectors = [
                '[data-testid*="description"]',
                '.job-description',
                '.description',
                '.content',
                '.job-details',
                'section.description',
                '.job-summary',
                '.job-overview'
            ]
            
            for selector in desc_selectors:
                desc_elem = soup.select_one(selector)
                if desc_elem:
                    details['description'] = desc_elem.get_text(strip=True)
                    break
            
            # Extract requirements/qualifications
            req_selectors = [
                '[data-testid*="requirements"]',
                '.requirements',
                '.qualifications',
                '.job-requirements',
                'ul.requirements',
                'ul.qualifications'
            ]
            
            for selector in req_selectors:
                req_elem = soup.select_one(selector)
                if req_elem:
                    details['requirements'] = req_elem.get_text(strip=True)
                    break
            
            # Extract benefits
            benefits_selectors = [
                '[data-testid*="benefits"]',
                '.benefits',
                '.compensation',
                '.perks'
            ]
            
            for selector in benefits_selectors:
                benefits_elem = soup.select_one(selector)
                if benefits_elem:
                    details['benefits'] = benefits_elem.get_text(strip=True)
                    break
            
            # Store full page content for analysis
            details['full_page_content'] = soup.get_text(strip=True)
            
            return details
            
        except Exception as e:
            logger.error(f"Error fetching job details from {job_url}: {e}")
            return {}
    
    def scrape_all_jobs(self) -> List[Dict]:
        """Scrape all job listings with pagination and infinite scroll"""
        all_jobs = []
        
        try:
            self.driver.get(self.search_url)
            time.sleep(3)
            
            # Handle initial page load
            initial_jobs = self.extract_jobs_from_page()
            all_jobs.extend(initial_jobs)
            logger.info(f"Found {len(initial_jobs)} jobs on initial page")
            
            # Try to load more jobs - increase max attempts for 161 jobs
            max_attempts = 20  # Increased from 10 to handle more pages
            attempts = 0
            consecutive_failures = 0
            
            while attempts < max_attempts and consecutive_failures < 3:
                attempts += 1
                logger.info(f"Attempting to load more jobs (attempt {attempts})")
                
                if self.scroll_to_load_more():
                    time.sleep(3)
                    new_jobs = self.extract_jobs_from_page()
                    
                    # Check if we got new jobs
                    if len(new_jobs) > len(all_jobs):
                        all_jobs = new_jobs  # Replace with all jobs found so far
                        logger.info(f"Loaded more jobs. Total: {len(all_jobs)}")
                        consecutive_failures = 0  # Reset failure counter
                    else:
                        consecutive_failures += 1
                        logger.info(f"No new jobs loaded (failure {consecutive_failures}/3)")
                else:
                    consecutive_failures += 1
                    logger.info(f"No load more button found (failure {consecutive_failures}/3)")
                
                # If we have enough jobs, we can stop early
                if len(all_jobs) >= 150:  # Close to expected 161
                    logger.info(f"Found {len(all_jobs)} jobs, stopping early")
                    break
            
            # Remove duplicates based on title and location
            unique_jobs = []
            seen = set()
            
            for job in all_jobs:
                key = (job.get('title', ''), job.get('location', ''))
                if key not in seen:
                    seen.add(key)
                    unique_jobs.append(job)
            
            logger.info(f"Found {len(unique_jobs)} unique jobs after deduplication")
            return unique_jobs
            
        except Exception as e:
            logger.error(f"Error during job scraping: {e}")
            return all_jobs
    
    def enrich_job_details(self, jobs: List[Dict]) -> List[Dict]:
        """Enrich job listings with detailed descriptions"""
        enriched_jobs = []
        
        for i, job in enumerate(jobs):
            logger.info(f"Enriching job {i+1}/{len(jobs)}: {job.get('title', 'Unknown')}")
            
            if job.get('job_url'):
                details = self.get_detailed_job_description(job['job_url'])
                job.update(details)
            
            enriched_jobs.append(job)
            
            # Add delay between requests
            time.sleep(2)
        
        return enriched_jobs
    
    def save_to_json(self, filename: str = 'paramount_jobs_enhanced.json'):
        """Save jobs data to JSON file"""
        with open(filename, 'w', encoding='utf-8') as f:
            json.dump(self.jobs_data, f, indent=2, ensure_ascii=False)
        logger.info(f"Saved {len(self.jobs_data)} jobs to {filename}")
    
    def save_to_csv(self, filename: str = 'paramount_jobs_enhanced.csv'):
        """Save jobs data to CSV file"""
        if not self.jobs_data:
            logger.warning("No data to save")
            return
        
        df = pd.DataFrame(self.jobs_data)
        df.to_csv(filename, index=False, encoding='utf-8')
        logger.info(f"Saved {len(self.jobs_data)} jobs to {filename}")
    
    def save_to_excel(self, filename: str = 'paramount_jobs_enhanced.xlsx'):
        """Save jobs data to Excel file"""
        if not self.jobs_data:
            logger.warning("No data to save")
            return
        
        df = pd.DataFrame(self.jobs_data)
        df.to_excel(filename, index=False, engine='openpyxl')
        logger.info(f"Saved {len(self.jobs_data)} jobs to {filename}")
    
    def run(self):
        """Main execution method"""
        logger.info("Starting Enhanced Paramount job scraper")
        
        try:
            self.setup_driver()
            
            # Scrape all job listings
            jobs = self.scrape_all_jobs()
            
            if not jobs:
                logger.error("No jobs found")
                return
            
            # Enrich with detailed descriptions
            self.jobs_data = self.enrich_job_details(jobs)
            
            # Save results in multiple formats
            self.save_to_json()
            self.save_to_csv()
            self.save_to_excel()
            
            logger.info(f"Scraping completed successfully. Found {len(self.jobs_data)} jobs.")
            
        except Exception as e:
            logger.error(f"Scraping failed: {e}")
            raise
        finally:
            self.close_driver()

def main():
    """Main function"""
    scraper = EnhancedParamountJobScraper(headless=True)
    scraper.run()

if __name__ == "__main__":
    main()
