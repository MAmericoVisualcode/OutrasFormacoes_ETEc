<?php
if(!isset($_SESSION)) {
    session_start();
}
// Esta variável é para exibir a mensagem de erro se o login falhar
// Ela será definida no index.php se o login falhar e então passada para esta view
$mensagemErro = $mensagemErro ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login de Usuário</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }
        .w3-card-4 {
            width: 30%;
            min-width: 300px; /* Garante que o formulário não fique muito pequeno */
            max-width: 400px;
            padding: 20px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }
        .w3-input {
            margin-bottom: 10px;
        }
        .w3-half .w3-button {
            width: 90%;
            margin-left: 5%;
            margin-right: 5%;
        }
        .mensagem-erro {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<form action="index.php?action=loginUsuario" method="post" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin" style="width: 30%;">
    <input type="hidden" name="nome_form" value="frmLogin" />

    <h2 class="w3-center">Login</h2>

    <?php if (!empty($mensagemErro)): ?>
        <p class="mensagem-erro"><?php echo htmlspecialchars($mensagemErro); ?></p>
    <?php endif; ?>

    <div class="w3-row w3-section">
        <div class="w3-col" style="width:11%"><i class="w3-xxlarge fa fa-user"></i></div>
        <div class="w3-rest">
            <input class="w3-input w3-border w3-round-large" name="email" type="text" placeholder="Email do Usuário">
        </div>
    </div>

    <div class="w3-row w3-section">
        <div class="w3-col" style="width:11%"><i class="w3-xxlarge fa fa-lock"></i></div>
        <div class="w3-rest">
            <input class="w3-input w3-border w3-round-large" name="senha" type="password" placeholder="Senha">
        </div>
    </div>

    <div class="w3-row w3-section">
        <div class="w3-half">
            <button type="submit" class="w3-button w3-block w3-margin w3-blue w3-cell w3-round-large" style="width: 90%;">Entrar</button>
        </div>
        <div class="w3-half">
            <a href="index.php?action=primeiroAcesso" class="w3-button w3-block w3-margin w3-blue w3-cell w3-round-large" style="width: 90%; text-decoration: none;">Primeiro Acesso?</a>
        </div>
    </div>

</form>
</body>
</html>