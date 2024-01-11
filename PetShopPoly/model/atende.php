<?php

require_once __DIR__ . "/../configs/BancoDados.php";

class Atende
{
    public static function cadastrar($idfuncionario, $idanimal, $data)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "INSERT INTO atende(idfuncionario, idanimal, data) VALUES (:pFunc,:pAnimal, :pData)"
            );
            $stmt->execute([
                "pFunc" => $idfuncionario,
                "pAnimal" => $idanimal,
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

    public static function listar()
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT * FROM atende ORDER BY id"
            );
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function listarPorFunc($idFunc)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT * FROM atende WHERE idfuncionario = ?"
            );
            $stmt->execute($idFunc);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function deletar($idAtende)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "DELETE FROM atende WHERE id = ?"
            );
            $stmt->execute([$idAtende]);

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
                "SELECT COUNT(*) FROM atende WHERE id = ?"
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

    public static function existeAtende($idFunc, $idAnimal)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT COUNT(*) FROM atende WHERE idfuncionario = ? AND idanimal = ?"
            );
            $stmt->execute([$idFunc, $idAnimal]);

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
}
