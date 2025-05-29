<?php
// Inicia a sessão se ainda não estiver iniciada
if(!isset($_SESSION)) {
    session_start();
}

// Variável para mensagens de sucesso ou erro (preenchida pelo controller)
$mensagem = $mensagem ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primeiro Acesso / Cadastro</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .w3-card-4 {
            width: 40%;
            min-width: 400px;
            max-width: 600px;
            padding: 30px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }
        h2 {
            color: #2196F3;
            text-align: center;
            margin-bottom: 20px;
        }
        .w3-input {
            margin-bottom: 15px;
        }
        .mensagem-sucesso {
            color: green;
            text-align: center;
            margin-bottom: 15px;
        }
        .mensagem-erro {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
        .w3-button {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form action="index.php?action=cadastrarUsuario" method="post" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
        <h2 class="w3-center">Primeiro Acesso / Cadastro</h2>

        <?php if (!empty($mensagem)): ?>
            <p class="<?php echo (strpos($mensagem, 'sucesso') !== false) ? 'mensagem-sucesso' : 'mensagem-erro'; ?>">
                <?php echo htmlspecialchars($mensagem); ?>
            </p>
        <?php endif; ?>

        <div class="w3-section">
            <label for="txtNome">Nome Completo</label>
            <input class="w3-input w3-border w3-round-large" name="txtNome" id="txtNome" type="text" required>
        </div>

        <div class="w3-section">
            <label for="txtCpf">CPF (somente números)</label>
            <input class="w3-input w3-border w3-round-large" name="txtCpf" id="txtCpf" type="text" pattern="\d{11}" title="Insira 11 dígitos numéricos para o CPF" required>
        </div>

        <div class="w3-section">
            <label for="txtDataNascimento">Data de Nascimento</label>
            <input class="w3-input w3-border w3-round-large" name="txtDataNascimento" id="txtDataNascimento" type="date" required>
        </div>

        <div class="w3-section">
            <label for="txtEmail">Email</label>
            <input class="w3-input w3-border w3-round-large" name="txtEmail" id="txtEmail" type="email" required>
        </div>

        <div class="w3-section">
            <label for="txtSenha">Senha</label>
            <input class="w3-input w3-border w3-round-large" name="txtSenha" id="txtSenha" type="password" required>
        </div>

        <div class="w3-section">
            <label for="txtConfirmarSenha">Confirmar Senha</label>
            <input class="w3-input w3-border w3-round-large" name="txtConfirmarSenha" id="txtConfirmarSenha" type="password" required>
        </div>

        <button type="submit" name="btnCadastrar" class="w3-button w3-block w3-blue w3-round-large">Cadastrar</button>

        <a href="index.php?action=loginUsuario" class="w3-button w3-block w3-blue w3-round-large w3-margin-top" style="text-decoration: none;">Voltar para o Login</a>
    </form>
</body>
</html>