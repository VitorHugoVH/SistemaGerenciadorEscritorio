<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <link rel="icon" type="image/x-icon" href="imagens/icon.png"/>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Fraga e Melo Advogados Associados</title>
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<!--HEADER-->
<div class="container-fluid" style="background-color:rgb(180, 180, 180) ;">
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <div class="text-center">
          <a href="index.php"><img src="imagens/logo.jpeg" class="rounded" alt="logo" width="100%" id="logo"></a>
        </div>
      </div>
    </div>
<!--HEADER-->
    <br>
    <!--ÍNICIO DA BARRA DE NAVEGAÇÃO-->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="javascript:void(0)">Home</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php#atuacao">Áreas de Atuação</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contato.php">Contato</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="noticias.php">Notícias Jurídicas</a>
              </li>
            </ul>
            <form class="d-flex" style="margin: 5px; margin-left: 0px;">
              <a href="login.php"><button class="btn btn-primary" type="button">Login</button></a>
            </form>
          </div>
        </div>
      </nav>
    <!--FINAL DA BARRA DE NAVEGAÇÃO-->
    <!--Carrousel-->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="imagens/carrousel3.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="imagens/carrousel1.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="imagens/carrousel2.jpg" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <!--FIM Carrousel-->
      <!--PROFISSIONAIS-->
      <br>
      <hr>
      <h1 style="color: black; text-align: center;">PROFISSIONAIS</h1>
      <br> 
      <div class="row">
        <div class="col-sm-6" style="border:solid 10px rgb(180, 180, 180);padding: 6%; background-color: rgb(255, 255, 255);">
            <h2 class="nome">Sandro Carvalho de Fraga</h2>
            <h3 class="nome">OAB/RS 52.230</h3>
            <p class="nome">Formado em 1999 pela Universidade Luterana do Brasil, pós Graduado em Cooperativismo pela PUC-RS Pontifícia Universidade Católica do Rio Grande do Sul, advogado militante desde 1999.</p>
            <br>
            <p class="nome">Contato: e-mail: sandro@fragaemeloadvogados.adv.br - Fone: 51 98402-6629</p>
        </div>
        <div class="col-sm-6" style="border:solid 10px rgb(180, 180, 180);padding: 6%; background-color: white;">
            <h2 class="nome">Elisete Camargo de Melo</h2>
            <h3 class="nome">OAB/SC 65356-B</h3>
            <p class="nome">Formada em 2009, pelo Centro Universitário Ritter dos Reis, advogada militante desde 2010.</p>
            <br>
            <p class="nome">Contato:e-mail: elisete@fragaemeloadvogados.adv.br Fone: 51 99415-6949</p>
        </div>
      </div>
      <!--FIM PROFISSIONAIS-->
      <!--INICIO AREA DE ATUAÇÂO-->
      <br>
      <hr>
      <h1 style="color: black; text-align: center;">ÁREAS DE ATUAÇÃO</h1>
      <br>
      <div class="row" id="atuacao">
        <div class="col-sm-4">
          <img src="imagens/empresarial.png" width="100%" style="margin-top: 4%;" class="atuacao">
        </div>
        <div class="col-sm-4">
          <img src="imagens/trabalho.png" width="100%" style="margin-top: 4%;" class="atuacao">
        </div>
        <div class="col-sm-4">
          <img src="imagens/civil.png" width="100%" style="margin-top: 4%;" class="atuacao">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-sm-4">
          <img src="imagens/familiar.png" width="100%" style="margin-top: 4%;" class="atuacao">
        </div>
        <div class="col-sm-4">
          <img src="imagens/consumidor.png" width="100%" style="margin-top: 4%;" class="atuacao">
        </div>
        <div class="col-sm-4">
          <img src="imagens/cooperativo.png" width="100%" style="margin-top: 4%;" class="atuacao">
        </div>
      </div>
      <!--FINAL AREA DE ATUAÇÃO-->
      <!--INICIO NOTICIAS JURIDICAS-->
      <br>
      <hr>
      <h1 style="color: black; text-align: center;">NOTÍCIAS JURÍDICAS</h1>
      <br>
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row row-cols-1 row-cols-md-3 g-4">
              <div class="col">
                <div class="card h-100">
                  <img src="imagens/preso.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Cantor sertanejo Luciano condenado a pagar R$ 30 mil por dano moral</h5>
                    <p class="card-text">Atuou em nome do autor o advogado <b>Sandro Carvalho de Fraga</b>. (Proc. nº 70033952011 - com informações do TJRS e da redação do Espaço Vital).              </p>
                    <a href="https://espaco-vital.jusbrasil.com.br/noticias/2163393/cantor-sertanejo-luciano-condenado-a-pagar-r-30-mil-por-dano-moral" target="_blank" class="btn btn-primary">Saiba Mais</a>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card h-100">
                  <img src="imagens/herança.png" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Filiação Biológica e Afetiva dá Direito a Dupla Herança</h5>
                    <p class="card-text">(STJ - REsp: 1487596 MG 2014/0263479-6, Relator: Ministro ANTONIO CARLOS FERREIRA, Data de Julgamento: 28/09/2021, T4 - QUARTA TURMA, Data de Publicação: DJe 01/10/2021 RMDCPC vol. 104 p. 169 RSTJ vol. 263 p. 629) <a href="https://roggerreis.jusbrasil.com.br/" target="_blank">Publicado por Dr Rogger Carvalho Reis</a></p>
                    <a href="https://roggerreis.jusbrasil.com.br/noticias/1515672480/filiacao-biologica-e-afetiva-da-direito-a-dupla-heranca" target="_blank" class="btn btn-primary">Saiba Mais</a>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card h-100">
                  <img src="imagens/parto.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Demitida semanas após parto de natimortos, trabalhadora será indenizada</h5>
                    <p class="card-text">"A ausência de cumprimento da previsão contida na resolução do conselho Federal de Medicina 1.779/05, quanto à obrigatoriedade de fornecimento, pelo médico, de declaração de óbito por morte fetal, não pode vir em prejuízo da gestante. O objetivo da norma não é desproteger a mulher." - declara o desembargador Luís Henrique Rafael. <a href="https://isaiasrufinoadv.jusbrasil.com.br/" target="_blank">Publicado por Isaias Rufino de Souza</a></p>
                    <a href="https://isaiasrufinoadv.jusbrasil.com.br/noticias/1514735788/demitida-semanas-apos-parto-de-natimortos-trabalhadora-sera-indenizada" target="_blank" class="btn btn-primary">Saiba Mais</a>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="row row-cols-1 row-cols-md-3 g-4">
              <div class="col">
                <div class="card h-100">
                  <img src="imagens/pensão.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">O que fazer quando há atraso de pensão?</h5>
                    <p class="card-text">“ Art. 244. Deixar, sem justa causa, de prover a subsistência do cônjuge, ou do filho menor de 18 anos ou inapto para o trabalho, ou de ascendente inválido ou maior de 60 anos, não lhes proporcionando os recursos necessários ou faltando ao pagamento de pensão alimentícia judicialmente acordada, fixada ou majorada; deixar, sem justa causa, de socorrer descendente ou ascendente, gravemente enfermo: (Redação dada pela Lei nº 10.741, de 2003) <a href="https://drbrunoduraoadvocacia584768.jusbrasil.com.br/" target="_blank">Publicado por Bruno Durao</a></p>
                    <a href="https://drbrunoduraoadvocacia584768.jusbrasil.com.br/noticias/1514388327/o-que-fazer-quando-ha-atraso-de-pensao" target="_blank" class="btn btn-primary">Saiba Mais</a>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card h-100">
                  <img src="imagens/extras.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Horas Extras</h5>
                    <p class="card-text">Em uma Reclamação Trabalhista, você sabe a quem recai o ônus da prova quando o assunto é horas extras? Pode variar, a depender do caso concreto. Confira as regras a seguir. <a href="https://genivaldeoliveira.jusbrasil.com.br/" target="_blank">Publicado por Genival de Oliveira</a></p>
                    <a href="https://genivaldeoliveira.jusbrasil.com.br/noticias/1512654507/horas-extras" target="_blank" class="btn btn-primary">Saiba Mais</a>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card h-100">
                  <img src="imagens/vacina.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Mulher que teve reação após tomar vacina da gripe não tem direito a indenização</h5>
                    <p class="card-text">Os benefícios que a imunização em massa da população oferece à coletividade são muito superiores a eventuais intercorrências individuais em razão da aplicação das vacinas. <a href="https://enviarsolucoes.jusbrasil.com.br/" target="_blank">Publicado por Enviar Soluções</a></p>
                    <a href="https://enviarsolucoes.jusbrasil.com.br/noticias/1513985679/mulher-que-teve-reacao-apos-tomar-vacina-da-gripe-nao-tem-direito-a-indenizacao" target="_blank" class="btn btn-primary">Saiba Mais</a>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!--FINAL NOTICIAS JURIDICAS-->
    <!--AVALIAÇÃO DOS CLIENTES-->
    <br>
    <hr>
    <h1 style="color: black; text-align: center;">AVALIAÇÃO DOS CLIENTES</h1>
    <br>
    <div class="text-center">
      <img src="imagens/estrelas.png" class="rounded" alt="logo" width="30%" id="estrelinha">
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="card border-dark mb-3" style="max-width: 25rem;">
          <div class="card-header">
            <div class="text-center">
              <img src="imagens/mulher.png" class="rounded">
            </div>
          </div>
          <div class="card-body text-dark">
            <h5 class="card-title">Luana Palhares</h5>
            <p class="card-text">Pessoas Maravilhosa Muito Atenciosos e sempre Disponíveis quando precisamos.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card border-dark mb-3" style="max-width: 25rem;">
          <div class="card-header">
            <div class="text-center">
              <img src="imagens/homem.png" class="rounded">
            </div>
          </div>
          <div class="card-body text-dark">
            <h5 class="card-title">Alceu José Pinto</h5>
            <p class="card-text"> INTELIGÊNCIA E COMPETÊNCIA Parabéns aos Advogados</p>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card border-dark mb-3" style="max-width: 25rem;">
          <div class="card-header">
            <div class="text-center">
              <img src="imagens/homem.png" class="rounded">
            </div>
          </div>
          <div class="card-body text-dark">
            <h5 class="card-title">Vitor Hugo</h5>
            <p class="card-text">Ótimos Advogados, 100% empenhados no Trabalho. Parabéns.</p>
          </div>
        </div>
      </div>
    </div>
    <!--INÍCIO FOOTER-->
    <div class="content">
    </div>
        <footer id="myFooter">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <h5>Inicio</h5>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="index.php#atuacao">Áreas de Atuação</a></li>
                            <li><a href="contato.php">Contato</a></li>
                            <li><a href="noticias.php">Notícias Jurídicas</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <h5>Sobre nós</h5>
                        <ul>
                            <li><a href="#">Contato</a></li>
                            <li><a href="https://www.facebook.com/fragaemeloadvogadosassociados">Blog</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 info">
                        <h5>Informações</h5>
                        <p> Nosso escritório atua na área do direito empresarial, assessorando empresários, nas tomadas de decisões, bem como atuamos no contencioso de demandas cíveis e trabalhistas.
                          Prestamos serviços de advocacia na área do direito de família e consumidor, possuímos ainda vasta experiência no ramo do cooperativismo. </p>
                    </div>
                </div>
            </div>
            <div class="second-bar">
              <br>
              <br>
            </div>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--FINAL FOOTER-->
</div>
</body>
</html>