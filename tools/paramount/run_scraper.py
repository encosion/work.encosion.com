#!/usr/bin/env python3
"""
Simple Paramount Job Scraper Runner

This script provides an easy way to run the Paramount job scraper
with different options and configurations.

Usage:
    python run_scraper.py --basic          # Use basic scraper (requests + BeautifulSoup)
    python run_scraper.py --enhanced       # Use enhanced scraper (Selenium)
    python run_scraper.py --headless       # Run enhanced scraper in headless mode
    python run_scraper.py --visible        # Run enhanced scraper with visible browser
"""

import argparse
import sys
import os
from pathlib import Path

def run_basic_scraper():
    """Run the basic scraper using requests and BeautifulSoup"""
    try:
        from paramount_scraper import ParamountJobScraper
        
        print("🚀 Starting Basic Paramount Job Scraper...")
        scraper = ParamountJobScraper()
        scraper.run()
        print("✅ Basic scraping completed!")
        
    except ImportError as e:
        print(f"❌ Error importing basic scraper: {e}")
        print("Make sure you have installed the required packages:")
        print("pip install requests beautifulsoup4 lxml")
        return False
    except Exception as e:
        print(f"❌ Error running basic scraper: {e}")
        return False
    
    return True

def run_enhanced_scraper(headless=True):
    """Run the enhanced scraper using Selenium"""
    try:
        from paramount_scraper_enhanced import EnhancedParamountJobScraper
        
        print(f"🚀 Starting Enhanced Paramount Job Scraper (headless={headless})...")
        scraper = EnhancedParamountJobScraper(headless=headless)
        scraper.run()
        print("✅ Enhanced scraping completed!")
        
    except ImportError as e:
        print(f"❌ Error importing enhanced scraper: {e}")
        print("Make sure you have installed the required packages:")
        print("pip install selenium requests beautifulsoup4 lxml pandas openpyxl")
        print("Also make sure you have ChromeDriver installed and in your PATH")
        return False
    except Exception as e:
        print(f"❌ Error running enhanced scraper: {e}")
        return False
    
    return True

def check_dependencies():
    """Check if required dependencies are installed"""
    required_packages = {
        'requests': 'requests',
        'beautifulsoup4': 'bs4',
        'lxml': 'lxml'
    }
    optional_packages = {
        'selenium': 'selenium',
        'pandas': 'pandas',
        'openpyxl': 'openpyxl'
    }
    
    missing_required = []
    missing_optional = []
    
    for package_name, import_name in required_packages.items():
        try:
            __import__(import_name)
        except ImportError:
            missing_required.append(package_name)
    
    for package_name, import_name in optional_packages.items():
        try:
            __import__(import_name)
        except ImportError:
            missing_optional.append(package_name)
    
    if missing_required:
        print("❌ Missing required packages:")
        for package in missing_required:
            print(f"   - {package}")
        print("\nInstall with: pip install " + " ".join(missing_required))
        return False
    
    if missing_optional:
        print("⚠️  Missing optional packages (needed for enhanced scraper):")
        for package in missing_optional:
            print(f"   - {package}")
        print("\nInstall with: pip install " + " ".join(missing_optional))
    
    return True

def main():
    parser = argparse.ArgumentParser(description='Paramount Job Scraper')
    parser.add_argument('--basic', action='store_true', 
                       help='Run basic scraper (requests + BeautifulSoup)')
    parser.add_argument('--enhanced', action='store_true',
                       help='Run enhanced scraper (Selenium)')
    parser.add_argument('--headless', action='store_true',
                       help='Run enhanced scraper in headless mode')
    parser.add_argument('--visible', action='store_true',
                       help='Run enhanced scraper with visible browser')
    parser.add_argument('--check-deps', action='store_true',
                       help='Check dependencies and exit')
    
    args = parser.parse_args()
    
    if args.check_deps:
        if check_dependencies():
            print("✅ All dependencies are available!")
        sys.exit(0)
    
    if not check_dependencies():
        sys.exit(1)
    
    success = False
    
    if args.basic:
        success = run_basic_scraper()
    elif args.enhanced or args.headless:
        success = run_enhanced_scraper(headless=True)
    elif args.visible:
        success = run_enhanced_scraper(headless=False)
    else:
        # Default to enhanced scraper
        print("No specific scraper specified. Running enhanced scraper by default...")
        success = run_enhanced_scraper(headless=True)
    
    if success:
        print("\n🎉 Scraping completed successfully!")
        print("Check the generated files:")
        print("   - paramount_jobs*.json (JSON format)")
        print("   - paramount_jobs*.csv (CSV format)")
        print("   - paramount_jobs*.xlsx (Excel format)")
    else:
        print("\n❌ Scraping failed!")
        sys.exit(1)

if __name__ == "__main__":
    main()
