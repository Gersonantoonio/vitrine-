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
    <h1 class="h3 mb-0 text-gray-800">Cadastrar Professor Para Disciplina: <?php
  $id=filter_input(INPUT_GET,'id',FILTER_DEFAULT);

$select="SELECT*FROM disciplina WHERE Id=:id ORDER BY id DESC LIMIT 6";

$result=$conect->prepare($select);
$cont=1;
$result->bindParam(':id',$id,PDO::PARAM_INT);
$result->execute();
$contar=$result->rowCount();
if($contar>0){
while($show=$result->FETCH(PDO::FETCH_OBJ)){

   echo $show->Disciplina;
  }}
?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modal_novo"><i
        class="fas fa-plus-circle  fa-sm text-white-50" ></i> Novo</a>
  </div>


  
 

  <section class="content">            <!-- /.card -->

<div class="table-responsive" id="showUser" >



<div class="acessos">


  
<?php
  if(isset($_POST['salvar'])) 
{
  
  $id_disciplina = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
  $nome = $_POST['Nome'];
  $Funcao="Professor";
  // Verificar se já existe um professor para esta disciplina
  $verificar_professor = $conect->prepare("SELECT COUNT(*) FROM professores WHERE disciplina_id = :id");
  $verificar_professor->bindParam(':id', $id_disciplina, PDO::PARAM_INT);
  $verificar_professor->execute();
  $professor_existente = $verificar_professor->fetchColumn();
  
  if($professor_existente > 0) {
      echo '<div class="alert alert-warning" role="alert">
      Já existe um professor para esta disciplina!
</div>';
  } 
  
  else {

 // Gerar um código único para o professor
 $verificar_ultimo_id = $conect->query("SELECT MAX(Id) FROM professores");
 $ultimo_id = $verificar_ultimo_id->fetchColumn();
 $novo_id = $ultimo_id + 1;
 $codigo_professor = "PROF" . str_pad($novo_id, 6, '0', STR_PAD_LEFT);
 

    $Senha = "123"; // Definição da senha do professor (apenas um exemplo)
    $cadastro_professor = "INSERT INTO professores (professor, disciplina_id, Senha,Funcao,usuario) VALUES(:nome, :disciplina_id, :senha,:funcao,:usuario)";
    $result_professor = $conect->prepare($cadastro_professor); 
    $result_professor->bindParam(':nome', $nome, PDO::PARAM_STR);
    $result_professor->bindParam(':disciplina_id', $id_disciplina, PDO::PARAM_INT);
    $result_professor->bindParam(':senha', $Senha, PDO::PARAM_STR); 
    $result_professor->bindParam(':funcao', $Funcao, PDO::PARAM_STR); 
    $result_professor->bindParam(':usuario', $codigo_professor, PDO::PARAM_STR); 
    $result_professor->execute();
    $contar_professor = $result_professor->rowCount();

      if($contar_professor > 0) {
          echo '<div class="alert alert-success" role="alert">
          Professor cadastrado Para Esta Disciplina!
</div>';
      } else {
          echo '<div class="alert alert-danger" role="alert">
         Erro Ao Cadastrar Dados, Consulte o Programador!
        </div>';
      }
  }
  
 
}




if(isset($_POST['EditarA'])) 
{
  $id=filter_input(INPUT_GET,'id',FILTER_DEFAULT);

  $id2=$_POST['IdA'];



  $update="UPDATE  disciplina  SET id_professor=:professor  WHERE Id=:id ";
 
  $result=$conect->prepare($update); 
  $result->bindParam(':id',$id,PDO::PARAM_INT);
  $result->bindParam(':professor',$id2,PDO::PARAM_INT);

  $result->execute();
  $contar=$result->rowCount();
  if($contar>0){
    echo '<div class="alert alert-success" role="alert">
   Este Professor agora esta ativo!
</div>';
  }
  else{
    echo '<div class="alert alert-danger" role="alert">
         Não Foi Possível Activar este Professor, Consulte o Programador!
        </div>';
  }
  }




?>




<?php

  if(isset($_POST['Editar'])) 
{
$id=$_POST['Id'];

$nome=$_POST['nome'];



  $update="UPDATE  professores  SET professor=:professor  WHERE Id=:id ";
 
  $result=$conect->prepare($update); 
  $result->bindParam(':id',$id,PDO::PARAM_INT);
  $result->bindParam(':professor',$nome,PDO::PARAM_STR);

  $result->execute();
  $contar=$result->rowCount();
  if($contar>0){
  
    echo '<div class="alert alert-primary" role="alert">
    Dados Atualizado!
  </div>';

  }else{
    echo '<div class="alert alert-danger" role="alert">
    Falha ao Editar Dados!
    </div>';
  }
  }




