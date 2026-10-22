<?php
$calcular = $_SERVER["REQUEST_METHOD"] === "POST";

if ($calcular) {
    $computador = 2650.00;
    $impressora = 720.00;

    $totalCompra = $computador + $impressora;
}

function formatarReais($valor)
{
    return "R$ " . number_format($valor, 2, ",", ".");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questão 2</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Questão 2</h1>
            <p>Trabalho Avaliativo 2 &mdash; Programação de Sistemas Web</p>
        </header>

        <div class="card">
            <h2>Total da compra</h2>
            <p class="descricao">
                Um computador de R$ 2.650,00 e uma impressora de R$ 720,00.
                Cada valor é guardado em uma variável e depois somado.
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
                    <table>
                        <tr><th>Item</th><th>Valor</th></tr>
                        <tr><td>Computador (<code>$computador = <?= number_format($computador, 2, ".", "") ?></code>)</td><td class="valor"><?= formatarReais($computador) ?></td></tr>
                        <tr><td>Impressora (<code>$impressora = <?= number_format($impressora, 2, ".", "") ?></code>)</td><td class="valor"><?= formatarReais($impressora) ?></td></tr>
                        <tr><th>Total</th><th class="valor"><?= formatarReais($totalCompra) ?></th></tr>
                    </table>
                    <p class="destaque">Total da compra: <?= formatarReais($totalCompra) ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
