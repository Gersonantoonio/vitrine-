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
 
<style>
  
  .acessos{
      padding: 10px;
      display: flex;
      flex-wrap: wrap;
     gap: 40px;
      flex-direction: row;
  }
  table{
   
      
    width: 100%;   
      border-collapse: collapse;
  
  }  
  td,th{
      padding: 5px;
      color: white;
      background-color: #045869;
      font-size: 20px;
  }
  
  figure{
    
      border-radius: 10px 10px 0px 0px;
      background-color: #08778d;
      padding:15px;
      margin: 0;
  }
  figure h1{
      text-align: center;
      color: white;
  }
  
  
      </style>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Disciplinas do Curso: <?php
  $id=filter_input(INPUT_GET,'id',FILTER_DEFAULT);

$select="SELECT*FROM Cursos WHERE Id=:id ORDER BY id DESC LIMIT 6";

$result=$conect->prepare($select);
$cont=1;
$result->bindParam(':id',$id,PDO::PARAM_INT);
$result->execute();
$contar=$result->rowCount();
if($contar>0){
while($show=$result->FETCH(PDO::FETCH_OBJ)){

   echo $show->Curso;
  }}
?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modal_novo"><i
        class="fas fa-plus-circle  fa-sm text-white-50" ></i> Novo</a>
  </div>


  
 

  <section class="content">            <!-- /.card -->

<div class="table-responsive" id="showUser" >
          

<?php
  if(isset($_POST['salvar'])) 
{
$id_curso=filter_input(INPUT_GET,'id',FILTER_DEFAULT);
 $disciplina=$_POST['Nome'];
 $Desc=$_POST['Desc'];
  
 
  $cadastro="INSERT INTO  disciplina(Disciplina,Descricao,curso_id) VALUES(:disciplina,:descricao,:curso_id) ";
$result=$conect->prepare($cadastro); 
$result->bindParam(':disciplina',$disciplina,PDO::PARAM_STR);
$result->bindParam(':descricao',$Desc,PDO::PARAM_STR);
$result->bindParam(':curso_id',$id_curso,PDO::PARAM_INT);



$result->execute();
$contar=$result->rowCount();

if($contar>0){
echo '<div class="alert alert-success" role="alert">
Disciplina Cadastrado!
</div>';
}else{
echo '<div class="alert alert-danger" role="alert">
Disciplina Não Cadastrado!
</div>';
}
  

}



  if(isset($_POST['Editar'])) 
{
$id=$_POST['Id'];

$disciplina=$_POST['nome'];
$Desc=$_POST['desc'];
 


  $update="UPDATE  disciplina  SET Disciplina=:disciplina,Descricao=:descricao WHERE Id=:id ";
 
  $result=$conect->prepare($update); 
  $result->bindParam(':id',$id,PDO::PARAM_INT);
  $result->bindParam(':disciplina',$disciplina,PDO::PARAM_STR);
  $result->bindParam(':descricao',$Desc,PDO::PARAM_STR);

  $result->execute();
  $contar=$result->rowCount();
  if($contar>0){
  echo '<div class="alert alert-primary" role="alert">
  Dados da Disciplina Editado !
</div>';
  }else{
  echo '<div class="alert alert-danger" role="alert">
 Dados Não Editados!
</div>';
  }
  }




?>

<table>
<figure style="margin: 0;"><h1>Disciplinas</h1></figure>
<thead>
        <th>#</th>
    <th>Disciplina</th>
    <th>Descrição</th>
    <th>Mais</th>
        </thead>
        <tbody>



 <?php
if(!isset($_GET['id']))
{
  header("Location:cursos.php");
  exit;
}
 
$id=filter_input(INPUT_GET,'id',FILTER_DEFAULT);

 $select="SELECT*FROM disciplina WHERE curso_id=:id ORDER BY id DESC ";
 try{
$result=$conect->prepare($select);
$cont=1;
$result->bindParam(':id',$id,PDO::PARAM_INT);
$result->execute();
$contar=$result->rowCount();
if($contar>0){
while($show=$result->FETCH(PDO::FETCH_OBJ)){


 ?>
 


 <tr>
  <td> <?php echo $cont++;?> </td>
  <td> <?php echo $show->Disciplina;?> </td>
  <td> <?php echo $show->Descricao;?> </td>
  
  <td>
    
  <a href="eliminar/disciplinas.php?idDel=<?php echo $show->Id;?>" class="btn btn-danger defbtn" onclick="return confirm('Deseja remover ')"><i class="fa fa-trash" aria-hidden="true" style="color:white;" ></i></a>
  &nbsp;
<a href=""class="btn btn-success editBtn" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $show->Id;?>" ><i class="nav-icon fa fa-edit"></i></a>

&nbsp;
<a href="professores.php?id=<?php echo $show->Id;?>&id_Curso=<?php echo $id=filter_input(INPUT_GET,'id',FILTER_DEFAULT)?>" class="btn btn-info defbtn" ><i class="fas fa-users" aria-hidden="true" style="color:white;"></i></a>


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
    <h3 class="modal-title">Cadastrar Disciplina</h3>
    <button type="button" class="btn btn-close " data-bs-dismiss="modal"></button>
  </div>
  <div class="modal-body">

 
    <form action="" method="post" class="was-validated p-3" role="form"  id="form-data">
    <div class="container row">
   <div class="container col">
          <label for="" class="form-label">Nome da Disciplina</label>
          <input type="text" class="form-control" name="Nome" required>
      </div>


</div>

<div class="container row">
        
  <div class="container col">
    <label for="" class="form-label">Descrição</label>
    <input type="text" class="form-control" placeholder="" name="Desc" >
   

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

                  $select="SELECT*FROM disciplina ";
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
  <h3 class="modal-title">Editar Disciplina</h3>
  <button type="button" class="btn btn-close " data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">


<form action="" method="post" class="was-validated p-3" role="form"  id="form-data">
      <div class="container row">
   
    <input type="text" class="form-control" placeholder="" name="Id" value="<?php echo $show->Id;?>" required hidden>
      
    <div class="container col">
          <label for="" class="form-label">Nome da Disciplina</label>
          <input type="text" class="form-control" name="nome" value="<?php echo $show->Disciplina;?>" required>
      </div>


</div>

<div class="container row">
        
  <div class="container col">
    <label for="" class="form-label">Descrição</label>
    <input type="text" class="form-control" placeholder="" name="desc" value="<?php echo $show->Descricao;?>">
   

  </div>
  </div>

<div class="modal-footer">
                     
                     <button class="btn btn-primary" name="Editar" id="update">Editar</button>
                     </div>
  
</form>
</div>

       
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