?>




 <?php
if(!isset($_GET['id']))
{
  header("Location:cursos.php");
  exit;
}
 
$id=filter_input(INPUT_GET,'id',FILTER_DEFAULT);

 $select="SELECT*FROM professores WHERE disciplina_id=:id ORDER BY id DESC ";
 try{
$result=$conect->prepare($select);
$cont=1;
$result->bindParam(':id',$id,PDO::PARAM_INT);
$result->execute();
$contar=$result->rowCount();
if($contar>0){
while($show=$result->FETCH(PDO::FETCH_OBJ)){


 ?>






<div class="perfil" style="border: 1px solid white;border-radius: 5px; box-shadow: 1px 1px 4px black;width: 270px;">
    <div style=" display: flex;flex-direction: column;align-items: center;padding: 30px;">

   <div style="border: 4px solid #dad1d1e9;width: 100px;height: 100px;border-radius: 50%;padding-top: 4px;padding-left: 3px;">

    <img src="enfermeira.png" alt="" style="width: 85px;height: 85px;border-radius: 50%; border: 2px solid pink;">
   </div>
</div>

<div style="background-color: #045869;padding-bottom: 10px;">
   <br>
   <h1 style="font-size: 25px;color: white;text-align: center;margin-bottom: 15px;"><?php echo $show->professor;?> </h1>
   
   <p style="text-align: center;color: rgb(224, 219, 219);"><?php echo $show->usuario;?></p>
   <p style="text-align: center;color: rgb(224, 219, 219);"><?php echo $show->Funcao;?> </p>
   <div style="display: flex;justify-content: center;gap: 8px;">
      


   <a style="background-color: #08778d;color: white;border: none;padding: 6px;margin-top: 10px;border-radius: 5px;width: 100px;height: 35px;" href="eliminar/professores.php?idDel=<?php echo $show->Id;?>" class="btn btn-danger defbtn" onclick="return confirm('Deseja remover ')"><i class="fa fa-trash" aria-hidden="true" style="color:white;" ></i></a>
  &nbsp;
<a style="background-color: #08778d;color: white;border: none;padding: 6px;margin-top: 10px;border-radius: 5px;width: 100px;height: 35px;" href=""class="btn btn-primary editBtn" data-bs-toggle="modal" data-bs-target="#editModala<?php echo $show->Id;?>" ><i class="nav-icon fa fa-toggle-on"></i></a>

<a style="background-color: #08778d;color: white;border: none;padding: 6px;margin-top: 10px;border-radius: 5px;width: 100px;height: 35px;" href=""class="btn btn-success editBtn" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $show->Id;?>" ><i class="nav-icon fa fa-edit"></i></a>

   </div>
   <hr style="background-color:#08778d; margin-top: 5px;outline: none;border: none;padding: 1px;margin: 10px 20px 10px 20px;">
  <h1 style="color: white;font-size: 20px;margin-left: 15px;">Habilidades</h1>
   <p style="color: rgb(232, 224, 224);margin-left:10px ;text-align: justify;margin-right: 10px;">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
   
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
    <h3 class="modal-title">Cadastrar Professor</h3>
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

                  $select="SELECT*FROM professores ";
                  try{
                  $result=$conect->prepare($select);

                  $cont=1;
                  $result->execute();
                  $contar=$result->rowCount();
                  if($contar>0){
                  while($show=$result->FETCH(PDO::FETCH_OBJ)){


                  ?>
                      
<!-- Modal visualizar -->
<div id="editModala<?php echo $show->Id;?>"  class="modal fade">

<div class="modal-dialog modal-lg ">
<div class="modal-content">
<div class="modal-header">
  <h3 class="modal-title">Cadastrar Curso</h3>
  <button type="button" class="btn btn-close " data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">


<form action="" method="post" class="was-validated p-3" role="form"  id="form-data">
   
    <input type="text" class="form-control" placeholder="" name="IdA" value="<?php echo $show->Id;?>" required hidden>
      
      <div class="container row">
        <div class="container col">
         
      <P>Activar Professor</P>
        </div>


</div>

<div class="modal-footer">
                     
                     <button class="btn btn-primary" name="EditarA" id="update">Editar</button>
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




<?php

                  $select="SELECT*FROM professores ";
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
          <label for="" class="form-label" >Nome Completo</label>
    <input type="text" class="form-control" placeholder="" name="nome" value="<?php echo $show->professor;?>" required>
            
             
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