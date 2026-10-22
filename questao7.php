<?php
$valorA = "";
$valorB = "";
$valorC = "";
$mensagemErro = "";
$calculado = false;

function ehInteiro($texto)
{
    return filter_var($texto, FILTER_VALIDATE_INT) !== false;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $valorA = trim($_POST["valor_a"] ?? "");
    $valorB = trim($_POST["valor_b"] ?? "");
    $valorC = trim($_POST["valor_c"] ?? "");

    if (!ehInteiro($valorA) || !ehInteiro($valorB) || !ehInteiro($valorC)) {
        $mensagemErro = "Informe três números inteiros.";
    } elseif ($valorA == $valorB || $valorA == $valorC || $valorB == $valorC) {
        $mensagemErro = "Os três valores devem ser diferentes entre si.";
    } else {
        $maior = (int) $valorA;
        $meio  = (int) $valorB;
        $menor = (int) $valorC;

        if ($meio > $maior) {
            $auxiliar = $maior;
            $maior    = $meio;
            $meio     = $auxiliar;
        }

        if ($menor > $maior) {
            $auxiliar = $maior;
            $maior    = $menor;
            $menor    = $auxiliar;
        }

        if ($menor > $meio) {
            $auxiliar = $meio;
            $meio     = $menor;
            $menor    = $auxiliar;
        }

        $calculado = true;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questão 7</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Questão 7</h1>
            <p>Trabalho Avaliativo 2 &mdash; Programação de Sistemas Web</p>
        </header>

        <div class="card">
            <h2>Ordem decrescente</h2>
            <p class="descricao">
                Digite três números inteiros e diferentes. O programa os exibe
                do maior para o menor.
            </p>

            <form method="post">
                <div class="linha">
                    <div class="campo">
                        <label for="valor_a">1º valor</label>
                        <input type="number" step="1" id="valor_a" name="valor_a" required
                               value="<?= htmlspecialchars($valorA) ?>">
                    </div>
                    <div class="campo">
                        <label for="valor_b">2º valor</label>
                        <input type="number" step="1" id="valor_b" name="valor_b" required
                               value="<?= htmlspecialchars($valorB) ?>">
                    </div>
                    <div class="campo">
                        <label for="valor_c">3º valor</label>
                        <input type="number" step="1" id="valor_c" name="valor_c" required
                               value="<?= htmlspecialchars($valorC) ?>">
                    </div>
                </div>
                <div class="botoes">
                    <button type="submit" class="btn btn-primario">Calcular</button>
                    <a href="index.php" class="btn btn-secundario">Voltar ao menu</a>
                </div>
            </form>

            <?php if ($mensagemErro !== ""): ?>
                <div class="erro"><?= $mensagemErro ?></div>
            <?php endif; ?>

            <?php if ($calculado): ?>
                <div class="resultado">
                    <h3>Resultado</h3>
                    <p>Valores informados: <?= (int) $valorA ?>, <?= (int) $valorB ?>, <?= (int) $valorC ?></p>
                    <p class="destaque">Ordem decrescente: <?= $maior ?> &gt; <?= $meio ?> &gt; <?= $menor ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
