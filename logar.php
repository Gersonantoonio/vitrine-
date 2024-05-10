<?php
session_start(); // Inicia a sessão

require_once "funcoes.php";
include_once('conexao.php');

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

if (!empty($usuario) && !empty($senha)) {

    $sql = "SELECT * FROM professores WHERE usuario = :utilizador";
    $stmt = $conect->prepare($sql);
    $stmt->bindParam(":utilizador", $usuario);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && $senha == $row['Senha']) {
        $_SESSION['Nome'] = $row;
        $funcao = $_SESSION['Nome']['Funcao'];
        if ($funcao == "Admin") {
            header("Location: Admin.php");
            exit; // Termina o script após redirecionar
        } elseif ($funcao == "Aluno") {
            header("Location: Alunos.php");
            exit;
        } elseif ($funcao == "Professor") {
            header("Location: professor_turma_acesso.php");
            exit;
        }
    } else {
        $sql = "SELECT * FROM Alunos WHERE usuario = :utilizador";
        $stmt = $conect->prepare($sql);
        $stmt->bindParam(":utilizador", $usuario);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && $senha == $row['Senha']) {
            $_SESSION['Nome'] = $row;
            $funcao = $_SESSION['Nome']['Funcao'];
            if ($funcao == "Admin") {
                header("Location: Admin.php");
                exit;
            } elseif ($funcao == "Aluno") {
                header("Location: Alunos.php");
                exit;
            } elseif ($funcao == "Professor") {
                header("Location: professor_turma_acesso.php");
                exit;
            }
        } else {
            $sql = "SELECT * FROM admins WHERE usuario = :utilizador";
            $stmt = $conect->prepare($sql);
            $stmt->bindParam(":utilizador", $usuario);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row && $senha == $row['Senha']) {
                $_SESSION['Nome'] = $row;
                
                $funcao = $_SESSION['Nome']['Funcao'];
                if ($funcao == "Admin") {
                    header("Location: Admin.php");
                    exit;
                } elseif ($funcao == "Aluno") {
                    header("Location: Alunos.php");
                    exit;
                } elseif ($funcao == "Professor") {
                    header("Location: professor_turma_acesso.php");
                    exit;
                }
            } else {
                flashMsg('danger', "Dados Incorretos");
                header("Location: index.php");
                exit;
            }
        }
    }
} else {
    flashMsg('warning', "Email ou senha incorretos");
    header("Location: index.php");
    exit;
}
?>
