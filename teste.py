import requests

def testes(a):
    if a == '1': 
        b = requests.post('http://localhost/post_encurtada.php', data={'link':'youtube.com', 'novaIdUrl':'yt', 'key':'ecd4d482f0e2c06e3add'}) #, 'novaIdUrl':'0123456789'
        # Para registrar com novaIdUrl nao aleatoria, inserir 'novaIdUrl':'#url desejada#' como parâmetro
        # Para registrar com Key, inserir 'key':'#key do usuario#' como parâmetro
    if a == '2':
        b = requests.get('http://localhost/encurt_orig.php', params={'idUrl':'fodaaa', 'key':'ecd4d482f0e2c06e3add'})
    if a == '3':
        b = requests.request('DELETE', 'http://localhost/delete_link.php', data={'idUrl':'dede', 'key':'ecd4d482f0e2c06e3add'}) # 'key':'ecd4d482f0e2c06e3add'
    if a == '4':
        b = requests.post('http://localhost/change_link.php', data={'idUrl':'tt', 'novaIdUrl':'MUITOMUITO', 'key':'ecd4d482f0e2c06e3add'}) #  , 'novaIdUrl':'aoao'
    
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