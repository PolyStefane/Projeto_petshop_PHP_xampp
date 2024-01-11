<?php

require_once __DIR__ . "/../configs/BancoDados.php";
date_default_timezone_set('America/Sao_Paulo');

class Animal
{
    public static function cadastrar($nome, $raca, $teldono, $data)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "INSERT INTO animal(nome, raca, teldono, datacadastro) VALUES (:pNome,:pRaca, :pTel, :pData)"
            );
            $stmt->execute([
                "pNome" => $nome,
                "pRaca" => $raca,
                "pTel" => $teldono,
                "pData" => $data
            ]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function existeId($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT COUNT(*) FROM animal WHERE id = ?"
            );
            $stmt->execute([$id]);

            $quantidade = $stmt->fetchColumn();
            if ($quantidade > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function existeNome($nome)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT COUNT(*) FROM animal WHERE nome = ?"
            );
            $stmt->execute([$nome]);

            $quantidade = $stmt->fetchColumn();
            if ($quantidade > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function existeTel($teldono)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT COUNT(*) FROM animal WHERE teldono = ?"
            );
            $stmt->execute([$teldono]);

            $quantidade = $stmt->fetchColumn();
            if ($quantidade > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function getAnimalById($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT * FROM animal WHERE id = ?"
            );
            $stmt->execute([$id]);

            return $stmt->fetchAll()[0];
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function editar($id, $nome, $raca, $teldono)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "UPDATE animal SET nome = ?, raca = ?, teldono = ? WHERE id = ?"
            );
            $stmt->execute([$nome, $raca, $teldono, $id]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public static function listar()
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT * FROM animal ORDER BY id"
            );
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function listarRaca($raca)
    {

        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT * FROM animal WHERE raca = ? ORDER BY nome"
            );
            $stmt->execute([$raca]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function listarTelefone($teldono)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT * FROM animal WHERE teldono = ? ORDER BY nome"
            );
            $stmt->execute([$teldono]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function listarFuncionario($idfuncionario)
    {
        try {
            $con = Conexao::getConexao();
            $stmt = $con->prepare("SELECT a.* FROM animal a
                                    INNER JOIN atende at ON at.idanimal = a.id
                                    WHERE at.idfuncionario = ?");
            $stmt->execute([$idfuncionario]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function deletar($idAnimal)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "DELETE FROM animal WHERE id = ?"
            );
            $stmt->execute([$idAnimal]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
