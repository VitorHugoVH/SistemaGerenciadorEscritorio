<?php
session_start();

// ... código anterior ...

if (isset($_SESSION['erro'])) {
    echo "<script>alert('" . $_SESSION['erro'] . "');</script>";
    unset($_SESSION['erro']); // Limpa a variável de sessão após exibir a mensagem
}

// ... restante do código ...
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../estilos.css">
  <link rel="icon" type="image/x-icon" href="../imagens/icon.png" />
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <title>Fraga e Melo Advogados Associados</title>
</head>

<body>
  <div class="container">
    <div class="login-page">
      <div class="text-center">
        <a href="../index.php"><img src="../imagens/advogado3.jpeg" width="100%" margin-bottom="0px"></a>
      </div>
      <div class="form">
        <form class="enviar" action="enviaCodigo.php" method="POST" onsubmit="return validarFormulario();">
          <input type="email" class="form-control" name="emailRecuperacao" id="emailRecuperacao" placeholder="Digite seu email">
          <a><button class="btn btn-primary" type="submit" name="enviarCodigo">Enviar código</button></a>
        </form>
        <a href="../login.php" style="text-decoration: none;"><p style="text-decoration: none; margin-top: 5%;">Retornar para o login</p></a>
      </div>
    </div>
  </div>
  <script>
    function validarFormulario() {
      var email = document.getElementById("emailRecuperacao").value;

      if (email.trim() === "") {
        alert("Por favor, preencha todos os campos.");
        return false; // Impede o envio do formulário
      }

      return true; // Permite o envio do formulário
    }
  </script>
</body>

</html>