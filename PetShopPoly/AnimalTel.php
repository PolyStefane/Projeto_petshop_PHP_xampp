<?php
require_once(__DIR__ . "/model/animal.php");

if (isset($_GET['teldono'])) {
    $teldono = $_GET['teldono'];
    $animais = Animal::listarTelefone($teldono);
} else {
    echo "O número de telefone esta vazio.";
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Animais por telefone</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="./img/icon.png" type="image/x-icon">
</head>

<body>
<div class="container">
    <h1>Animais por telefone do dono</h1>
    <p>Lista de animais cadastrados para o telefone <?php echo $teldono; ?> : </p>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Raça</th>
                <th>Telefone do dono</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($animais as $animal) { ?>
                <tr>
                    <td><?php echo $animal['nome']; ?></td>
                    <td><?php echo $animal['raca']; ?></td>
                    <td><?php echo $animal['teldono']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <a href="index.php" class="voltar">
        <img src="./img/voltar.png" alt="voltar">
    </a>
</body>

</html>