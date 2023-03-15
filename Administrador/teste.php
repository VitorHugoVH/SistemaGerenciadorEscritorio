<?php
if (isset($_POST['decompor'])) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST">
        <label for="valor">Escreva um valor</label>
        <input type="number" name="valor" id="valor" placeholder="Digite um valor" maxlength="1000000" minlength="1"><br>
        <input type="submit" value="Decompor" name="decompor" id="decompor">
    </form>
</body>

</html>