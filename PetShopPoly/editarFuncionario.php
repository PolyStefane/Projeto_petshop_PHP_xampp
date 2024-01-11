<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar funcionário</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="./img/icon.png" type="image/x-icon">
</head>

<body>
    <a href="index.php" class="voltar">
        <img src="./img/voltar.png" alt="voltar">
    </a>
    <?php
    require_once "configs/utils.php";
    require_once "model/funcionario.php";

    $funcionario = null;

    if (isMetodo("POST")) {
        if (parametrosValidos($_POST, ["id", "nome", "email"])) {
            $resultado = Funcionario::editar($_POST["id"], $_POST["nome"], $_POST["email"]);
            if ($resultado) {
                echo "<h1>Funcionário editado com sucesso!</h1>";
                echo "<a href='index.php'>Voltar...</a>";
                die;
            } else {
                echo "<h1>Erro ao editar o funcionário!</h1>";
                echo "<a href='index.php'>Voltar...</a>";
                die;
            }
        } else {
            echo "<h1>Problemas na requisição de editar</h1>";
            echo "<a href='index.php'>Voltar...</a>";
            die;
        }
    }

    if (isMetodo("GET")) {
        if (parametrosValidos($_GET, ["id"])) {
            $id = $_GET["id"];
            if (Funcionario::existeId($id)) {
                $funcionario = Funcionario::getFuncionarioById($id);
            } else {
                echo "<h1>Este funcionário não existe</h1>";
                echo "<a href='index.php'>Voltar...</a>";
                die;
            }
        } else {
            echo "<h1>Você deve dizer qual é o funcionário a ser editado</h1>";
            echo "<a href='index.php'>Voltar</a>";
            die;
        }
    }

    ?>


    <form method="POST">
        <h1>Editando as informações de <?= $funcionario["nome"] ?></h1>
        <p>Digite o nome:</p>
        <input type="text" name="nome" value="<?= $funcionario["nome"] ?>" required>
        <p>Digite o email:</p>
        <input type="email" name="email" value="<?= $funcionario["email"] ?>" required>
        <input type="hidden" name="id" value="<?= $funcionario["id"] ?>">
        <br>
        <button>Editar</button>
    </form>
</body>

</html>