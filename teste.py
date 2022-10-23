import requests

def testes(a):
    if a == '1': 
        b = requests.post('http://localhost/minilink/post_encurtada.php', data={'link':'twitter.com', 'idUrl':'dota56', 'key':'ecd4d482f0e2c06e3add'}) 
        # Para registrar com idUrl nao aleatoria, inserir 'idUrl':'#url desejada#' como parâmetro
        # Para registrar com Key, inserir 'key':'#key do usuario#' como parâmetro
    if a == '2':
        b = requests.post('http://localhost/minilink/encurt_orig.php', data={'idUrl':'myIdPerso', 'key':'12'})
    if a == '3':
        b = requests.request('DELETE', 'http://localhost/minilink/delete_link_teste.php', data={'idUrl':'dota5', 'key':'ecd4d482f0e2c06e3add'}) # , 'key':'12', 'key':'ecd4d482f0e2c06e3ad'
    if a == '4':
        b = requests.post('http://localhost/minilink/change_link.php', data={'idUrl':'newIdPerso', 'novaIdUrl':'aoao'})
    
    print(f"\nResultado: {b.text}\n")

def main():
    # a = input("\nInforme o teste: ")
    a = '3'
    testes(a)

    # while(a != '0'):
    #     testes(a)
    #     a = input("Informe o teste: ")

if __name__ == "__main__":
    main()