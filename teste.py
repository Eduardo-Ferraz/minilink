import requests

a = requests.post('http://localhost/post_encurtada.php', data={'link':'youtube.com', 'key':'2'})
"""b = requests.post('http://localhost/encurt_orig.php', data={'idUrl':'youtube.com'})"""

print(a.text)