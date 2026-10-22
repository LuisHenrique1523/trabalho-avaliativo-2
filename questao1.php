<?php
$calcular = $_SERVER["REQUEST_METHOD"] === "POST";

if ($calcular) {
    $parcelaConhecida = 230;
    $totalDesejado    = 820;

    $numeroProcurado = $totalDesejado - $parcelaConhecida;

    $provaReal = $numeroProcurado + $parcelaConhecida;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questão 1</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Questão 1</h1>
            <p>Trabalho Avaliativo 2 &mdash; Programação de Sistemas Web</p>
        </header>

        <div class="card">
            <h2>Número que somado a 230 totaliza 820</h2>
            <p class="descricao">
                Qual é o número que somado a 230 totaliza 820?
                O programa descobre o valor subtraindo 230 de 820.
            </p>

            <form method="post">
                <div class="botoes">
                    <button type="submit" class="btn btn-primario">Calcular</button>
                    <a href="index.php" class="btn btn-secundario">Voltar ao menu</a>
                </div>
            </form>

            <?php if ($calcular): ?>
                <div class="resultado">
                    <h3>Resultado</h3>
                    <p>Equação: <code>x + <?= $parcelaConhecida ?> = <?= $totalDesejado ?></code></p>
                    <p>Cálculo: <code>x = <?= $totalDesejado ?> - <?= $parcelaConhecida ?></code></p>
                    <p class="destaque">O número procurado é <?= $numeroProcurado ?>.</p>
                    <p>Prova real: <?= $numeroProcurado ?> + <?= $parcelaConhecida ?> = <?= $provaReal ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
