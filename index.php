<?php
$questoes = [
    1  => "Número que somado a 230 dá 820",
    2  => "Total da compra",
    3  => "Distribuição e doação",
    4  => "Salário semanal",
    5  => "Condição de pagamento",
    6  => "Cálculo do IMC",
    7  => "Ordem decrescente",
    8  => "Mês por extenso",
    9  => "Número por extenso",
    10 => "Tipo de triângulo",
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabalho Avaliativo 2 - Menu</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Trabalho Avaliativo 2</h1>
            <p>Programação de Sistemas Web - PHP</p>
        </header>

        <div class="card">
            <h2>Menu de questões</h2>
            <p class="descricao">Escolha uma questão para executar o programa correspondente.</p>

            <nav class="menu">
                <?php foreach ($questoes as $numero => $resumo): ?>
                    <a class="btn btn-primario" href="questao<?= $numero ?>.php">
                        Questão <?= $numero ?>
                        <span><?= $resumo ?></span>
                    </a>
                <?php endforeach; ?>
            </nav>
        </div>

        <footer>Trabalho Avaliativo 2 - Programação de Sistemas Web</footer>
    </div>
</body>
</html>
