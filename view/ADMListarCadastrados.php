<<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuários Cadastrados</title>
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
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1200px;
        }
        h2 {
            color: #2196F3;
            text-align: center;
            margin-bottom: 20px;
        }
        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .user-table th, .user-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .user-table th {
            background-color: #f2f2f2;
            color: #333;
        }
        .visualizar-btn {
            background-color: #008CBA;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }
        .visualizar-btn:hover {
            background-color: #0077a3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Usuários Cadastrados</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data de Nascimento</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (isset($usuarios) && !empty($usuarios)) {
                        foreach ($usuarios as $usuario) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($usuario->getIdusuario()) . "</td>";
                            echo "<td>" . htmlspecialchars($usuario->getNome()) . "</td>";
                            echo "<td>" . htmlspecialchars($usuario->getCpf()) . "</td>";
                            echo "<td>" . htmlspecialchars($usuario->getDatanascimento()) . "</td>";
                            echo "<td>" . htmlspecialchars($usuario->getEmail()) . "</td>";
                            echo "<td><a href='index.php?action=visualizarCadastro&id=" . htmlspecialchars($usuario->getIdusuario()) . "' class='visualizar-btn'>Visualizar</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Nenhum usuário cadastrado.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>