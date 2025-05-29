<?php
if(!isset($_SESSION)) {
    session_start();
}

// Incluir o Controller de ExperienciaProfissional
require_once '../controller/ExperienciaProfissionalController.php';

$experienciaController = new ExperienciaProfissionalController();
$experiencias = [];

// Lógica para lidar com as ações (inserir, remover, etc.)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao'])) {
        $acao = $_POST['acao'];
        if ($acao === 'inserir') {
            $inicio = $_POST['inicio'];
            $fim = $_POST['fim'];
            $empresa = $_POST['empresa'];
            $descricao = $_POST['descricao'];
            $idusuario = $_SESSION['idusuario'] ?? 1; // Usar ID do usuário logado, ou um default para teste

            if ($experienciaController->inserir($idusuario, $inicio, $fim, $empresa, $descricao)) {
                $mensagem = "Experiência profissional inserida com sucesso!";
            } else {
                $mensagem = "Erro ao inserir experiência profissional.";
            }
        } elseif ($acao === 'remover') {
            $id = $_POST['id'];
            if ($experienciaController->remover($id)) {
                $mensagem = "Experiência profissional removida com sucesso!";
            } else {
                $mensagem = "Erro ao remover experiência profissional.";
            }
        }
        // Adicionar lógica para atualizar futuramente, se necessário
    }
}

// Listar as experiências para o usuário logado
$idusuario_logado = $_SESSION['idusuario'] ?? 1; // Usar ID do usuário logado, ou um default para teste
$experiencias = $experienciaController->listarPorUsuario($idusuario_logado);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Experiências Profissionais</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: auto; background: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1, h2 { color: #333; }
        form { display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px; }
        form input[type="date"], form input[type="text"], form textarea { padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        form button { padding: 10px 15px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        form button:hover { background: #0056b3; }
        .mensagem { padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .sucesso { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .erro { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .acao-buttons { display: flex; gap: 5px; }
        .acao-buttons button { background-color: #dc3545; }
        .acao-buttons button:hover { background-color: #c82333; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gerenciar Experiências Profissionais</h1>

        <?php if (isset($mensagem)): ?>
            <div class="mensagem <?php echo strpos($mensagem, 'sucesso') !== false ? 'sucesso' : 'erro'; ?>">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <h2>Adicionar Nova Experiência</h2>
        <form action="" method="POST">
            <input type="hidden" name="acao" value="inserir">
            <label for="inicio">Data de Início:</label>
            <input type="date" id="inicio" name="inicio" required>

            <label for="fim">Data de Fim:</label>
            <input type="date" id="fim" name="fim" required>

            <label for="empresa">Empresa:</label>
            <input type="text" id="empresa" name="empresa" placeholder="Nome da Empresa" required>

            <label for="descricao">Descrição das Atividades:</label>
            <textarea id="descricao" name="descricao" rows="4" placeholder="Descreva suas responsabilidades e conquistas" required></textarea>

            <button type="submit">Adicionar Experiência</button>
        </form>

        <h2>Minhas Experiências</h2>
        <?php if (!empty($experiencias)): ?>
        <table>
            <thead>
                <tr>
                    <th>Início</th>
                    <th>Fim</th>
                    <th>Empresa</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($experiencias as $experiencia): ?>
                <tr>
                    <td><?php echo htmlspecialchars($experiencia->getInicio()); ?></td>
                    <td><?php echo htmlspecialchars($experiencia->getFim()); ?></td>
                    <td><?php echo htmlspecialchars($experiencia->getEmpresa()); ?></td>
                    <td><?php echo htmlspecialchars($experiencia->getDescricao()); ?></td>
                    <td class="acao-buttons">
                        <form action="" method="POST" style="display:inline;">
                            <input type="hidden" name="acao" value="remover">
                            <input type="hidden" name="id" value="<?php echo $experiencia->getIdExperienciaProfissional(); ?>">
                            <button type="submit">Remover</button>
                        </form>
                        </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>Nenhuma experiência profissional cadastrada.</p>
        <?php endif; ?>
    </div>
</body>
</html>