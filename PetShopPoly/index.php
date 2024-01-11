<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop IFSP</title>
    <link rel="icon" href="./img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <?php

    date_default_timezone_set('America/Sao_Paulo');
    require_once "configs/utils.php";
    require_once "model/funcionario.php";
    require_once "model/animal.php";
    require_once "model/atende.php";


    try {
        if (isMetodo("GET")) {
            if (parametrosValidos($_GET, ["deletarFuncionario"])) {
                $id = $_GET["deletarFuncionario"];
                if (Funcionario::existeId($id)) {
                    $resultado = Funcionario::deletar($id);
                    if ($resultado) {
                        echo "<script>alert('O funcionário foi deletado com sucesso!');</script>";
                    } else {
                        echo "<p>Erro aqui</p>";
                    }
                } else {
                    echo "<p>O funcionário selecionado não existe!</p>";
                    die;
                }
            }
        }
    } catch (PDOException $e) {
        if ($e->errorInfo[0] == 1451) {
            echo "<script>alert('Ja esta cadastrado')</script>";
        } else {
            echo "<script>alert(' Nao foi possivel deletar!')</script>" . $e->getMessage();;
        }
    }

    if (isMetodo("GET")) {
        if (parametrosValidos($_GET, ["deletarAnimal"])) {
            $id = $_GET["deletarAnimal"];
            if (Animal::existeId($id)) {
                $resultado = Animal::deletar($id);
                if ($resultado) {
                    echo "<script>alert('O animal foi deletado com sucesso!');</script>";
                } else {
                    echo "<p>Erro aqui</p>";
                }
            } else {
                echo "<script>alert('Esse animal está no nosso banco de dados!')</script>";
                die;
            }
        }
    }

    if (isMetodo("GET")) {
        if (parametrosValidos($_GET, ["deletarAtende"])) {
            $id = $_GET["deletarAtende"];
            if (Atende::existeId($id)) {
                $resultado = Atende::deletar($id);
                if ($resultado) {
                    echo "<script>alert('O atendimento foi deletado com sucesso!');</script>";
                } else {
                    echo "<p>Erro aqui!</p>";
                }
            } else {
                echo "<script>alert('Esse atendimento não existe no nosso banco de dados!')</script>";
                die;
            }
        }
    }

    if (isMetodo("POST")) {
        if (parametrosValidos($_POST, ["nome", "email"])) {
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $datacadastro = date('Y-m-d H:i:s');

            if (!Funcionario::existeEmail($email)) {
                if (Funcionario::cadastrar($nome, $email, $datacadastro)) {
                    echo "<script>alert('O funcionário foi cadastrado com sucesso!')</script>";
                } else {
                    echo "<script>alert('Erro ao cadastrar o funcionário')</script>";
                }
            } else {
                echo "<script>alert('Já existe uma pessoa com esse e-mail')</script>";
            }
        }

        if (parametrosValidos($_POST, ["nome", "raca", "teldono"])) {
            $nome = $_POST["nome"];
            $raca = $_POST["raca"];
            $teldono = $_POST["teldono"];
            $datacadastro = date('Y-m-d H:i:s');


            if (!Animal::existeNome($nome) && !Animal::existeTel($teldono)) {
                if (Animal::cadastrar($nome, $raca, $teldono, $datacadastro)) {
                    echo "<script>alert('O animal foi cadastrado com sucesso!')</script>";
                } else {
                    echo "<script>alert('Erro ao cadastrar o animal')</script>";
                }
            } else {
                echo "<script>alert('ID ja cadastrado no sistema!')</script>";
            }
        }

        if (parametrosValidos($_POST, ["idfuncionario", "idanimal"])) {
            // Fazer checagens avançadas...
            $idfuncionario = $_POST["idfuncionario"];
            $idanimal = $_POST["idanimal"];
            $data = date('Y-m-d H:i:s');


            if (!Atende::existeAtende($idfuncionario, $idanimal) && Funcionario::existeId($idfuncionario) && Animal::existeId($idanimal)) {
                if (Atende::cadastrar($idfuncionario, $idanimal, $data)) {
                    echo "<script>alert('O atendimento foi cadastrado com sucesso!')</script>";
                } else {
                    echo "<script>alert('Erro ao cadastrar o atendimento!')</script>";
                }
            } else {
                echo "<script>alert('Estes ID's ja estão relacionados a um atendimento!')</script>";
            }
        }
    }

    ?>


    <div class="container">
        <h1>Bem vindo(a) ao Snoopy</h1>
        <div>
            <h1>Cadastro de funcionários</h1>
            <form method="POST">
                <p>Digite o nome: </p>
                <input type="text" name="nome" required>
                <p>Digite o email: </p>
                <input type="email" name="email" required>
                <br>
                <button>Cadastrar</button>
            </form>

            <h2 class="esquerda">Funcionários cadastrados no sistema</h2>
            <table class="tabela">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Cadastro:</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $lista = Funcionario::listar();
                    foreach ($lista as $funcionario) {
                        echo "<tr>";
                        echo "<td>" . $funcionario["id"] . "</td>";
                        echo "<td>" . $funcionario["nome"] . "</td>";
                        echo "<td>" . $funcionario["email"] . "</td>";
                        echo "<td>" . $funcionario["datacadastro"] . "</td>";
                        $id = $funcionario["id"];
                        echo "<td>
                        <a href='editarFuncionario.php?id=$id'>Editar</a> | 
                        <a href='index.php?deletarFuncionario=$id'>Deletar</a>
                    </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <form method="GET" action="FuncAnimal.php">
                <h2>Buscar funcionário por animal:</h2>
                <select name="nome">
                    <option value=""></option>
                    <?php
                    require_once(__DIR__ . "/model/Animal.php");
                    $animais = Animal::listar();
                    foreach ($animais as $animal) {
                        echo "<option value='{$animal['id']}'>{$animal['nome']}</option>";
                    }
                    ?>
                </select>
                <br>
                <input type="submit" value="Buscar">
            </form>

        </div>

        <div>
            <h1>Cadastro de animais</h1>
            <form method="POST">
                <p>Digite o nome:</p>
                <input type="text" name="nome" required>
                <p>Digite a raça:</p>
                <input type="text" name="raca" required>
                <p>Digite o telefone do dono:</p>
                <input type="text" name="teldono" required>
                <br>
                <button>Cadastrar</button>
            </form>

            <h2 class="esquerda">Animais cadastrados no sistema</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Raça</th>
                        <th>Telefone do dono</th>
                        <th>Cadastro:</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $lista = Animal::listar();
                    foreach ($lista as $animal) {
                        echo "<tr>";
                        echo "<td>" . $animal["id"] . "</td>";
                        echo "<td>" . $animal["nome"] . "</td>";
                        echo "<td>" . $animal["raca"] . "</td>";
                        echo "<td>" . $animal["teldono"] . "</td>";
                        echo "<td>" . $animal["datacadastro"] . "</td>";
                        $id = $animal["id"];
                        echo "<td>
                            <a href='editarAnimal.php?id=$id'>Editar</a> | 
                            <a href='index.php?deletarAnimal=$id'>Deletar</a>
                        </td>";
                        echo "</tr>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <form method="GET" action="AnimalRaca.php">
                <h2>Buscar animal por raça: </h2>
                <select name="raca">
                    <option value=""></option>
                    <?php
                    require_once(__DIR__ . "/model/Animal.php");
                    $animais = Animal::listar();
                    foreach ($animais as $animal) {
                        echo "<option value='{$animal['raca']}'>{$animal['raca']}</option>";
                    }
                    ?>
                </select>
                <br>
                <input type="submit" value="Buscar">
            </form>
            <br>

            <form method="GET" action="AnimalTel.php" class="animaltel">
                <h2>Pesquisar animal por telefone: </h2>
                <select name="teldono" required>
                    <option value="">Selecione um telefone</option>
                    <?php
                    require_once(__DIR__ . "/model/animal.php");
                    $telefones = Animal::listar();

                    foreach ($telefones as $teldono) {
                        echo "<option value='{$teldono['teldono']}'>{$teldono['teldono']}</option>";
                    }
                    ?>
                </select>
                <input type="submit" value="Pesquisar">
            </form>
        </div>

        <div>
            <h1>Cadastro de atendimentos </h1>
            <form method="POST">
                <p>Digite o ID do funcionário: </p>
                <select name="idfuncionario" id="func">
                    <?php
                    $lista = Funcionario::listar();
                    foreach ($lista as $funcionario) {
                        echo "<option value='" . $funcionario["id"] . "'>" . $funcionario["nome"] . "</option>";
                    }
                    ?>
                </select>
                <p>Digite o ID do animal: </p>
                <select name="idanimal" id="animal">
                    <?php
                    $lista = Animal::listar();
                    foreach ($lista as $animal) {
                        echo "<option value='" . $animal["id"] . "'>" . $animal["nome"] . "</option>";
                    }
                    ?>
                </select>
                <br>
                <button>Cadastrar</button>
            </form>
            <h2 class="esquerda">Atendimentos cadastrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Funcionário</th>
                        <th>ID Animal</th>
                        <th>Cadastrado em:</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $lista = Atende::listar();
                    foreach ($lista as $atende) {
                        echo "<tr>";
                        echo "<td>" . $atende["id"] . "</td>";
                        echo "<td style='text-align:center'>" . $atende["idfuncionario"] . "</td>";
                        echo "<td style='text-align:center'>" . $atende["idanimal"] . "</td>";
                        echo "<td>" . $atende["data"] . "</td>";
                        $id = $atende["id"];
                        echo "<td>
                        <a href='index.php?deletarAtende=$id'>Deletar</a>
                    </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <br>
        </div>
    </div>
</body>

</html>