import requests
from bs4 import BeautifulSoup
import urllib.request
import os
import time
from urllib.parse import urljoin

# URL of the website
url = 'https://azegdz.com/8-class/matematika-gahramanova-8-klass-2020/u156-1-16/'

# Create a folder called "images" to save the downloaded images
if not os.path.exists('images'):
    os.makedirs('images')

# Find and download images on the current page
def download_images(soup, page_number, start_number):
    images = soup.find_all('img')
    for i, image in enumerate(images):
        img_url = image['src']
        if img_url.endswith('.jpg'):  # Only download JPG files
            if not img_url.startswith('http'):
                img_url = urljoin(url, img_url)
            filename = os.path.join('images', str(start_number + i) + '_' + str(int(time.time())) + '_' + img_url.split('/')[-1])
            urllib.request.urlretrieve(img_url, filename)

# Find and click the "следующее >" button
def find_next_button(soup, page_number, start_number):
    next_button = soup.find('a', title='Келесі задание')
    if next_button:
        next_url = next_button['href']
        try:
            next_page = requests.get(next_url, timeout=10)
        except requests.exceptions.RequestException as e:
            print("Error:", e)
            return
        soup = BeautifulSoup(next_page.content, 'html.parser')
        download_images(soup, page_number + 1, start_number + len(images))
        find_next_button(soup, page_number + 1, start_number + len(images))

# Request the webpage content
try:
    page = requests.get(url, timeout=10)
except requests.exceptions.RequestException as e:
    print("Error:", e)
    exit()

# Parse the HTML content using BeautifulSoup
soup = BeautifulSoup(page.content, 'html.parser')

# Download images on the first page
download_images(soup, 1, 292)

# Find and download images on subsequent pages
find_next_button(soup, 1, 292)
