import requests
import time

url = 'https://example.com'

start_time = time.time()
response = requests.get(url)
elapsed_time = time.time() - start_time

print('Server response time:', elapsed_time, 'seconds')
