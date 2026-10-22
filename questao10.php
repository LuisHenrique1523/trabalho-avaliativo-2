<?php
$ladoX = "";
$ladoY = "";
$ladoZ = "";
$mensagemErro = "";
$calculado = false;

function ehInteiro($texto)
{
    return filter_var($texto, FILTER_VALIDATE_INT) !== false;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ladoX = trim($_POST["lado_x"] ?? "");
    $ladoY = trim($_POST["lado_y"] ?? "");
    $ladoZ = trim($_POST["lado_z"] ?? "");

    if (!ehInteiro($ladoX) || !ehInteiro($ladoY) || !ehInteiro($ladoZ)) {
        $mensagemErro = "Informe valores inteiros para X, Y e Z.";
    } else {
        $x = (int) $ladoX;
        $y = (int) $ladoY;
        $z = (int) $ladoZ;

        $formaTriangulo = $x > 0 && $y > 0 && $z > 0
            && $x < $y + $z
            && $y < $x + $z
            && $z < $x + $y;

        if ($formaTriangulo) {
            if ($x == $y && $y == $z) {
                $tipoTriangulo = "Equilátero";
                $explicacao    = "os três lados são iguais.";
            } elseif ($x == $y || $x == $z || $y == $z) {
                $tipoTriangulo = "Isósceles";
                $explicacao    = "dois lados são iguais.";
            } else {
                $tipoTriangulo = "Escaleno";
                $explicacao    = "os três lados são diferentes.";
            }
        }

        $calculado = true;
    }
}

function mostrarTeste($condicao)
{
    return $condicao ? "&#10004; verdadeiro" : "&#10008; falso";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questão 10</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Questão 10</h1>
            <p>Trabalho Avaliativo 2 &mdash; Programação de Sistemas Web</p>
        </header>

        <div class="card">
            <h2>Tipo de triângulo</h2>
            <p class="descricao">
                Informe os lados X, Y e Z (inteiros). O programa verifica se formam um
                triângulo e, em caso afirmativo, se ele é equilátero, isósceles ou escaleno.
            </p>

            <form method="post">
                <div class="linha">
                    <div class="campo">
                        <label for="lado_x">Lado X</label>
                        <input type="number" step="1" id="lado_x" name="lado_x" required
                               value="<?= htmlspecialchars($ladoX) ?>">
                    </div>
                    <div class="campo">
                        <label for="lado_y">Lado Y</label>
                        <input type="number" step="1" id="lado_y" name="lado_y" required
                               value="<?= htmlspecialchars($ladoY) ?>">
                    </div>
                    <div class="campo">
                        <label for="lado_z">Lado Z</label>
                        <input type="number" step="1" id="lado_z" name="lado_z" required
                               value="<?= htmlspecialchars($ladoZ) ?>">
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
                <div class="<?= $formaTriangulo ? "resultado" : "erro" ?>">
                    <h3>Verificação da condição de existência</h3>
                    <table>
                        <tr><th>Teste</th><th>Resultado</th></tr>
                        <tr><td><code><?= $x ?> &lt; <?= $y ?> + <?= $z ?></code></td><td><?= mostrarTeste($x < $y + $z) ?></td></tr>
                        <tr><td><code><?= $y ?> &lt; <?= $x ?> + <?= $z ?></code></td><td><?= mostrarTeste($y < $x + $z) ?></td></tr>
                        <tr><td><code><?= $z ?> &lt; <?= $x ?> + <?= $y ?></code></td><td><?= mostrarTeste($z < $x + $y) ?></td></tr>
                    </table>

                    <?php if ($formaTriangulo): ?>
                        <p class="destaque">Triângulo <?= $tipoTriangulo ?></p>
                        <p>Os valores formam um triângulo e ele é <?= mb_strtolower($tipoTriangulo) ?>: <?= $explicacao ?></p>
                    <?php else: ?>
                        <p><strong>Os valores não formam um triângulo.</strong></p>
                        <?php if ($x <= 0 || $y <= 0 || $z <= 0): ?>
                            <p>Todos os lados precisam ser maiores que zero.</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
