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


    </style>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Turmas do Curso: <?php
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
 $ano=$_POST['Ano'];
 $classe=$_POST['Classe'];
  $periodo=$_POST['Periodo'];
  $sala=$_POST['Sala'];
  $turma=$_POST['Turma'];


  
 
  $cadastro="INSERT INTO  turma(Curso_id,classe,turno,sala,ano,turma) VALUES(:curso_id,:classe,:turno,:sala,:ano,:turma) ";
$result=$conect->prepare($cadastro); 
$result->bindParam(':curso_id',$id_curso,PDO::PARAM_INT);
$result->bindParam(':classe',$classe,PDO::PARAM_STR);
$result->bindParam(':turno',$periodo,PDO::PARAM_STR);
$result->bindParam(':sala',$sala,PDO::PARAM_STR);
$result->bindParam(':ano',$ano,PDO::PARAM_STR);
$result->bindParam(':turma',$turma,PDO::PARAM_STR);


$result->execute();
$contar=$result->rowCount();

if($contar>0){
  echo '<div class="alert alert-success" role="alert">
  Dados Cadastrado!
</div>';
}else{
  echo '<div class="alert alert-danger" role="alert">
 Dados Não Cadastrado!
</div>';
}
  

}



  if(isset($_POST['Editar'])) 
{
$id=$_POST['Id'];

$ano=$_POST['ano'];
 $classe=$_POST['classe'];
  $periodo=$_POST['periodo'];
  $sala=$_POST['sala'];
  $turma=$_POST['turma'];



  $update="UPDATE  turma  SET classe=:classe,turno=:turno,sala=:sala,ano=:ano,turma=:turma  WHERE Id=:id ";
 
  $result=$conect->prepare($update); 
  $result->bindParam(':id',$id,PDO::PARAM_INT);
  $result->bindParam(':classe',$classe,PDO::PARAM_STR);
  $result->bindParam(':turno',$periodo,PDO::PARAM_STR);
  $result->bindParam(':sala',$sala,PDO::PARAM_STR);
  $result->bindParam(':ano',$ano,PDO::PARAM_STR);
  $result->bindParam(':turma',$turma,PDO::PARAM_STR);

  $result->execute();
  $contar=$result->rowCount();
  if($contar>0){
    echo '<div class="alert alert-primary" role="alert">
    Dados da Turma Editados !
  </div>';
  }else{
    echo '<div class="alert alert-danger" role="alert">
   Erro Ao Editar Dados Da Turma!
   </div>';
  }
  }




?>





   
<div class="acessos">

 <?php
if(!isset($_GET['id']))
{
  header("Location:cursos.php");
  exit;
}
 
