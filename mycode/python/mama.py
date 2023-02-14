import requests
from bs4 import BeautifulSoup
import urllib.request
import os
import time
from urllib.parse import urljoin

# URL of the website
url = 'https://azegdz.com/8-class/matematika-gahramanova-8-klass-2020/u156-1/'

# Create a folder called "images" to save the downloaded images
if not os.path.exists('images'):
    os.makedirs('images')

# Find and download images on the current page
def download_images(soup, page_number):
    images = soup.find_all('img')
    for image in images:
        img_url = image['src']
        if img_url.endswith('.jpg'):  # Only download JPG files
            if not img_url.startswith('http'):
                img_url = urljoin(url, img_url)
            filename = os.path.join('images', str(page_number) + '_' + str(int(time.time())) + '_' + img_url.split('/')[-1])
            urllib.request.urlretrieve(img_url, filename)

# Find and click the "следующее >" button
def find_next_button(soup, page_number):
    next_button = soup.find('a', title='Келесі задание')
    if next_button:
        next_url = next_button['href']
        try:
            next_page = requests.get(next_url, timeout=10)
        except requests.exceptions.RequestException as e:
            print("Error:", e)
            return
        soup = BeautifulSoup(next_page.content, 'html.parser')
        download_images(soup, page_number + 1)
        find_next_button(soup, page_number + 1)

# Request the webpage content
try:
    page = requests.get(url, timeout=10)
except requests.exceptions.RequestException as e:
    print("Error:", e)
    exit()

# Parse the HTML content using BeautifulSoup
soup = BeautifulSoup(page.content, 'html.parser')

# Download images on the first page
download_images(soup, 1)

# Find and download images on subsequent pages
find_next_button(soup, 1)

# This code takes url of site and goes throu the next pages to download the files , it stops downloading files at some point because HTTP connection is slow and causes and error at some point
# so the code stops downloading images
# it is not reusable for other site as it specifically tries to find button that i copied code from site.
