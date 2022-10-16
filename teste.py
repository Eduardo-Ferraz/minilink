import requests

def testes(a):
    if a == '1': 
        b = requests.post('http://localhost/minilink/post_encurtada.php', data={'link':'twitter.com', 'key':'12', 'idUrl':''}) 
        # Para registrar com idUrl nao aleatoria, inserir 'idUrl':'#url desejada#' como parâmetro
        # Para registrar com Key, inserir 'key':'#key do usuario#' como parâmetro
    if a == '2':
        b = requests.post('http://localhost/minilink/encurt_orig.php', data={'idUrl':'9b168', 'key':'12'})
    if a == '3':
        b = requests.post('http://localhost/minilink/delete_link.php', data={'idUrl':'9b168', 'key':'12'})
    if a == '4':
        b = requests.post('http://localhost/minilink/change_link.php', data={'idUrl':'aaaaa', 'novaidUrl':'a1b2c', 'key':'12'})
    
    print(f"Resultado: {b.text}\n")

def main():
    #a = input("\nInforme o teste: ")
    a = '4'
    testes(a)

    # while(a != '0'):
    #     testes(a)
    #     a = input("Informe o teste: ")

if __name__ == "__main__":
    main()