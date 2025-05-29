<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Administrador</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 900px;
            text-align: center;
        }
        h2 {
            color: #28a745; /* Verde para o dashboard */
            text-align: center;
            margin-bottom: 20px;
            font-size: 32px;
        }
        .welcome-message {
            margin-bottom: 25px;
            font-size: 18px;
            color: #555;
        }
        .dashboard-menu {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        .menu-item {
            background-color: #007BFF; /* Azul */
            color: white;
            padding: 25px 35px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            min-width: 200px;
            text-align: center;
        }
        .menu-item:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }
        .logout-btn {
            background-color: #dc3545; /* Vermelho para logout */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            margin-top: 40px;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Dashboard do Administrador</h2>

        <?php
        // Iniciar sessão se ainda não estiver iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Exibir mensagem de boas-vindas com o nome do administrador
        if (isset($_SESSION['administrador_nome'])) {
            echo '<p class="welcome-message">Bem-vindo(a), ' . htmlspecialchars($_SESSION['administrador_nome']) . '!</p>';
        } else {
            echo '<p class="welcome-message">Bem-vindo(a), Administrador!</p>';
        }
        ?>

        <div class="dashboard-menu">
            <a href="index.php?action=listarUsuarios" class="menu-item">
                Gerenciar Usuários
            </a>
            </div>

        <a href="index.php?action=logoutAdmin" class="logout-btn">Sair</a>
    </div>
</body>
</html>