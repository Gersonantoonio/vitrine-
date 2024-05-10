<?php
include('../conexao.php');


if(isset($_GET['idDel']))
{
    $nulo=0;
    $id=$_GET['idDel'];
    $update="DELETE FROM turma_acesso  WHERE id_professor=:id ";
    try{
$result=$conect->prepare($update);
$result->bindValue(':id',$id,PDO::PARAM_INT);

$result->execute();
$contar=$result->rowCount();

if($contar>0)
{
header("Location:../cursos.php");
}
else{
header("Location:../cursos.php");

}
    }
    catch(PDOException $e){
        echo"ERRO AO DELETAR".$e->getMessage();
    }
}