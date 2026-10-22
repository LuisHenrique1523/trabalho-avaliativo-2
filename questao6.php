<?php
$peso = "";
$altura = "";
$mensagemErro = "";
$calculado = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $peso   = str_replace(",", ".", trim($_POST["peso"] ?? ""));
    $altura = str_replace(",", ".", trim($_POST["altura"] ?? ""));

    if (!is_numeric($peso) || !is_numeric($altura) || $peso <= 0 || $altura <= 0) {
        $mensagemErro = "Informe peso e altura válidos, maiores que zero.";
    } elseif ($altura > 3) {
        $mensagemErro = "Informe a altura em metros (ex.: 1,75).";
    } else {
        $peso   = (float) $peso;
        $altura = (float) $altura;

        $imc = $peso / ($altura * $altura);

        if ($imc < 18.5) {
            $condicao = "Abaixo do peso";
        } elseif ($imc < 25) {
            $condicao = "Peso normal";
        } elseif ($imc < 30) {
            $condicao = "Acima do peso";
        } elseif ($imc < 40) {
            $condicao = "Obeso";
        } else {
            $condicao = "Obesidade grave";
        }

        $calculado = true;
    }
}

$faixasImc = [
    "Abaixo de 18,5"  => "Abaixo do peso",
    "Entre 18,5 e 25" => "Peso normal",
    "Entre 25 e 30"   => "Acima do peso",
    "Entre 30 e 40"   => "Obeso",
    "Acima de 40"     => "Obesidade grave",
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questão 6</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Questão 6</h1>
            <p>Trabalho Avaliativo 2 &mdash; Programação de Sistemas Web</p>
        </header>

        <div class="card">
            <h2>Cálculo do IMC</h2>
            <p class="descricao">
                Informe o peso (kg) e a altura (m) de um adulto. O programa calcula
                <code>IMC = peso / altura²</code> e mostra a condição segundo a OMS.
            </p>

            <form method="post">
                <div class="linha">
                    <div class="campo">
                        <label for="peso">Peso (kg)</label>
                        <input type="text" inputmode="decimal" id="peso" name="peso"
                               placeholder="Ex.: 70" required
                               value="<?= htmlspecialchars((string) $peso) ?>">
                    </div>
                    <div class="campo">
                        <label for="altura">Altura (m)</label>
                        <input type="text" inputmode="decimal" id="altura" name="altura"
                               placeholder="Ex.: 1,75" required
                               value="<?= htmlspecialchars((string) $altura) ?>">
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
                    <p>
                        Cálculo: <code><?= number_format($peso, 2, ",", ".") ?> / (<?= number_format($altura, 2, ",", ".") ?> &times; <?= number_format($altura, 2, ",", ".") ?>)</code>
                    </p>
                    <p class="destaque">IMC: <?= number_format($imc, 2, ",", ".") ?></p>
                    <p class="destaque">Condição: <?= $condicao ?></p>
                </div>
            <?php endif; ?>

            <h3 style="margin-top: 20px;">Tabela de referência</h3>
            <table>
                <tr><th>IMC</th><th>Condição</th></tr>
                <?php foreach ($faixasImc as $faixa => $descricao): ?>
                    <tr>
                        <td><?= $faixa ?></td>
                        <td><?= ($calculado && $descricao === $condicao) ? "<strong>$descricao</strong>" : $descricao ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>
