<?php
$numeroMes = "";
$mesValido = false;
$calculado = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numeroMes = trim($_POST["mes"] ?? "");
    $calculado = true;

    $numeroInteiro = filter_var($numeroMes, FILTER_VALIDATE_INT);

    switch ($numeroInteiro) {
        case 1:  $nomeMes = "Janeiro";   break;
        case 2:  $nomeMes = "Fevereiro"; break;
        case 3:  $nomeMes = "Março";     break;
        case 4:  $nomeMes = "Abril";     break;
        case 5:  $nomeMes = "Maio";      break;
        case 6:  $nomeMes = "Junho";     break;
        case 7:  $nomeMes = "Julho";     break;
        case 8:  $nomeMes = "Agosto";    break;
        case 9:  $nomeMes = "Setembro";  break;
        case 10: $nomeMes = "Outubro";   break;
        case 11: $nomeMes = "Novembro";  break;
        case 12: $nomeMes = "Dezembro";  break;
        default: $nomeMes = "";
    }

    $mesValido = $nomeMes !== "";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questão 8</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Questão 8</h1>
            <p>Trabalho Avaliativo 2 &mdash; Programação de Sistemas Web</p>
        </header>

        <div class="card">
            <h2>Mês por extenso</h2>
            <p class="descricao">
                Digite o número de um mês (1 a 12) para ver o nome correspondente.
            </p>

            <form method="post">
                <div class="campo">
                    <label for="mes">Número do mês</label>
                    <input type="text" inputmode="numeric" id="mes" name="mes"
                           placeholder="Ex.: 10" required
                           value="<?= htmlspecialchars($numeroMes) ?>">
                </div>
                <div class="botoes">
                    <button type="submit" class="btn btn-primario">Calcular</button>
                    <a href="index.php" class="btn btn-secundario">Voltar ao menu</a>
                </div>
            </form>

            <?php if ($calculado && $mesValido): ?>
                <div class="resultado">
                    <h3>Resultado</h3>
                    <p class="destaque">Mês <?= (int) $numeroMes ?>: <?= $nomeMes ?></p>
                </div>
            <?php elseif ($calculado): ?>
                <div class="erro">
                    <strong>Mês inválido.</strong>
                    O valor "<?= htmlspecialchars($numeroMes) ?>" não corresponde a nenhum mês (use de 1 a 12).
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
