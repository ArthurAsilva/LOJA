<?php include 'cabecalho.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 style="color: #c4a7e7;"><i class="fas fa-list me-2"></i>Lista de mantimentos</h2>
    <a href="form_cadastrar.php" class="btn btn-primary" style="background: linear-gradient(45deg, #6b48d6, #8a6dd9); border: none;">
        <i class="fas fa-plus me-1"></i>novo produto
    </a>
</div>

<?php
if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="background: rgba(40, 167, 69, 0.8); border: 1px solid rgba(46, 204, 113, 0.4); color: #d4edda;">
            <strong>Sucesso!</strong> Produto listado nos mantimentos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}

if (isset($_GET['atualizado']) && $_GET['atualizado'] == 1) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="background: rgba(40, 167, 69, 0.8); border: 1px solid rgba(46, 204, 113, 0.4); color: #d4edda;">
            <strong>Sucesso!</strong> Produto atualizado com êxito.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}

if (isset($_GET['excluido']) && $_GET['excluido'] == 1) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="background: rgba(40, 167, 69, 0.8); border: 1px solid rgba(46, 204, 113, 0.4); color: #d4edda;">
            <strong>Sucesso!</strong> Produto excluído com êxito.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}
?>

<div class="card shadow" style="background: rgba(15, 30, 55, 0.7); border: 1px solid rgba(102, 153, 204, 0.2);">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark" style="background: rgba(26, 53, 93, 0.8);">
                    <tr>
                        <th scope="col" style="color: #c4a7e7;">ID</th>
                        <th scope="col" style="color: #c4a7e7;">NOME</th>
                        <th scope="col" style="color: #c4a7e7;">PREÇO (R$)</th>
                        <th scope="col" style="color: #c4a7e7;">QUANTIDADE</th>
                        <th scope="col" class="text-center" style="color: #c4a7e7;">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'conexao.php';
                    
                    $tableExists = $pdo->query("SHOW TABLES LIKE 'produtos'")->rowCount() > 0;
                    
                    if ($tableExists) {
                        $sql = "SELECT * FROM produtos ORDER BY id DESC";
                        $stmt = $pdo->query($sql);
                        
                        if ($stmt->rowCount() > 0) {
                            while ($produto = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td style='color: #d8c8f0;'>" . $produto['id'] . "</td>";
                                echo "<td style='color: #d8c8f0;'>" . htmlspecialchars($produto['nome']) . "</td>";
                                echo "<td style='color: #d8c8f0;'>R$ " . number_format($produto['preco'], 2, ',', '.') . "</td>";
                                echo "<td style='color: #d8c8f0;'>" . $produto['quantidade'] . "</td>";
                                echo "<td class='text-center'>";
                                echo "<div class='btn-group' role='group'>";
                                echo "<a href='form_atualizar.php?id=" . $produto['id'] . "' class='btn btn-sm me-1' style='background: linear-gradient(45deg, #6b48d6, #8a6dd9); border: none; color: white;'>";
                                echo "<i class='fas fa-edit me-1'></i>Editar</a>";
                                echo "<a href='delete.php?id=" . $produto['id'] . "' class='btn btn-sm' 
                                      onclick='return confirm(\"Tem certeza que deseja excluir este produto?\")'
                                      style='background: linear-gradient(45deg, #4a86e8, #6699cc); border: none; color: white;'>";
                                echo "<i class='fas fa-trash me-1'></i>Excluir</a>";
                                echo "</div>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center py-4' style='color: #c4a7e7;'>Nenhum produto cadastrado.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center py-4' style='color: #c4a7e7;'>Tabela de produtos não existe. <a href='form_cadastrar.php' style='color: #88ccff;'>Cadastre o primeiro produto</a> para criá-la automaticamente.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="index.php" class="btn btn-outline-light" style="border: 1px solid rgba(102, 153, 204, 0.3); color: #c4a7e7;">
        <i class="fas fa-arrow-left me-1"></i>Voltar para a nave
    </a>
</div>

<?php include 'rodape.php'; ?>