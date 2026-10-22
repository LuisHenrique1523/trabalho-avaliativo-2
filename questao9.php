<?php
$numeroDigitado = "";
$numeroPorExtenso = "";
$calculado = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numeroDigitado = trim($_POST["numero"] ?? "");
    $calculado = true;

    $numeroInteiro = filter_var($numeroDigitado, FILTER_VALIDATE_INT);

    if ($numeroInteiro === 1) {
        $numeroPorExtenso = "Um";
    } elseif ($numeroInteiro === 2) {
        $numeroPorExtenso = "Dois";
    } elseif ($numeroInteiro === 3) {
        $numeroPorExtenso = "Três";
    } elseif ($numeroInteiro === 4) {
        $numeroPorExtenso = "Quatro";
    } elseif ($numeroInteiro === 5) {
        $numeroPorExtenso = "Cinco";
    } else {
        $numeroPorExtenso = "";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questão 9</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Questão 9</h1>
            <p>Trabalho Avaliativo 2 &mdash; Programação de Sistemas Web</p>
        </header>

        <div class="card">
            <h2>Número por extenso</h2>
            <p class="descricao">
                Digite um número de 1 a 5 para vê-lo escrito por extenso.
            </p>

            <form method="post">
                <div class="campo">
                    <label for="numero">Número (1 a 5)</label>
                    <input type="text" inputmode="numeric" id="numero" name="numero"
                           placeholder="Ex.: 3" required
                           value="<?= htmlspecialchars($numeroDigitado) ?>">
                </div>
                <div class="botoes">
                    <button type="submit" class="btn btn-primario">Calcular</button>
                    <a href="index.php" class="btn btn-secundario">Voltar ao menu</a>
                </div>
            </form>

            <?php if ($calculado && $numeroPorExtenso !== ""): ?>
                <div class="resultado">
                    <h3>Resultado</h3>
                    <p class="destaque"><?= (int) $numeroDigitado ?> = <?= $numeroPorExtenso ?></p>
                </div>
            <?php elseif ($calculado): ?>
                <div class="erro">
                    <strong>Número inválido.</strong>
                    O valor "<?= htmlspecialchars($numeroDigitado) ?>" não está entre 1 e 5.
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
