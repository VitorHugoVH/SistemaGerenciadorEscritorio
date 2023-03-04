LOCAWEB STYLENosso Twitter
DOCUMENTAÇÃO
LOCAWEB STYLE
Introdução
Práticas e Padrões
Layout
Componentes
Formulários
Telas de Exemplos
Cartilha de Elementos
Informações
Instalação e como usar
Dependências e instruções
Contribua
Download do Locaweb Style
Use direto pelo CDN ou baixe uma versão estável para usar em projetos offline.
Download do CSS e JS compilados
O caminho mais rápido para você utilizar o Locaweb Style é baixando o CSS e o JS compilados e minificados prontos para utilizar. Deste modo você apenas baixa apenas o CSS e JS para usar em seu projeto, sem documentação, arquivos originais e etc...


Mais opções de download
Você também pode baixar os arquivos por estes meios:

Pelo GitHub
Baixe direto pelo nosso GitHub

Clone ou Fork pelo Github
Clone o projeto pelo GitHub ou Fork sua própria versão

Use nosso servidor
Adicione as tags abaixo para adicionar o pacote de CSS e Javascript.

No Header, coloque o CSS.

<!-- Se estiver usando bootstrap, coloque o CSS do Locastyle logo após a sua chamada -->
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="//assets.locaweb.com.br/locastyle/2.0.6/stylesheets/locastyle.css">
Coloque no final do documento o JS.

<!-- Atente-se para a ordem: primeiro jquery, depois locastyle, depois o JS do Bootstrap. -->
<script async="" src="//www.google-analytics.com/analytics.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="//assets.locaweb.com.br/locastyle/2.0.6/javascripts/locastyle.js"></script>
<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
Se você quiser utilizar sempre a versão mais atual, use os caminhos dos assets sem a versão travada:

<link rel="stylesheet" type="text/css" href="//assets.locaweb.com.br/locastyle/edge/stylesheets/locastyle.css">
<script type="text/javascript" src="//assets.locaweb.com.br/locastyle/edge/javascripts/locastyle.js"></script>
Versionamento
O versionamento do Locaweb Style é simples: O nome dos arquivos tem essa estrutura: locastyle-[número do pacote stable].css. O resultado é este: locastyle-[major].[minor].[patch].css. O resultado fica locastyle-0.30.0.css.

De acordo com as mudanças e atualizações, nós vamos mudando a versão do arquivo. O número do minor sempre será um número par. Internamente trabalhamos com a versão de desenvolvimento utilizando o número ímpar. Logo, se a versão stable mais atual é 1.30.0, estamos trabalhando aqui na versão 1.31.0, 1.31.1 e etc. Quando terminarmos, vai para o ar a versão stable 1.32.0.

Boilerplate do Template básico
Utilize este código para iniciar seu projeto. Aqui você tem a estrutura básica para fazer o Locaweb Style funcionar perfeitamente:

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Seu produto</title>
    <meta charset="utf-8">

    <!-- Isso é necessário para funcionar a versão mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//assets.locaweb.com.br/locastyle/2.0.6/stylesheets/locastyle.css">

</head>

<body>


    <!-- Header principal -->
    <header class="header" role="banner">
        <div class="container">
            <span class="control-menu visible-xs ico-menu-2"></span>
            <span class="control-sidebar visible-xs ico-list"></span>
            <h1 class="project-name"><a href="#">Nome do Sistema</a></h1>
            <a href="#" class="help-suggestions ico-question hidden-xs">Ajuda e Sugestões</a>

            <div class="dropdown hidden-xs">
                <a href="#" data-toggle="dropdown" class="title-dropdown">emkt2013</a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li><a href="#" role="menuitem">Option 1</a></li>
                    <li><a href="#" role="menuitem">Option 2</a></li>
                    <li><a href="#" role="menuitem">Option 3</a></li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Menu -->
    <div class="nav-content">
        <menu class="menu">
            <ul class="container">
                <li><a href="#" class="active ico-home" role="menuitem">Home</a></li>
                <li><a href="#" role="menuitem">Lista de contatos</a></li>
                <li><a href="#" role="menuitem">Mensagens</a>
                    <ul>
                        <li><a href="#">Enviar</a></li>
                        <li><a href="#">Criar</a></li>
                        <li><a href="#">Editar</a></li>
                        <li><a href="#">Relatórios</a></li>
                    </ul>
                </li>
                <li><a href="#" role="menuitem">Campanhas</a></li>
                <li><a href="#" role="menuitem">Templates</a></li>
                <li><a href="#" role="menuitem">Relatórios</a></li>
                <li><a href="#" role="menuitem">Configurações</a></li>
            </ul>
        </menu>
        <h2 class="title-sep visible-xs">Mais</h2>
        <ul class="nav-mob-list visible-xs">
            <li><a href="#" class="ico-help-circle">Ajuda e sugestões</a></li>
        </ul>
    </div>

    <!-- Aqui começa a parte de conteúdo dividido por colunas -->
    <main class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-9 content" role="main">
                    <input type="text" class="form-control" placeholder="Ex.: dd/mm/aaaa" data-mask="000.000.000-00" maxlength="10" autocomplete="off">
                </div>
                <aside class="col-md-3 sidebar" role="complementary">
                    Sidebar
                </aside>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-menu">
            <nav class="container">
                <h2 class="title-footer">suporte e ajuda</h2>
                <ul class="no-liststyle">
                    <li><a href="#" class="bg-customer-support"><span class="visible-lg">Atendimento</span></a></li>
                    <li><a href="#" class="bg-my-tickets"><span class="visible-lg">Meus Chamados</span></a></li>
                    <li><a href="#" class="bg-help-desk"><span class="visible-lg">Central de Ajuda (Wiki)</span></a></li>
                    <li><a href="#" class="bg-statusblog"><span class="visible-lg">Statusblog</span></a></li>
                </ul>
            </nav>
        </div>
        <div class="container footer-info">
            <span class="last-access ico-screen"><strong>Último acesso: </strong>7/8/2011 22:35:49</span>
            <div class="set-ip"><span class="set-ip"><strong>IP:</strong> 201.87.65.217</span></div>
            <p class="copy-right">Copyright © 1997-2011 Locaweb Serviços de Internet S/A.</p>
        </div>
    </footer>

    <!-- Scripts - Atente-se na ordem das chamadas -->
    <script type="text/javascript" src="//code.jquery.com/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="//assets.locaweb.com.br/locastyle/2.0.6/javascripts/locastyle.js"></script>
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</body>

</html>
Locaweb StyleCopyright © 1997-2014 Locaweb Serviços de Internet S/A.
Todo o conteúdo deste site é de uso exclusivo da Locaweb.