import requests

a = requests.post('http://localhost/minilink/post_encurtada.php', data={'link':'youtube.com'})
# b = requests.post('http://localhost/minilink/encurt_orig.php', data={'idUrl':'dd39e', 'key':''})

print(b.text)