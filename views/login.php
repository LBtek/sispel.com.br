<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href=<?php echo BASE_URL."assets/css/login.css"; ?>>
</head>
<body>
    <form method="POST" action=<?php echo BASE_URL."login/logar"; ?>>
        <h3>www.sispel.com.br</h3>
        <br>

        <label for="email">E-mail:</label><br>
        <input type="email" name="email" id="email"><br><br>

        <label for="senha">Senha:</label><br>
        <input type="password" name="senha" id="senha"><br><br>

        <input type="submit" value="Entrar">
        <?php echo isset($msg) ? "<span>".$msg."</span>" : '' ?>
    </form>

</body>
</html>