$id=filter_input(INPUT_GET,'id',FILTER_DEFAULT);

 $select="SELECT*FROM turma WHERE Curso_id=:id ORDER BY id DESC LIMIT 6";
 try{
$result=$conect->prepare($select);
$cont=1;
$result->bindParam(':id',$id,PDO::PARAM_INT);
$result->execute();
$contar=$result->rowCount();
if($contar>0){
while($show=$result->FETCH(PDO::FETCH_OBJ)){


 ?>





<div class="perfil" style="border: 1px solid white;border-radius: 5px; box-shadow: 1px 1px 4px black;">
         
        
         <div style="background-color: #045869;padding-bottom: 10px;">
             <br>


             <h1 style="font-size: 25px;color: white;text-align: center;margin-bottom: 15px;"><?php echo $show->turma;?> </h1>
           <p style="text-align: center;color: rgb(224, 219, 219);">ClASSE: <?php echo $show->classe;?>*</p>
           <p style="text-align: center;color: rgb(224, 219, 219);">SALA: <?php echo $show->sala;?> </p>
           <p style="text-align: center;color: rgb(224, 219, 219);">PERIODO: <?php echo $show->turno;?></p>
           <div style="display: flex;justify-content: center;gap: 8px;">
              
               <a style="background-color: #08778d;color: white;border: none;padding: 6px;margin-top: 10px;border-radius: 5px;width: 100px;height: 35px;"  href="eliminar/turma.php?idDel=<?php echo $show->Id;?>" class="btn btn-danger defbtn" onclick="return confirm('Deseja remover ')"><i class="fa fa-trash" aria-hidden="true" style="color:white;" ></i></a>
  &nbsp;
<a style="background-color: #08778d;color: white;border: none;padding: 6px;margin-top: 10px;border-radius: 5px;width: 100px;height: 35px;" href=""class="btn btn-success editBtn" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $show->Id;?>" ><i class="nav-icon fa fa-edit"></i></a>

&nbsp;
<a style="background-color: #08778d;color: white;border: none;padding: 6px;margin-top: 10px;border-radius: 5px;width: 100px;height: 35px;" href="alunos_inserir.php?id=<?php echo $show->Id;?>" class="btn btn-info defbtn" ><i class="fas fa-user-graduate" aria-hidden="true" style="color:white;"></i></a>

&nbsp;
<a style="background-color: #08778d;color: white;border: none;padding: 6px;margin-top: 10px;border-radius: 5px;width: 100px;height: 35px;" href="professores_turma.php?id=<?php echo $show->Id;?>" class="btn btn-warning defbtn" ><i class="fas fa-chalkboard-teacher" aria-hidden="true" style="color:white;"></i></a>
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
    <h3 class="modal-title">Cadastrar Turma</h3>
    <button type="button" class="btn btn-close " data-bs-dismiss="modal"></button>
  </div>
  <div class="modal-body">

 
    <form action="" method="post" class="was-validated p-3" role="form"  id="form-data">
      <div class="container row">
   
      
      <div class="container row">
        <div class="container col">
          <label for="" class="form-label" >Ano Lectivo</label>
    <input type="text" class="form-control" placeholder="" name="Ano" required>
            
             
            </select>
      
        </div>



    
</div>

<div class="container row">
        
  <div class="container col">
    <label for="" class="form-label" >Classe</label>
          <select class="form-select" aria-label="Default select example"name="Classe" >
        <option selected>10</option>
        <option >11</option>
        <option >12</option>


      </select>

  </div>
  <div class="container col">
    <label for="" class="form-label" >Turno</label>
          <select class="form-select" aria-label="Default select example"name="Periodo" >
        <option selected>Matinal</option>
        <option>Vespertino</option>
        


      </select>

  </div>

  <div class="container col">
    <label for="" class="form-label" >Sala</label>
          <select class="form-select" aria-label="Default select example"name="Sala" >
        <option selected>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
        <option>11</option>
        <option>12</option>
        <option>13</option>
        <option>14</option>
        <option>15</option>
        <option>16</option>
        <option>17</option>
        <option>18</option>
        <option>19</option>
        <option>20</option>


      </select>

  </div>

  

</div>
      

<div class="container row">
        
  <div class="container col">
    <label for="" class="form-label">Turma</label>
    <input type="text" class="form-control" placeholder="" name="Turma" required>
    

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

                  $select="SELECT*FROM turma ";
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
      <div class="container row">
   
    <input type="text" class="form-control" placeholder="" name="Id" value="<?php echo $show->Id;?>" required hidden>
      
      <div class="container row">
        <div class="container col">
          <label for="" class="form-label" >Ano Lectivo</label>
    <input type="text" class="form-control" placeholder="" name="ano" value="<?php echo $show->ano;?>" required>
            
             
            </select>
      
        </div>



    
</div>

<div class="container row">
        
  <div class="container col">
    <label for="" class="form-label" >Classe</label>
          <select class="form-select" aria-label="Default select example"name="classe" >
        <option value="<?php echo $show->classe;?>" selected></option>
        <option >10</option>
        <option >11</option>
        <option >12</option>


      </select>

  </div>
  <div class="container col">
    <label for="" class="form-label" >Turno</label>
          <select class="form-select" aria-label="Default select example"name="periodo" >
        <option value="<?php echo $show->turno;?>" selected></option>
        <option >Matinal</option>
        <option>Vespertino</option>
        <option>Noturno</option>


      </select>

  </div>

  <div class="container col">
    <label for="" class="form-label" >Sala</label>
          <select class="form-select" aria-label="Default select example"name="sala" >
        <option value="<?php echo $show->sala;?>" selected></option>
        <option value="">1</option>
        <option>2</option>
        <option>3</option>

      </select>

  </div>

  

</div>
      

<div class="container row">
        
  <div class="container col">
    <label for="" class="form-label">Turma</label>
    <input type="text" class="form-control" placeholder="" name="turma" value="<?php echo $show->turma;?>" required>
    

  </div>

 

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