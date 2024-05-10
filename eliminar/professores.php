<?php
include('../conexao.php');


if(isset($_GET['idDel']))
{
    $id=$_GET['idDel'];
    $delete="DELETE FROM professores WHERE Id=:id";
    try{
$result=$conect->prepare($delete);
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