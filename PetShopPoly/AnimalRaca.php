<?php
require_once(__DIR__ . "/model/animal.php");

if (isset($_GET['raca'])) {
    $racaAnimal = $_GET['raca'];
    $animais = Animal::listarRaca($racaAnimal);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de animais por raça</title>
    <link rel="icon" href="./img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <div class="container">
        <h1>Animais da raça <?php echo $racaAnimal; ?></h1>
        <?php if (isset($animais) && count($animais) > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($animais as $animal) { ?>
                        <tr>
                            <td><?php echo $animal['id']; ?></td>
                            <td><?php echo $animal['nome']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Nenhum animal encontrado no cadastro para a raça <?php echo $racaAnimal; ?></p>
        <?php } ?>
        <br>
        <a href="index.php" class="voltar">
            <img src="./img/voltar.png" alt="voltar">
        </a>
    </div>
</body>

</html>