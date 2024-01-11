<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar animal</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="./img/icon.png" type="image/x-icon">
</head>

<body>
    <a href="index.php" class="voltar">
        <img src="./img/voltar.png" alt="voltar">
    </a>
    <?php
    require_once "configs/utils.php";
    require_once "model/animal.php";

    $animal = null;

    if (isMetodo("POST")) {
        if (parametrosValidos($_POST, ["id", "nome", "raca", "teldono"])) {
            $resultado = Animal::editar($_POST["id"], $_POST["nome"], $_POST["raca"], $_POST["teldono"]);
            if ($resultado) {
                echo "<h1>Animal editado com sucesso!</h1>";
                echo "<a href='index.php'>Voltar para a tela inicial</a>";
                die;
            } else {
                echo "<h1>Erro ao editar o animal!</h1>";
                echo "<a href='index.php'>Voltar para a tela inicial</a>";
                die;
            }
        } else {
            echo "<h1>Problemas na requisição de editar</h1>";
            echo "<a href='index.php'>Voltar para a tela inicial</a>";
            die;
        }
    }

    if (isMetodo("GET")) {
        if (parametrosValidos($_GET, ["id"])) {
            $id = $_GET["id"];
            if (Animal::existeId($id)) {
                $animal = Animal::getAnimalById($id);
            } else {
                echo "<h1>Este animal não existe</h1>";
                echo "<a href='index.php'>Voltar para a tela inicial</a>";
                die;
            }
        } else {
            echo "<h1>Você deve dizer qual é o animal a ser editado</h1>";
            echo "<a href='index.php'>Voltar...</a>";
            die;
        }
    }

    ?>


    <form method="POST">
        <h1>Editando as informações de <?= $animal["nome"] ?></h1>
        <p>Digite o nome:</p>
        <input type="text" name="nome" value="<?= $animal["nome"] ?>" required>
        <p>Digite a raça:</p>
        <input type="text" name="raca" value="<?= $animal["raca"] ?>" required>
        <p>Digite o telefone do dono: </p>
        <input type="text" name="teldono" value="<?= $animal["teldono"] ?>" required>
        <input type="hidden" name="id" value="<?= $animal["id"] ?>">
        <br>
        <button>Editar</button>
    </form>
</body>

</html>