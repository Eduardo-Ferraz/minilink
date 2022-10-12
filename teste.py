import requests

def testes(a):
    if a == '1':
        b = requests.post('http://localhost/minilink/post_encurtada.php', data={'link':'globo.com'}) # Para registrar com Key, inserir 'key':'' como parâmetro
    if a == '2':
        b = requests.post('http://localhost/minilink/encurt_orig.php', data={'idUrl':'3ec55', 'key':'12'})
    if a == '3':
        b = requests.post('http://localhost/minilink/delete_link.php', data={'idUrl':'0b2e5', 'key':'12'})
    
    print(b.text)

def main():
    a = input("Informe o teste: ")
    testes(a)

    # while(a != '0'):
    #     testes(a)
    #     a = input("Informe o teste: ")

if __name__ == "__main__":
    main()