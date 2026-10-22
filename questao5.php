<?php
$precoEtiqueta = "";
$codigoPagamento = "";
$mensagemErro = "";
$calculado = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $precoEtiqueta   = str_replace(",", ".", trim($_POST["preco"] ?? ""));
    $codigoPagamento = trim($_POST["condicao"] ?? "");

    if (!is_numeric($precoEtiqueta) || $precoEtiqueta <= 0) {
        $mensagemErro = "Informe um preço de etiqueta válido, maior que zero.";
    } else {
        $precoEtiqueta = (float) $precoEtiqueta;

        switch ($codigoPagamento) {
            case "1":
                $descricaoCondicao = "À vista em dinheiro";
                $percentualAjuste  = -10;
                break;
            case "2":
                $descricaoCondicao = "À vista no cartão de crédito";
                $percentualAjuste  = -5;
                break;
            case "3":
                $descricaoCondicao = "Em 3 vezes no cartão (sem juros)";
                $percentualAjuste  = 0;
                break;
            case "4":
                $descricaoCondicao = "Em 6 vezes (juros de 10%)";
                $percentualAjuste  = 10;
                break;
            default:
                $mensagemErro = "Condição de pagamento inválida. Escolha um código de 1 a 4.";
        }

        if ($mensagemErro === "") {
            $valorAjuste = $precoEtiqueta * $percentualAjuste / 100;
            $valorFinal  = $precoEtiqueta + $valorAjuste;
            $calculado   = true;

            $quantidadeParcelas = 1;
            if ($codigoPagamento === "3") {
                $quantidadeParcelas = 3;
            } elseif ($codigoPagamento === "4") {
                $quantidadeParcelas = 6;
            }
            $valorParcela = $valorFinal / $quantidadeParcelas;
        }
    }
}

function formatarReais($valor)
{
    return "R$ " . number_format($valor, 2, ",", ".");
}

$opcoesPagamento = [
    "1" => "1 - À vista em dinheiro (10% de desconto)",
    "2" => "2 - À vista no cartão de crédito (5% de desconto)",
    "3" => "3 - Em 3 vezes no cartão (preço normal)",
    "4" => "4 - Em 6 vezes (juros de 10%)",
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questão 5</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Questão 5</h1>
            <p>Trabalho Avaliativo 2 &mdash; Programação de Sistemas Web</p>
        </header>

        <div class="card">
            <h2>Condição de pagamento</h2>
            <p class="descricao">
                Informe o preço de etiqueta e o código da condição de pagamento
                para calcular o valor a ser pago.
            </p>

            <form method="post">
                <div class="campo">
                    <label for="preco">Preço de etiqueta (R$)</label>
                    <input type="text" inputmode="decimal" id="preco" name="preco"
                           placeholder="Ex.: 500,00" required
                           value="<?= htmlspecialchars((string) $precoEtiqueta) ?>">
                </div>
                <div class="campo">
                    <label for="condicao">Condição de pagamento</label>
                    <select id="condicao" name="condicao" required>
                        <?php foreach ($opcoesPagamento as $codigo => $texto): ?>
                            <option value="<?= $codigo ?>" <?= $codigoPagamento === (string) $codigo ? "selected" : "" ?>>
                                <?= $texto ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
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
                    <table>
                        <tr><td>Preço de etiqueta</td><td class="valor"><?= formatarReais($precoEtiqueta) ?></td></tr>
                        <tr><td>Condição escolhida</td><td class="valor"><?= $codigoPagamento ?> - <?= $descricaoCondicao ?></td></tr>
                        <tr>
                            <td><?= $percentualAjuste < 0 ? "Desconto" : "Acréscimo" ?> (<?= abs($percentualAjuste) ?>%)</td>
                            <td class="valor"><?= $percentualAjuste < 0 ? "- " : "+ " ?><?= formatarReais(abs($valorAjuste)) ?></td>
                        </tr>
                        <tr><th>Valor a pagar</th><th class="valor"><?= formatarReais($valorFinal) ?></th></tr>
                    </table>
                    <p class="destaque">Valor a pagar: <?= formatarReais($valorFinal) ?></p>
                    <?php if ($quantidadeParcelas > 1): ?>
                        <p><?= $quantidadeParcelas ?> parcelas de <?= formatarReais($valorParcela) ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
