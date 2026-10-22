<?php
$horasTrabalhadas = "";
$valorHora        = "";
$mensagemErro     = "";
$calculado        = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $horasTrabalhadas = str_replace(",", ".", trim($_POST["horas"] ?? ""));
    $valorHora        = str_replace(",", ".", trim($_POST["valor_hora"] ?? ""));

    if (!is_numeric($horasTrabalhadas) || !is_numeric($valorHora)) {
        $mensagemErro = "Preencha as horas e o valor da hora com números válidos.";
    } elseif ($horasTrabalhadas < 0 || $valorHora <= 0) {
        $mensagemErro = "As horas não podem ser negativas e o valor da hora deve ser maior que zero.";
    } else {
        $horasTrabalhadas = (float) $horasTrabalhadas;
        $valorHora        = (float) $valorHora;

        $horasNormais = min($horasTrabalhadas, 40);

        $horasBonus50 = 0;
        if ($horasTrabalhadas > 40) {
            $horasBonus50 = min($horasTrabalhadas, 60) - 40;
        }

        $horasBonus100 = 0;
        if ($horasTrabalhadas > 60) {
            $horasBonus100 = $horasTrabalhadas - 60;
        }

        $valorNormais   = $horasNormais  * $valorHora;
        $valorBonus50   = $horasBonus50  * $valorHora * 1.5;
        $valorBonus100  = $horasBonus100 * $valorHora * 2;

        $salarioSemanal = $valorNormais + $valorBonus50 + $valorBonus100;
        $calculado      = true;
    }
}

function formatarReais($valor)
{
    return "R$ " . number_format($valor, 2, ",", ".");
}

function formatarHoras($horas)
{
    return rtrim(rtrim(number_format($horas, 2, ",", "."), "0"), ",") . "h";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questão 4</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Questão 4</h1>
            <p>Trabalho Avaliativo 2 &mdash; Programação de Sistemas Web</p>
        </header>

        <div class="card">
            <h2>Salário semanal</h2>
            <p class="descricao">
                Até 40h por semana não há adicional. Das 40h às 60h as horas têm bônus de 50%.
                Acima de 60h as horas têm bônus de 100%.
            </p>

            <form method="post">
                <div class="linha">
                    <div class="campo">
                        <label for="horas">Horas trabalhadas na semana</label>
                        <input type="text" inputmode="decimal" id="horas" name="horas"
                               placeholder="Ex.: 65" required
                               value="<?= htmlspecialchars((string) $horasTrabalhadas) ?>">
                    </div>
                    <div class="campo">
                        <label for="valor_hora">Valor da hora (R$)</label>
                        <input type="text" inputmode="decimal" id="valor_hora" name="valor_hora"
                               placeholder="Ex.: 20,00" required
                               value="<?= htmlspecialchars((string) $valorHora) ?>">
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
                    <h3>Detalhamento do cálculo</h3>
                    <table>
                        <tr><th>Faixa</th><th>Horas</th><th>Cálculo</th><th>Valor</th></tr>
                        <tr>
                            <td>Até 40h (normal)</td>
                            <td><?= formatarHoras($horasNormais) ?></td>
                            <td><?= formatarHoras($horasNormais) ?> &times; <?= formatarReais($valorHora) ?></td>
                            <td class="valor"><?= formatarReais($valorNormais) ?></td>
                        </tr>
                        <tr>
                            <td>De 40h a 60h (+50%)</td>
                            <td><?= formatarHoras($horasBonus50) ?></td>
                            <td><?= formatarHoras($horasBonus50) ?> &times; <?= formatarReais($valorHora * 1.5) ?></td>
                            <td class="valor"><?= formatarReais($valorBonus50) ?></td>
                        </tr>
                        <tr>
                            <td>Acima de 60h (+100%)</td>
                            <td><?= formatarHoras($horasBonus100) ?></td>
                            <td><?= formatarHoras($horasBonus100) ?> &times; <?= formatarReais($valorHora * 2) ?></td>
                            <td class="valor"><?= formatarReais($valorBonus100) ?></td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th><?= formatarHoras($horasTrabalhadas) ?></th>
                            <th></th>
                            <th class="valor"><?= formatarReais($salarioSemanal) ?></th>
                        </tr>
                    </table>
                    <p class="destaque">Salário semanal: <?= formatarReais($salarioSemanal) ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
