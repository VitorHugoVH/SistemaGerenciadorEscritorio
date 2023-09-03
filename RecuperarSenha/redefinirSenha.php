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
  <style>
    /* Estilo do container */
    .container {
      text-align: center;
      margin-top: 20px;
    }

    /* Estilo do código de entrada */
    .codigo-input {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 150px;
      height: 40px;
    }

    /* Estilo do campo de entrada */
    .codigo-input input {
      width: 20px;
      height: 30px;
      font-size: 18px;
      text-align: center;
      border: 2px solid #007BFF;
      border-radius: 5px;
      outline: none;
      background-color: #f0f0f0;
      color: #007BFF;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="login-page">
      <div class="text-center">
        <a href="../index.php"><img src="../imagens/advogado3.jpeg" width="100%" margin-bottom="0px"></a>
      </div>
      <div class="form">
        <form class="enviar" action="atualizarSenha.php" method="POST">
          <div class="input-group">
            <input type="password" name="novaSenha" id="novaSenha" class="form-control" placeholder="Nova senha" required>
            <div class="input-group-append" name="naover" id="naover" style="display: block;">
              <a class='btn btn-sm btn-primary align-middle' onclick="ver()">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="40" fill="currentColor" class="bi bi-eye-slash-fill align-middle" viewBox="0 0 16 16">
                  <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                  <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                </svg>
              </a>
            </div>
            <div class="input-group-append" name="ver" id="ver" style="display: none;">
              <a class='btn btn-sm btn-primary align-middle' onclick="naover()">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="40" fill="currentColor" class="bi bi-eye-fill align-middle" viewBox="0 0 16 16">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                </svg>
              </a>
            </div>
          </div>
          <input type="password" name="confirmarSenha" id="confirmarSenha" class="form-control" placeholder="Confirmar senha" required>
          <a><button class="btn btn-primary" type="submit" name="redefinirSenha" onclick="return validatePasswords();">Redefinir Senha</button></a>
        </form>
        <a href="../login.php" style="text-decoration: none;"><p style="text-decoration: none; margin-top: 5%;">Voltar para área de login</p></a>
      </div>
    </div>
  </div>
  <script>
    function validarFormulario() {
      var codigo = document.getElementById("codigo").value;

      if (codigo.trim() === "") {
        alert("Por favor, preencha todos os campos.");
        return false; // Impede o envio do formulário
      }

      return true; // Permite o envio do formulário
    }

    function ver() {
      document.getElementById('novaSenha').type = 'text';
      document.getElementById('naover').style.display = 'none';
      document.getElementById('ver').style.display = 'block';
    }

    function naover() {
      document.getElementById('novaSenha').type = 'password';
      document.getElementById('naover').style.display = 'block';
      document.getElementById('ver').style.display = 'none';
    }

    function validatePasswords() {
      var novaSenha = document.getElementById("novaSenha").value;
      var confirmarSenha = document.getElementById("confirmarSenha").value;

      if (novaSenha !== confirmarSenha) {
      alert("As senhas não coincidem!");
        return false; 
      }
        return true;
      }
  </script>
</body>

</html>
