<!-- Improved compatibility of back to top link: See: https://github.com/othneildrew/Best-README-Template/pull/73 -->
<a name="readme-top"></a>
<!--
*** Thanks for checking out the Best-README-Template. If you have a suggestion
*** that would make this better, please fork the repo and create a pull request
*** or simply open an issue with the tag "enhancement".
*** Don't forget to give the project a star!
*** Thanks again! Now go create something AMAZING! :D
-->

[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/Eduardo-Ferraz/minilink">
    <img src="./christmas_2012_new_5895.jpg" alt="Logo" width="80" height="80">
    <br />
    <label><a href="https://www.freepik.com/free-vector/branding-identity-corporate-vector-logo-letter-m-design_28560879.htm#query=m%20logo&position=39&from_view=keyword">Image by Rochak Shukla</a> on Freepik</label>
  </a>

  <h3 align="center">Minilink docs</h3>

  <p align="center">
    O melhor encurtador de links do mercado!
    <br />
    <a href="https://github.com/Eduardo-Ferraz/minilink"><strong>Explorar os documentos »</strong></a>
    <br />
    <br />
    <a href="https://github.com/Eduardo-Ferraz/minilink">Ver Demo</a>
    ·
    <a href="https://github.com/Eduardo-Ferraz/minilink/issues">Reportar bug</a>
    ·
    <a href="https://github.com/Eduardo-Ferraz/minilink/issues">Recomendar conteúdo</a>
  </p>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Sumário</summary>
  <ol>
    <li>
      <a href="#about-the-project">Sobre o projeto</a>
      <ul>
        <li><a href="#built-with">Desenvolvido com</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Primeiros passos</a>
      <ul>
        <li><a href="#prerequisites">Pré-requisitos</a></li>
        <li><a href="#installation">Instalação</a></li>
      </ul>
    </li>
    <li><a href="#usage">Uso</a></li>
    <li><a href="#contact">Contato</a></li>
    <li><a href="#acknowledgments">Créditos</a></li>
  </ol>
</details>



<!-- SOBRE O PROJETO -->
## Sobre o Projeto

Criamos o Minilink com o objetivo de mudar a forma como links são encurtados. Com um design pensado em agilidade e comodidade, este encurtador se destaca dos restantes do mercado acompanhado de diversos recursos

Alguns deles são:
* Criação de links personalizados, ou com terminação aleatória 
* Criação de contas no site para registrar e gerenciar seus links
* Facilidade para editar e deletar seus links quando quiser

Seja para dar um toque charmoso em uma campanha de divulgação ou para mandar um rick roll secreto para seus amigos, conte com Minilink para te ajudar!

### Desenvolvido com

Aqui estão as linguagens e frameworks utilizados em nosso projeto.

* [![Bootstrap][Bootstrap.com]][Bootstrap-url]
* [![PHP][PHP.com]][PHP-url]
* [![HTML][html.com]][html-url]
* [![phpMyAdmin][phpmyadmin.com]][phpmyadmin-url]
* [![CSS][css.com]][css-url]

<p align="right">(<a href="#readme-top">Início</a>)</p>



<!-- GETTING STARTED -->
## Primeiros passos

Para começar a utilizar a tecnologia envolvendo o Minilink, você deve seguir os seguintes passos.

### Pré-requisitos

Você deverá instalar o USBWebServer v8.6.6:


https://sourceforge.net/projects/usbwebserver/files/

### Instalação

- Extraia a pasta do USBWebServer v8.6.6.zip
- Clone o repositório dentro da pasta extraída

 ```sh
   git clone https://github.com/Eduardo-Ferraz/minilink.git
   ```


- Abra o aplicativo “usbwebserver”
- Vá em configurações no aplicativo
- Mude a “Pasta raíz” para a pasta do repositório ({path}/sua_pasta). Exemplo: “{path}/minilink”
- Volte para a aba geral e abra o “PHPMyAdmin”
- Entre com o login “root” e com a senha “usbw”.
- Clique na aba “SQL” na parte superior da página e depois abra o arquivo “minilink.sql” como bloco de notas
- Copie tudo dentro do arquivo e cole na seção de texto da aba “SQL” do phpMyAdmin
- Clique em executar na parte inferior direita da página
- Abra o usbwebserver novamente e clique em localhost
- Registre-se para conseguir sua key de autenticação
- Para acessar a API, você deve realizar requests como demonstrado na [documentação.](https://docs.google.com/document/d/1L91q-NjMwcI479lJuSlmf0BbyBTBEAB4XImUy9EyluI/edit#heading=h.cwsyhg3o8js9)

Observação: para acessar a API não é necessária a utilização de uma key de autenticação, mas sim para proteger seus links encurtados.

<p align="right">(<a href="#readme-top">Início</a>)</p>



<!-- USAGE EXAMPLES -->
## Como usar

Para utilizar a API do minilink, é preciso realizar requests para determinados arquivos, como demonstrado na [documentação da API](https://docs.google.com/document/d/1L91q-NjMwcI479lJuSlmf0BbyBTBEAB4XImUy9EyluI/edit#heading=h.cwsyhg3o8js9)

<p align="right">(<a href="#readme-top">Início</a>)</p>


<!-- CONTACT -->
## Contato

Eduardo Ferraz: [https://github.com/Eduardo-Ferraz/](https://github.com/Eduardo-Ferraz/)<br />
Lucas D. Nitz: [https://github.com/lucdnitz/](https://github.com/lucdnitz/)


<p align="right">(<a href="#readme-top">Início</a>)</p>



<!-- ACKNOWLEDGMENTS -->
## Créditos

Use this space to list resources you find helpful and would like to give credit to. I've included a few of my favorites to kick things off!

* [Choose a license](https://choosealicense.com)
* [Bootstrap](https://getbootstrap.com/)
* [Img Shields](https://shields.io)
* [GitHub README Template](https://github.com/othneildrew/Best-README-Template)

<p align="right">(<a href="#readme-top">Início</a>)</p>



<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/Eduardo-Ferraz/minilink.svg?style=for-the-badge
[contributors-url]: https://github.com/Eduardo-Ferraz/minilink/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/Eduardo-Ferraz/minilink.svg?style=for-the-badge
[forks-url]: https://github.com/Eduardo-Ferraz/minilink/network/members
[stars-shield]: https://img.shields.io/github/stars/Eduardo-Ferraz/minilink.svg?style=for-the-badge
[stars-url]: https://github.com/Eduardo-Ferraz/minilink/stargazers
[issues-shield]: https://img.shields.io/github/issues/Eduardo-Ferraz/minilink.svg?style=for-the-badge
[issues-url]: https://github.com/othneildrew/Best-README-Template/issues
[license-shield]: https://img.shields.io/github/license/Eduardo-Ferraz/minilink.svg?style=for-the-badge
[license-url]: https://github.com/Eduardo-Ferraz/minilink/blob/main/LICENSE.txt
[product-screenshot]: images/screenshot.png
[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com
[PHP.com]: https://img.shields.io/badge/PHP-0000FF?style=for-the-badge&logo=php&logoColor=white
[PHP-url]: https://www.php.net/
[html.com]: https://img.shields.io/badge/html-FFA500?style=for-the-badge&logo=html5&logoColor=white
[html-url]: https://developer.mozilla.org/en-US/docs/Web/HTML
[phpmyadmin.com]: https://img.shields.io/badge/phpmyadmin-CA5CDD?style=for-the-badge&logo=phpmyadmin&logoColor=white
[phpmyadmin-url]: https://www.phpmyadmin.net/
[css.com]: https://img.shields.io/badge/css-000000?style=for-the-badge&logo=css3&logoColor=white
[css-url]: https://developer.mozilla.org/en-US/docs/Web/CSS

