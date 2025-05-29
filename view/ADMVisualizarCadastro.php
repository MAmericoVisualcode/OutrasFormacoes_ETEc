<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Cadastro</title>
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
            width: 80%;
            max-width: 900px;
            margin-bottom: 20px;
        }
        h2 {
            color: #2196F3;
            text-align: center;
            margin-bottom: 20px;
        }
        .user-info {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #e9f7ff;
        }
        .user-info p {
            margin: 5px 0;
            color: #333;
        }
        .other-formations {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
        .other-formations h3 {
            color: #4CAF50;
            margin-top: 0;
            margin-bottom: 15px;
            text-align: center;
        }
        .form-add-of label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }
        .form-add-of input[type="date"],
        .form-add-of input[type="text"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-add-of button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-add-of button:hover {
            background-color: #45a049;
        }
        .table-of {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table-of th, .table-of td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table-of th {
            background-color: #f2f2f2;
            color: #333;
        }
        .table-of .delete-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        .table-of .delete-btn:hover {
            background-color: #d32f2f;
        }
        .back-btn {
            background-color: #008CBA;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }
        .back-btn:hover {
            background-color: #0077a3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Informações do Cadastro</h2>
        <div class="user-info">
            <?php
                if (isset($usuario)) {
                    echo "<p><strong>ID:</strong> " . htmlspecialchars($usuario->getIdusuario()) . "</p>";
                    echo "<p><strong>Nome:</strong> " . htmlspecialchars($usuario->getNome()) . "</p>";
                    echo "<p><strong>CPF:</strong> " . htmlspecialchars($usuario->getCpf()) . "</p>";
                    echo "<p><strong>Data de Nascimento:</strong> " . htmlspecialchars($usuario->getDatanascimento()) . "</p>";
                    echo "<p><strong>Email:</strong> " . htmlspecialchars($usuario->getEmail()) . "</p>";
                    // Adicione aqui outros campos que você queira exibir
                } else {
                    echo "<p>Nenhum usuário selecionado.</p>";
                }
            ?>
        </div>

        <div class="other-formations">
            <h3>Outras Formações</h3>
            <div class="form-add-of">
                <label for="txtInicioOF">Início:</label>
                <input type="date" id="txtInicioOF" name="txtInicioOF">

                <label for="txtFimOF">Fim:</label>
                <input type="date" id="txtFimOF" name="txtFimOF">

                <label for="txtDescricaoOF">Descrição:</label>
                <input type="text" id="txtDescricaoOF" name="txtDescricaoOF">

                <button id="btnAddOF">Adicionar Formação</button>
            </div>

            <table class="table-of">
                <thead>
                    <tr>
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Descrição</th>
                        <th>Apagar</th>
                    </tr>
                </thead>
                <tbody id="tableBodyOF">
                    <?php
                        if (isset($outrasFormacoes) && !empty($outrasFormacoes)) {
                            foreach ($outrasFormacoes as $formacao) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($formacao->getInicio()) . "</td>";
                                echo "<td>" . htmlspecialchars($formacao->getFim()) . "</td>";
                                echo "<td>" . htmlspecialchars($formacao->getDescricao()) . "</td>";
                                echo "<td><button class='delete-btn' data-id='" . htmlspecialchars($formacao->getIdoutrasformacoes()) . "'>Apagar</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Nenhuma outra formação cadastrada.</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <a href="ADMListarCadastrados.php" class="back-btn">Voltar</a>
    </div>

    <script>
        document.getElementById('btnAddOF').addEventListener('click', function() {
            const inicio = document.getElementById('txtInicioOF').value;
            const fim = document.getElementById('txtFimOF').value;
            const descricao = document.getElementById('txtDescricaoOF').value; // CAMPO RENOMEADO AQUI
            const userId = <?php echo isset($usuario) ? $usuario->getIdusuario() : 'null'; ?>;
            const tableBodyOF = document.getElementById('tableBodyOF');

            if (userId) {
                fetch('processarAdicionarOutraFormacao.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `idusuario=<span class="math-inline">\{userId\}&inicio\=</span>{inicio}&fim=<span class="math-inline">\{fim\}&descricao\=</span>{descricao}`
                })
                .then(response => response.text())
                .then(data => {
                    // AQUI COMEÇA A MUDANÇA PARA O AJAX OTIMIZADO (Item 2)
                    if (!isNaN(data) && parseInt(data) > 0) { // Verifica se 'data' é um número (o ID)
                        const newId = parseInt(data); // Converte para número inteiro

                        // Remove a linha "Nenhuma outra formação cadastrada." se ela existir
                        const noFormationsRow = tableBodyOF.querySelector('tr td[colspan="4"]');
                        if (noFormationsRow) {
                            noFormationsRow.parentNode.remove();
                        }

                        const newRow = tableBodyOF.insertRow();
                        const cellInicio = newRow.insertCell();
                        const cellFim = newRow.insertCell();
                        const cellDescricao = newRow.insertCell();
                        const cellApagar = newRow.insertCell();

                        cellInicio.textContent = inicio;
                        cellFim.textContent = fim;
                        cellDescricao.textContent = descricao;
                        // Atribui o ID real ao botão de apagar obtido na resposta AJAX
                        cellApagar.innerHTML = `<button class="delete-btn" data-id="${newId}" onclick="handleDeleteButtonClick(this)">Apagar</button>`;

                        // Limpa os campos do formulário
                        document.getElementById('txtInicioOF').value = '';
                        document.getElementById('txtFimOF').value = '';
                        document.getElementById('txtDescricaoOF').value = '';
                    } else if (data === 'erro_inserir') {
                        alert('Erro ao adicionar formação. Tente novamente.');
                    } else if (data === 'dados_invalidos') {
                        alert('Por favor, preencha todos os campos obrigatórios.');
                    } else {
                        alert('Erro desconhecido ao adicionar formação: ' + data); // Mostra o que veio de erro
                    }
                })
                .catch((error) => {
                    console.error('Erro ao adicionar formação:', error);
                    alert('Erro de rede ao adicionar formação.');
                });
            } else {
                alert('ID do usuário não encontrado.');
            }
        });

        // Reatacha os event listeners para os botões de delete existentes (no carregamento da página)
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                handleDeleteButtonClick(this);
            });
        });

        // Função para lidar com o clique no botão de apagar (usada tanto no carregamento quanto para novos elementos)
        function handleDeleteButtonClick(button) {
            const idOutraFormacao = button.getAttribute('data-id');
            const rowToDelete = button.closest('tr');

            if (confirm('Tem certeza que deseja apagar esta formação?')) {
                fetch('processarApagarOutraFormacao.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `idoutrasformacoes=${idOutraFormacao}`
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'sucesso') {
                        rowToDelete.remove();
                        // Opcional: Se a tabela ficar vazia, adicionar a mensagem "Nenhuma formação cadastrada."
                        const tableBodyOF = document.getElementById('tableBodyOF');
                        if (tableBodyOF.rows.length === 0) {
                            const newRow = tableBodyOF.insertRow();
                            const cell = newRow.insertCell();
                            cell.colSpan = 4;
                            cell.textContent = 'Nenhuma outra formação cadastrada.';
                        }
                    } else if (data === 'erro_excluir') {
                        alert('Erro ao apagar formação. Tente novamente.');
                    } else if (data === 'id_invalido') {
                        alert('ID da formação inválido.');
                    } else {
                        alert('Erro desconhecido ao apagar formação.');
                    }
                })
                .catch((error) => {
                    console.error('Erro ao apagar formação:', error);
                    alert('Erro de rede ao apagar formação.');
                });
            }
        }
    </script>
</body>
</html>