<!DOCTYPE html>

<?php

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? NULL;

if (!$logged) {
  header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
};

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilosAdm.css"/>
    <link rel="icon" type="image/x-icon" href="imagens/icon.png"/>
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css"/>
    <title>Fraga e Melo Advogados Associados</title>
</head>
<body>
   
    <div class="wrapper">
       <div class="section">
    <div class="top_navbar">
      <div class="hamburger">
        <a href="#">
          <i class="fas fa-bars"></i>
        </a>
      </div>
      <a href="/Users/vh007/OneDrive/%C3%81rea%20de%20Trabalho/Tudo/Site%20TCC/Site%20Fraga%20e%20Melo%20BootsTrap/index.php" class="link"><button class="button button4">Voltar</button></a>
    </div>
    <div class="container">
      Sistema de Gerenciamento da Advocacia Fraga e Melo Advogados.
    </div>
  </div>
        <div class="sidebar">
            <div class="profile">
                <img src="imagensADM/logoadmin.png" alt="profile_picture" width="35%">
                <h3>Advocacia</h3>
                <p>Fraga e Melo Advogados</p>
            </div>
            <ul class="lista">
                <li>
                    <a href="Deashboard/admin.php">
                        <span class="icon"><i class="fas fa-desktop"></i></span>
                        <span class="item">Deashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/Processos//Processos/processos.php">
                        <span class="icon"><i class="fas fa-scale-balanced"></i></span>
                        <span class="item">Processos</span>
                    </a>
                </li>
                    <div class="dropdown">
                        <li>
                            <a href="agenda.php" class="links">
                                <span class="icon"><i class="fas fa-calendar-days"></i></span>
                                <span class="item">Agenda</span>
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 40%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                </svg>
                            </a>
                        </li>
                        <div class="dropdown-content">
                            <li>
                                <a href="Agenda/Compromissos/agenda_compromissos.php" class="item" style="width: 100%;">
                                    <span class="item2" style="margin-left: 15%;">Compromissos</span>
                                </a>
                            </li>
                            <li>
                                <a href="agenda_tarefas.php" class="links">
                                    <span class="item2" style="margin-left: 15%; width: 100%;">Tarefas</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="links">
                                    <span class="item2" style="margin-left: 15%;">Prazos</span>
                                </a>
                            </li>
                        </div>
                    </div>
                <li>
                    <a href="site_marketing.php" class="links">
                        <span class="icon"><i class="fas fa-rocket"></i></span>
                        <span class="item">Marketing</span>
                    </a>
                </li>
                    <div class="dropdown">
                        <li>
                            <a href="financeiro.php" class="links">
                                <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                                <span class="item">Financeiro</span>
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 30%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                </svg>
                            </a>
                        </li>
                        <div class="dropdown-content">
                            <li>
                                <a href="#" class="links" style="width: 100%;">
                                    <span class="item2" style="margin-left: 15%;">Despesas</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="links">
                                    <span class="item2" style="margin-left: 15%; width: 100%;">Receitas</span>
                                </a>
                            </li>
                        </div>
                    </div>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fas fa-users"></i></span>
                        <span class="item">Equipe</span>
                    </a>
                </li>
                <li>
                    <a href="estatisticas.php">
                        <span class="icon"><i class="fas fa-cloud"></i></span>
                        <span class="item">Arquivos</span>
                    </a>
                </li>
                <li>
                    <a href="configuracoes.php" class="links">
                        <span class="icon"><i class="fas fa-edit"></i></span>
                        <span class="item">Editor de Texto</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>