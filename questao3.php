<?php
$calcular = $_SERVER["REQUEST_METHOD"] === "POST";

if ($calcular) {
    $valorTotal         = 365.00;
    $quantidadePessoas  = 18;
    $doacaoPorPessoa    = 7.00;

    $valorRecebido = $valorTotal / $quantidadePessoas;

    $valorFinal = $valorRecebido - $doacaoPorPessoa;
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
    <title>Questão 3</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Questão 3</h1>
            <p>Trabalho Avaliativo 2 &mdash; Programação de Sistemas Web</p>
        </header>

        <div class="card">
            <h2>Distribuição e doação</h2>
            <p class="descricao">
                R$ 365,00 foram distribuídos entre 18 pessoas e cada uma doou
                R$ 7,00 a uma instituição de caridade. Quanto restou para cada pessoa?
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
                        <tr><th>Etapa</th><th>Cálculo</th><th>Valor</th></tr>
                        <tr>
                            <td>Valor recebido</td>
                            <td><code>365 / 18</code></td>
                            <td class="valor"><?= formatarReais($valorRecebido) ?></td>
                        </tr>
                        <tr>
                            <td>Doação</td>
                            <td><code>- 7</code></td>
                            <td class="valor">- <?= formatarReais($doacaoPorPessoa) ?></td>
                        </tr>
                        <tr>
                            <th>Valor final</th>
                            <th><code>(365 / 18) - 7</code></th>
                            <th class="valor"><?= formatarReais($valorFinal) ?></th>
                        </tr>
                    </table>
                    <p class="destaque">Cada pessoa ficou com <?= formatarReais($valorFinal) ?>.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
