<?php include 'cabecalho.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow" style="background: rgba(15, 30, 55, 0.7); border: 1px solid rgba(102, 153, 204, 0.2); border-radius: 12px; backdrop-filter: blur(5px); box-shadow: 0 8px 20px rgba(0, 20, 40, 0.3);">
            <div class="card-header" style="background: rgba(26, 53, 93, 0.7); border-bottom: 1px solid rgba(102, 153, 204, 0.3);">
                <h3 class="card-title mb-0" style="color: #c4a7e7; font-weight: 600;">
                    <i class="fas fa-plus-circle me-2" style="color: #c4a7e7;"></i>cadastrar mantimentos
                </h3>
            </div>
            <div class="card-body">
                <?php
                if (isset($_GET['erro'])) {
                    $erro = $_GET['erro'];
                    if ($erro == 1) {
                        echo '<div class="alert alert-danger" style="background: rgba(120, 30, 60, 0.7); border: 1px solid rgba(200, 70, 100, 0.4); color: #ffccd5;">preencha todos os campos!</div>';
                    } else if ($erro == 2) {
                        echo '<div class="alert alert-danger" style="background: rgba(120, 30, 60, 0.7); border: 1px solid rgba(200, 70, 100, 0.4); color: #ffccd5;">Erro ao cadastrar produto. Tente novamente.</div>';
                    }
                }
                ?>
                
                <form action="inserir.php" method="POST" class="mt-3" autocomplete="off">
                    <div class="mb-3">
                        <label class="form-label" style="color: #c4a7e7;">nome do produto</label>
                        <input type="text" name="nome" class="form-control" placeholder="Digite o nome do produto" required style="background: rgba(20, 40, 70, 0.3); border: 1px solid rgba(102, 153, 204, 0.2); color: #e6e6e6;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #c4a7e7;">preco (R$)</label>
                        <input type="number" step="0.01" name="preco" class="form-control" placeholder="Digite o preço" required style="background: rgba(20, 40, 70, 0.3); border: 1px solid rgba(102, 153, 204, 0.2); color: #e6e6e6;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #c4a7e7;">quantidade em estoque</label>
                        <input type="number" name="quantidade" class="form-control" placeholder="Digite a quantidade" required style="background: rgba(20, 40, 70, 0.3); border: 1px solid rgba(102, 153, 204, 0.2); color: #e6e6e6;">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg" style="background: linear-gradient(45deg, #4a86e8, #6699cc); border: none; border-radius: 6px; font-weight: 500;">
                            <i class="fas fa-save me-2"></i>cadastrar mantimento
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-muted" style="background: rgba(26, 53, 93, 0.6); border-top: 1px solid rgba(102, 153, 204, 0.2);">
                <a href="index.php" class="btn btn-outline-light btn-sm" style="border: 1px solid rgba(102, 153, 204, 0.3); color: #c4a7e7;">
                    <i class="fas fa-arrow-left me-1"></i>voltar para a nave
                </a>
            </div>
            <div class="card-footer text-muted" style="background: rgba(26, 53, 93, 0.6); border-top: 1px solid rgba(102, 153, 204, 0.2);">
                <a href="listar.php" class="btn btn-outline-light btn-sm" style="border: 1px solid rgba(102, 153, 204, 0.3); color: #c4a7e7;">
                    <i class="fas fa-list me-1"></i>ir para o planeta lista
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'rodape.php'; ?>