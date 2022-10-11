import requests

a = int(input("Informe o teste: "))

testes = []
testes.append(requests.post('http://localhost/minilink/post_encurtada.php', data={'link':'youtube.com'}))
testes.append(requests.post('http://localhost/minilink/encurt_orig.php', data={'idUrl':'dd39e', 'key':''}))

print(testes[a].text)