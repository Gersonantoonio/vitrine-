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
    flex-direction: row;
    flex-wrap: wrap;
   gap: 40px;
    flex-direction: row;
}


    </style>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cursos</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modal_novo"><i
        class="fas fa-plus-circle fa-sm text-white-50" ></i> Novo</a>
  </div>




  <section class="content">            <!-- /.card -->

<div class="table-responsive" id="showUser" >




<table>
  
<?php
  if(isset($_POST['salvar'])) 
{
$curso=$_POST['curso'];

  $abreviar=$_POST['abreviar'];
  $area=$_POST['area'];
  $tipo=$_POST['tipo'];

  
 
  $cadastro="INSERT INTO  Cursos(Curso,Abreviacao,Area,Tipo) VALUES(:curso,:abreviar,:area,:tipo) ";
$result=$conect->prepare($cadastro); 
$result->bindParam(':curso',$curso,PDO::PARAM_STR);
$result->bindParam(':abreviar',$abreviar,PDO::PARAM_STR);
$result->bindParam(':area',$area,PDO::PARAM_STR);
$result->bindParam(':tipo',$tipo,PDO::PARAM_STR);

$result->execute();
$contar=$result->rowCount();

if($contar>0){
echo '<div class="alert alert-success" role="alert">
O Curso Foi Cadastrado Com Sucesso!
</div>';
}else{
echo '<div class="alert alert-danger" role="alert">
Não Foi Possível Cadastrar Curso!
</div>';
}
  

}



  if(isset($_POST['Editar'])) 
{
$id=$_POST['Id'];

$curso=$_POST['Curso'];

  $abreviar=$_POST['Abreviacao'];
  $area=$_POST['Area'];
  $tipo=$_POST['Tipo'];

  
  $update="UPDATE  Cursos  SET Curso=:curso,Abreviacao=:Abreviacao,Area=:Area,Tipo=:Tipo  WHERE Id=:id ";
 
  $result=$conect->prepare($update); 
  $result->bindParam(':id',$id,PDO::PARAM_INT);
  $result->bindParam(':curso',$curso,PDO::PARAM_STR);
  $result->bindParam(':Abreviacao',$abreviar,PDO::PARAM_STR);
  $result->bindParam(':Area',$area,PDO::PARAM_STR);
  $result->bindParam(':Tipo',$tipo,PDO::PARAM_STR);
  $result->execute();
  $contar=$result->rowCount();
  if($contar>0){
  echo '<div class="alert alert-primary" role="alert">
  Dados do Curso Editados Com Sucesso!
</div>';
  }else{
  echo '<div class="alert alert-danger" role="alert">
 Não Foi Possível Editar Dados do Curso!
</div>';
  }
  }




?>



<div class="acessos">


 <?php

 $select="SELECT*FROM Cursos ORDER BY id DESC LIMIT 6";
 try{
$result=$conect->prepare($select);
$cont=1;
$result->execute();
$contar=$result->rowCount();
if($contar>0){
while($show=$result->FETCH(PDO::FETCH_OBJ)){


 ?>



<div style="border: 1px solid white; display: flex; align-items: center; box-shadow: 1px 1px 4px black;">
  <img src="enfermeira.png" style="width: 100px;" alt="">
  
  <div style="margin: 10px;margin-left:30px ;">
      <h1 style="font-size: 30px;margin-bottom: 10px;"><?php echo $show->Curso;?> </h1>
      <h2 style="font-size: 20px;margin-bottom: 10px;text-align:center;text-transform:uppercase;color:#bebebe;">Abreviação: <?php echo $show->Abreviacao;?> </h2>
<div style="display: flex;justify-content: center;margin-left: 3px; ">
<a href="eliminar/cursos.php?idDel=<?php echo $show->Id;?>" class="btn btn-danger defbtn" onclick="return confirm('Deseja remover ')"><i class="fa fa-trash" aria-hidden="true" style="color:white;" ></i></a>
  &nbsp;
<a href=""class="btn btn-success editBtn" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $show->Id;?>" ><i class="nav-icon fa fa-edit"></i></a>

&nbsp;
<a href="turma.php?id=<?php echo $show->Id;?>" class="btn btn-info defbtn" ><i class="fas fa-book-open" aria-hidden="true" style="color:white;"></i></a>
&nbsp;
<a href="disciplinas.php?id=<?php echo $show->Id;?>" class="btn btn-warning defbtn" ><i class="fas fa-chalkboard-teacher" aria-hidden="true" style="color:white;"></i></a>
</div>
  </div>
</div>
  

 
<?php
}
}else{

}

 }
 catch(PDOException $e){
echo "Erro".$e->getMessage();
 }
 ?>
 </div>

</div>

</section>


              
<!-- Modal visualizar -->
<div id="modal_novo"  class="modal fade">

  <div class="modal-dialog modal-lg ">
  <div class="modal-content">
  <div class="modal-header">
    <h3 class="modal-title">Cadastrar Curso</h3>
    <button type="button" class="btn btn-close " data-bs-dismiss="modal"></button>
  </div>
  <div class="modal-body">

 
    <form action="" method="post" class="was-validated p-3" role="form"  id="form-data">
      <div class="container row">
   <div class="container col">
          <label for="" class="form-label">Nome do Curso</label>
          <input type="text" class="form-control" name="curso" required>
      </div>

      <div class="container col">
        <label for="" class="form-label">Abreviação</label>
        <input type="text" class="form-control" placeholder="" name="abreviar" >
        
</div>
</div>

<div class="container row">
        
  <div class="container col">
    <label for="" class="form-label">Área de Formação</label>
    <input type="text" class="form-control" placeholder="" name="area" required>
   
  </div>
  <div class="container col">
    <label for="" class="form-label" >Tipo</label>
          <select class="form-select" aria-label="Default select example" name="tipo" >
        <option selected>Selecione o Tipo</option>
        <option>Técnico</option>
        

       
      </select>

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

  
                    <!-- FECHAMENTO DA  Modal visualizar -->


 




   
           

  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>

<?php

                  $select="SELECT*FROM Cursos  ";
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



  <form action="" method="post" class="was-validated p-3" role="form" enctype="multipart/form-data" id="edit-form-data">
    <div class="container row">
 <div class="container col">

 <input type="text" class="form-control" name="Id"  value="<?php echo $show->Id;?> " required hidden>

        <label for="" class="form-label">Nome do Curso</label>
        <input type="text" class="form-control" name="Curso" id="curso" value="<?php echo $show->Curso;?> " required>
    </div>

    <div class="container col">
      <label for="" class="form-label">Abreviação</label>
      <input type="text" class="form-control" placeholder="" name="Abreviacao" id="abreviacao"value="<?php echo $show->Abreviacao;?> " >
      
</div>
</div>

<div class="container row">
      
<div class="container col">
  <label for="" class="form-label">Área de Formação</label>
  <input type="text" class="form-control" placeholder="" name="Area" id="area"value="<?php echo $show->Area;?> " required>
 
</div>
<div class="container col">
  <label for="" class="form-label" >Tipo</label>
        <select class="form-select" aria-label="Default select example"name="Tipo" id="tipo"  >
      <option value="<?php echo $show->Tipo;?> " selected></option>
      <option>Técnico</option>
      

     
    </select>

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
                  <!-- FECHAMENTO DA  Modal visualizar -->

                  <?php
                  }
                  }
                }
                   
                  catch(PDOException $e){
                  echo "Erro".$e->getMessage();
                  }
                  ?>