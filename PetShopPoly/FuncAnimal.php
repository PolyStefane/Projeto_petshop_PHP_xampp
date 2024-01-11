<?php
require_once(__DIR__ . "/model/funcionario.php");
require_once(__DIR__ . "/model/animal.php");
//se houver...
if (isset($_GET['nome'])) {
    $nomeAnimal = $_GET['nome'];
    $funcionarios = funcionario::listarAnimal($nomeAnimal);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de funcionários por animal</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="./img/icon.png" type="image/x-icon">
</head>

<body>
    <div class="container">
        <h1>Funcionários atendendo o animal: <?php echo $nomeAnimal; ?></h1>
        <?php if (isset($funcionarios) && count($funcionarios) > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($funcionarios as $funcionario) { ?>
                        <tr>
                            <td><?php echo $funcionario['id']; ?></td>
                            <td><?php echo $funcionario['nome']; ?></td>
                            <td><?php echo $funcionario['email']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Nenhum funcionário encontrado para o animal buscado <?php echo $nomeAnimal; ?></p>
        <?php } ?>
        <br>
        <a href="index.php" class="voltar">
            <img src="./img/voltar.png" alt="voltar">
        </a>
    </div>
</body>

</html>