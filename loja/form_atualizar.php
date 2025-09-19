<?php
// Incluir o cabeçalho apenas se não houver redirecionamentos
$redirect = false;

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: listar.php');
    $redirect = true;
}

$id = $_GET['id'];

require 'conexao.php';

// Verificar se a tabela existe
$tableExists = $pdo->query("SELECT 1 FROM information_schema.tables WHERE table_name = 'produtos'")->rowCount() > 0;

if ($tableExists) {
    $sql = "SELECT * FROM produtos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        header('Location: listar.php');
        $redirect = true;
    }
} else {
    header('Location: listar.php');
    $redirect = true;
}

// Se houver redirecionamento, terminar a execução
if ($redirect) {
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $preco = $_POST['preco'] ?? 0;
    $quantidade = $_POST['quantidade'] ?? 0;
    
    $sqlUpdate = "UPDATE produtos SET nome = :nome, preco = :preco, quantidade = :quantidade WHERE id = :id";
    $stmtUpdate = $pdo->prepare($sqlUpdate);
    $stmtUpdate->bindParam(':nome', $nome);
    $stmtUpdate->bindParam(':preco', $preco);
    $stmtUpdate->bindParam(':quantidade', $quantidade);
    $stmtUpdate->bindParam(':id', $id);
    
    if ($stmtUpdate->execute()) {
        header('Location: listar.php?atualizado=1');
        exit;
    } else {
        $erro = "Erro ao atualizar produto.";
    }
}

// Só incluir o cabeçalho HTML se não houve redirecionamento
include 'cabecalho.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto - CRUD Loja Espacial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Estilos específicos para a página de edição */
        .card {
            background: rgba(15, 30, 55, 0.7);
            border: 1px solid rgba(102, 153, 204, 0.2);
            border-radius: 12px;
            backdrop-filter: blur(5px);
            box-shadow: 0 8px 20px rgba(0, 20, 40, 0.3);
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #4a86e8, #6699cc);
            border: none;
            border-radius: 6px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background: linear-gradient(45deg, #3a76d8, #5588bb);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 20, 40, 0.4);
        }
        
        .card-header.bg-dark-custom {
            background: rgba(26, 53, 93, 0.7) !important;
            border-bottom: 1px solid rgba(102, 153, 204, 0.3);
        }
        
        .form-label {
            color: #e6e6e6;
        }
        
        .form-control {
            background: rgba(20, 40, 70, 0.3);
            border: 1px solid rgba(102, 153, 204, 0.2);
            color: #e6e6e6;
        }
        
        .form-control:focus {
            background: rgba(20, 40, 70, 0.5);
            border-color: rgba(102, 153, 204, 0.4);
            color: #e6e6e6;
            box-shadow: 0 0 0 0.2rem rgba(102, 153, 204, 0.25);
        }
        
        .card-footer {
            background: rgba(26, 53, 93, 0.6);
            border-top: 1px solid rgba(102, 153, 204, 0.2);
        }
        
        .btn-outline-light {
            border: 1px solid rgba(102, 153, 204, 0.3);
            color: #e6e6e6;
        }
        
        .btn-outline-light:hover {
            background: rgba(102, 153, 204, 0.2);
            color: #88ccff;
        }
        
        .alert-danger {
            background: rgba(120, 30, 60, 0.7);
            border: 1px solid rgba(200, 70, 100, 0.4);
            color: #ffccd5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-dark-custom">
                        <h3 class="card-title mb-0"><i class="fas fa-edit me-2"></i>editar Produto</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($erro)): ?>
                            <div class="alert alert-danger"><?php echo $erro; ?></div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">nome do produto</label>
                                <input type="text" name="nome" class="form-control" value="<?php echo htmlspecialchars($produto['nome']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">preço (R$)</label>
                                <input type="number" step="0.01" name="preco" class="form-control" value="<?php echo $produto['preco']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">quantidade em estoque</label>
                                <input type="number" name="quantidade" class="form-control" value="<?php echo $produto['quantidade']; ?>" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i>atualizar mantimentos
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="listar.php" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>voltar para a nave
                        </a>
                        <div class="card-footer text-muted">
                        <a href="listar.php" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>voltar para o planeta lista
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>