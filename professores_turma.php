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
  
  *{
margin: 0;
padding: 0;
box-sizing: border-box;

}  
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
    <h1 class="h3 mb-0 text-gray-800">Professores da Turma : <?php
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




  
<?php

  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['salvar'])) 
{

     $ids = explode(",", $_POST['IdProf']);
        $id1 = $ids[0];
        $id2 = $ids[1];
       

$turma_id=filter_input(INPUT_GET,'id',FILTER_DEFAULT);


  $update="INSERT INTO  turma_acesso(id_turma,id_professor,disciplina_id) VALUES(:turma,:id,:id_dois) ";
 
  $result=$conect->prepare($update); 
  $result->bindParam(':id', $id1,PDO::PARAM_INT);
  $result->bindParam(':turma',$turma_id,PDO::PARAM_INT);
  $result->bindParam(':id_dois', $id2,PDO::PARAM_INT);
  $result->execute();
  $contar=$result->rowCount();
  if($contar>0){
    echo '<div class="alert alert-success" role="alert">
    Professsor Adicionado Com Sucesso!
    </div>';
  }else{
    
    echo '<div class="alert alert-danger" role="alert">
    Falha ao Adicionar!
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

 $select = "SELECT professores.Id, professores.professor, turma_acesso.id_professor, disciplina.Disciplina,cursos.Curso
 FROM professores
 INNER JOIN turma_acesso ON professores.Id = turma_acesso.id_professor
 INNER JOIN disciplina ON disciplina.id_professor = turma_acesso.id_professor
 INNER JOIN cursos ON cursos.Id = disciplina.curso_id
 WHERE turma_acesso.id_turma = :id";
//  $select="SELECT*FROM turma_acesso WHERE id_turma=:id ORDER BY id DESC ";
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
   
   <p style="text-align: center;color: rgb(224, 219, 219);"><?php echo $show->Disciplina;?></p>
   <p style="text-align: center;color: rgb(224, 219, 219);"><?php echo $show->Curso;?> </p>
   <div style="display: flex;justify-content: center;gap: 8px;">
      
<a style="background-color: #08778d;color: white;border: none;padding: 6px;margin-top: 10px;border-radius: 5px;width: 100px;height: 35px;" href="eliminar/professores_turma.php?idDel=<?php echo $show->Id;?>" class="btn btn-danger defbtn" onclick="return confirm('Deseja remover ')"><i class="fa fa-trash" aria-hidden="true" style="color:white;" ></i></a>
  &nbsp;
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
    <select class="form-select" aria-label="Default select example" name="IdProf">
<?php

$select = "SELECT * FROM professores";
$result = $conect->prepare($select);
$result->execute();
$contar = $result->rowCount();
if ($contar > 0) {
    while ($show = $result->fetch(PDO::FETCH_OBJ)) {
?>
        <option value="<?php echo $show->Id;?>,<?php echo $show->disciplina_id;?>"> <?php echo $show->professor;?></option>

<?php
    }
}
?>
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
                   </div>

  
                    <!-- FECHAMENTO DA  Modal visualizar -->


 




   
           

  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>

