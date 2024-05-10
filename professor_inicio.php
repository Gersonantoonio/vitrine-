<?php
include('includes/header.php'); 
include('includes/admin.php'); 
?>
<?php

include_once('conexao.php');
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<link href="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
   
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Inserir Alunos na Turma:  <?php
  $id=filter_input(INPUT_GET,'id',FILTER_DEFAULT);

$select="SELECT*FROM turma WHERE Id=:id ORDER BY id DESC LIMIT 6";

$result=$conect->prepare($select);
$cont=1;
$result->bindParam(':id',$id,PDO::PARAM_INT);
$result->execute();
$contar=$result->rowCount();
if($contar>0){
while($show=$result->FETCH(PDO::FETCH_OBJ)){

   echo $show->turma;
  }}
?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modal_novo"><i
        class="fas fa-plus-circle  fa-sm text-white-50" ></i> Novo</a>
  </div>


  
 

  <section class="content">            <!-- /.card -->

<div class="table-responsive" id="showUser" >




<table>
  
<?php
  if(isset($_POST['salvar'])) 
{
$id_turma=filter_input(INPUT_GET,'id',FILTER_DEFAULT);
 $nome=$_POST['Nome'];
 

  $cadastro="INSERT INTO alunos(Nome,turma_id) VALUES(:nome,:turma_id) ";
$result=$conect->prepare($cadastro); 
$result->bindParam(':turma_id',$id_turma,PDO::PARAM_INT);
$result->bindParam(':nome',$nome,PDO::PARAM_STR);
$result->execute();
$contar=$result->rowCount();

if($contar>0){
echo "Dados Cadastrados";
}else{
echo "Dados Não Cadastrado";
}
  

}



  if(isset($_POST['Editar'])) 
{
$id=$_POST['Id'];

$nome=$_POST['nome'];



  $update="UPDATE  alunos  SET Nome=:nome  WHERE Id=:id ";
 
  $result=$conect->prepare($update); 
  $result->bindParam(':id',$id,PDO::PARAM_INT);
  $result->bindParam(':nome',$nome,PDO::PARAM_STR);


  $result->execute();
  $contar=$result->rowCount();
  if($contar>0){
  echo "Dados EDITADOS";
  }else{
  echo "Dados Não EDITADOS";
  }
  }




?>




 <tr>
    <th>#</h>
    <th>Nome</th>
   
    <th>Mais</th>

  </tr>

 <tbody>

 <?php
if(!isset($_GET['id']))
{
  header("Location:turma.php");
  exit;
}
 
$id=filter_input(INPUT_GET,'id',FILTER_DEFAULT);

 $select="SELECT*FROM alunos WHERE turma_id=:id ORDER BY id DESC ";
 try{
$result=$conect->prepare($select);
$cont=1;
$result->bindParam(':id',$id,PDO::PARAM_INT);
$result->execute();
$contar=$result->rowCount();
if($contar>0){
while($show=$result->FETCH(PDO::FETCH_OBJ)){


 ?>
 <tr class=" text-center text-secondary">
  <td> <?php echo $cont++;?> </td>
  <td> <?php echo $show->Nome;?> </td>
  <td>
    
  <a href="eliminar/alunos.php?idDel=<?php echo $show->Id;?>" class="btn btn-danger defbtn" onclick="return confirm('Deseja remover ')"><i class="fa fa-trash" aria-hidden="true" style="color:white;" ></i></a>
  &nbsp;
<a href=""class="btn btn-success editBtn" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $show->Id;?>" ><i class="nav-icon fa fa-edit"></i></a>


  </td>
 
</tr>
<?php
}
}else{

}

 }
 catch(PDOException $e){
echo "Erro".$e->getMessage();
 }
 ?>
 </tbody>
</table>

</div>

</section>


              
<!-- Modal visualizar -->
<div id="modal_novo"  class="modal fade">

  <div class="modal-dialog modal-lg ">
  <div class="modal-content">
  <div class="modal-header">
    <h3 class="modal-title">Cadastrar Aluno</h3>
    <button type="button" class="btn btn-close " data-bs-dismiss="modal"></button>
  </div>
  <div class="modal-body">

 
    <form action="" method="post" class="was-validated p-3" role="form"  id="form-data">
  
    
<div class="container row">
        
  <div class="container col">
    <label for="" class="form-label">Nome Completo</label>
    <input type="text" class="form-control" placeholder="" name="Nome" required>
    

  </div>

 

</div>


<div class="modal-footer">
                     <button class="btn btn-primary" name="salvar" ><i class="fa fa-save"></i>Salvar</button>
                       </div>
    
  </form>

</div>
                      
                     </div>
                   </div>
                   </div>
                   </div>

  
                    <!-- FECHAMENTO DA  Modal visualizar -->


 




   
           

  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>

<?php

                  $select="SELECT*FROM alunos ";
                  try{
                  $result=$conect->prepare($select);

                  $cont=1;
                  $result->execute();
                  $contar=$result->rowCount();
                  if($contar>0){
                  while($show=$result->FETCH(PDO::FETCH_OBJ)){


                  ?>
                      
<!-- Modal visualizar -->
<div id="editModal<?php echo $show->Id;?>"  class="modal fade">

<div class="modal-dialog modal-lg ">
<div class="modal-content">
<div class="modal-header">
  <h3 class="modal-title">Cadastrar Curso</h3>
  <button type="button" class="btn btn-close " data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">


<form action="" method="post" class="was-validated p-3" role="form"  id="form-data">
   
    <input type="text" class="form-control" placeholder="" name="Id" value="<?php echo $show->Id;?>" required hidden>
      
      <div class="container row">
        <div class="container col">
          <label for="" class="form-label" >Ano Lectivo</label>
    <input type="text" class="form-control" placeholder="" name="nome" value="<?php echo $show->Nome;?>" required>
            
             
            </select>
      
        </div>


</div>

<div class="modal-footer">
                     
                     <button class="btn btn-primary" name="Editar" id="update"><i class="fa fa-save">Editar</button>
                     </div>
  
</form>
</div>

       
                   </div>
                 </div>
                 </div>
                  <!-- FECHAMENTO DA  Modal visualizar -->

                  <?php
                  }
                  }
                }
                   
                  catch(PDOException $e){
                  echo "Erro".$e->getMessage();
                  }
                  ?>