<?php
include('includes/header.php'); 
include('includes/professor.php'); 
?>
<?php

include_once('conexao.php');
?>
 
 <?php
include('verificar_login.php');
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<link href="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   

<style>
        table{
            width: 100%;
            border-collapse: collapse;
        }
      
        td{
            border: 1px solid black;
            padding: 10px;
            
        }

       

P{
    text-align: center;
}
.cor{
    background-color: #1b97f0;
    color: white;
   
    font-weight: bold;
}
    </style>   
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Alunos da Turma:  <?php
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
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modal_novo"></a> -->

    <a href=""class="btn btn-success editBtn" data-bs-toggle="modal" data-bs-target="#editModal" >Trimestre I <i class="nav-icon fa fa-edit"></i></a>
<a href=""class="btn btn-warning editBtn" data-bs-toggle="modal" data-bs-target="#editModal" >Trimestre II<i class="nav-icon fa fa-edit"></i></a>
<a href=""class="btn btn-primary editBtn" data-bs-toggle="modal" data-bs-target="#editModal" > Trimestre III<i class="nav-icon fa fa-edit"></i></a>
  </div>




  <section class="content">            <!-- /.card -->

<div class="table-responsive" id="showUser" >
  
<?php



if(isset($_POST['Editar_trimestre_um'])) {
  
  $id = $_POST['Id'];
  $id_disciplina = filter_input(INPUT_GET, 'idDisciplina', FILTER_DEFAULT);

  $i_nota_um = $_POST['i_nota_um'];
  $i_nota_dois = $_POST['i_nota_dois'];
  $i_nota_tres = $_POST['i_nota_tres'];

  $i_media=round(($i_nota_um + $i_nota_dois + $i_nota_tres)/3); 
 
   $sql = "UPDATE notas_alunos SET id_disciplina = :id_disciplina, i_nota_um = :i_nota_um, i_nota_dois = :i_nota_dois, i_nota_tres = :i_nota_tres ,i_media=:i_media WHERE id_aluno=:id";

  $result = $conect->prepare($sql); 
  $result->bindParam(':id', $id, PDO::PARAM_INT);
  $result->bindParam(':id_disciplina', $id_disciplina, PDO::PARAM_INT);
  $result->bindParam(':i_nota_um', $i_nota_um, PDO::PARAM_STR);
  $result->bindParam(':i_nota_dois', $i_nota_dois, PDO::PARAM_STR);
  $result->bindParam(':i_nota_tres', $i_nota_tres, PDO::PARAM_STR);
  $result->bindParam(':i_media', $i_media, PDO::PARAM_STR);
  $result->execute();
  $contar = $result->rowCount();

  if($contar > 0) {
      echo '<div class="alert alert-success" role="alert">
      Notas Inseridas Com Sucesso!
      </div>';
  } else {
      echo '<div class="alert alert-danger" role="alert">
      Falha ao Inserir Notas!
      </div>';
  }
}

?>

<?php
if(isset($_POST['Editar_trimestre_dois'])) {
  
  $id = $_POST['Id_trimestre_dois'];
  $id_disciplina = filter_input(INPUT_GET, 'idDisciplina', FILTER_DEFAULT);
  $ii_nota_um = $_POST['ii_nota_um'];
  $ii_nota_dois = $_POST['ii_nota_dois'];
  $ii_nota_tres = $_POST['ii_nota_tres'];
  $ii_media=round(($ii_nota_um + $ii_nota_dois + $ii_nota_tres)/3); 
 
   $sql = "UPDATE notas_alunos SET id_disciplina = :id_disciplina, ii_nota_um = :i_nota_um, ii_nota_dois = :i_nota_dois, ii_nota_tres = :i_nota_tres,ii_media=:i_media WHERE id_aluno=:id";

  $result = $conect->prepare($sql); 
  $result->bindParam(':id', $id, PDO::PARAM_INT);
  $result->bindParam(':id_disciplina', $id_disciplina, PDO::PARAM_INT);
  $result->bindParam(':i_nota_um', $ii_nota_um, PDO::PARAM_STR);
  $result->bindParam(':i_nota_dois', $ii_nota_dois, PDO::PARAM_STR);
  $result->bindParam(':i_nota_tres', $ii_nota_tres, PDO::PARAM_STR);
  $result->bindParam(':i_media', $ii_media, PDO::PARAM_STR);
  $result->execute();
  $contar = $result->rowCount();

  if($contar > 0) {
      echo '<div class="alert alert-success" role="alert">
      Notas Inseridas Com Sucesso!
      </div>';
  } else {
      echo '<div class="alert alert-danger" role="alert">
      Falha ao Inserir Notas!
      </div>';
  }
}
?>

<?php
if(isset($_POST['Editar_trimestre_tres'])) {
  
  $id = $_POST['Id_trimestre_tres'];
  $id_disciplina = filter_input(INPUT_GET, 'idDisciplina', FILTER_DEFAULT);
  $iii_nota_um = $_POST['iii_nota_um'];
  $iii_nota_dois = $_POST['iii_nota_dois'];
  $iii_nota_tres = $_POST['iii_nota_tres'];
  $iii_media=round(($iii_nota_um + $iii_nota_dois + $iii_nota_tres)/3); 
 
$sql = "UPDATE notas_alunos SET id_disciplina = :id_disciplina, iii_nota_um = :iii_nota_um, iii_nota_dois = :iii_nota_dois, iii_nota_tres = :iii_nota_tres,iii_media=:iii_media WHERE id_aluno=:id";
  
  $result = $conect->prepare($sql); 
  $result->bindParam(':id', $id, PDO::PARAM_INT);
  $result->bindParam(':id_disciplina', $id_disciplina, PDO::PARAM_INT);
  $result->bindParam(':iii_nota_um', $iii_nota_um, PDO::PARAM_STR);
  $result->bindParam(':iii_nota_dois', $iii_nota_dois, PDO::PARAM_STR);
  $result->bindParam(':iii_nota_tres', $iii_nota_tres, PDO::PARAM_STR);
  $result->bindParam(':iii_media', $iii_media, PDO::PARAM_STR);
  $result->execute();
  $contar = $result->rowCount();
  if($contar > 0) {
      echo '<div class="alert alert-success" role="alert">
      Notas Inseridas Com Sucesso!
      </div>';
  } else {
      echo '<div class="alert alert-danger" role="alert">
      Falha ao Inserir Notas!
      </div>';
  }
}
?>



<table style=" margin-top: 10px;">
<tbody>
  
   
<?php
$dados = '';

$dados .= ' 
       
            <tr > 
               
               
                
                </tr>
                <tr > 
                    <td rowspan="2" class="cor"> N</td>
                    <td rowspan="2" class="cor" > Nome Completo</td>
                    
                    <td colspan="5" class="cor">1 Trimestre</td>
                    
                    <td colspan="4" class="cor">2 Trimestre</td>
                    <td colspan="4" class="cor">3 Trimestre</td>
                    <td colspan="4" class="cor">Adicionar Notas</td>
                    
                 </tr>
                       <tr> 
                       
                        <td colspan="2" class="cor"> MAC1</td>
                        <td colspan="1" class="cor"> NPPI</td>
                        <td colspan="1" class="cor"> NPPI</td>
                        <td colspan="1" class="cor"> MTI</td>

                        <td colspan="1" class="cor"> MAC1</td>
                        <td colspan="1" class="cor"> NPPI</td>
                        <td colspan="1" class="cor"> NPPI</td>
                        <td colspan="1" class="cor"> MTI</td>

                        <td colspan="1" class="cor"> MAC1</td>
                        <td colspan="1" class="cor"> NPPI</td>
                        <td colspan="1" class="cor"> NPPI</td>
                        <td colspan="1" class="cor"> MTI</td>

                      
                        <td colspan="1" class="cor"> 1º</td>
                        <td colspan="1" class="cor"> 2º</td>
                        <td colspan="1" class="cor"> 3º</td>
                        </tr>

                        ';
                      

                        if(!isset($_GET['id']))
{
  header("Location:turma.php");
  exit;
}
 
$id=filter_input(INPUT_GET,'id',FILTER_DEFAULT);

$idDisc=filter_input(INPUT_GET,'idDisciplina',FILTER_DEFAULT);
// $select = "SELECT alunos.id, alunos.Nome,alunos.turma_Id, disciplina.Id, disciplina.Disciplina, notas_alunos.id_aluno, notas_alunos.i_nota_um, notas_alunos.i_nota_dois, notas_alunos.i_nota_tres
// FROM alunos
// INNER JOIN notas_alunos ON alunos.id = notas_alunos.id_aluno
// INNER JOIN disciplina ON disciplina.Id = notas_alunos.id_disciplina
// WHERE alunos.id = :id";


 $select="SELECT alunos.id, alunos.Nome, notas_alunos.id_aluno, notas_alunos.i_nota_um, notas_alunos.i_nota_dois, notas_alunos.i_nota_tres, notas_alunos.ii_nota_um, notas_alunos.ii_nota_dois, notas_alunos.ii_nota_tres, notas_alunos.iii_nota_um, notas_alunos.iii_nota_dois, notas_alunos.iii_nota_tres,  notas_alunos.i_media,notas_alunos.ii_media,notas_alunos.iii_media
 FROM alunos
 INNER JOIN notas_alunos ON alunos.id = notas_alunos.id_aluno AND notas_alunos.id_disciplina = :disc

 WHERE turma_id=:id  ORDER BY id DESC ";

 try{
$result=$conect->prepare($select);
$cont=1;
$result->bindParam(':id',$id,PDO::PARAM_INT);
$result->bindParam(':disc',$idDisc,PDO::PARAM_INT);
$result->execute();
$contar=$result->rowCount();
$cor_notas_um;
$cor_notas_dois;
$cor_notas_tres;
$cor_notas_media;

$iicor_notas_um;
$iicor_notas_dois;
$iicor_notas_tres;
$iicor_notas_media;

$iiicor_notas_um;
$iiicor_notas_dois;
$iiicor_notas_tres;
$iiicor_notas_media;

if($contar>0){
while($show=$result->FETCH(PDO::FETCH_OBJ)){
  if($show->i_nota_um>9){
    $cor_notas_um="blue";
}
else{
    $cor_notas_um="red";
}

if($show->i_nota_dois>9){
    $cor_notas_dois="blue";
}
else{
    $cor_notas_dois="red";
}

if($show->i_nota_tres>9){
    $cor_notas_tres="blue";
}
else{
    $cor_notas_tres="red";
}

if($show->i_media>9){
  $cor_notas_media="blue";
}
else{
  $cor_notas_media="red";
}


if($show->ii_nota_um>9){
  $iicor_notas_um="blue";
}
else{
  $iicor_notas_um="red";
}

if($show->ii_nota_dois>9){
  $iicor_notas_dois="blue";
}
else{
  $iicor_notas_dois="red";
}

if($show->ii_nota_tres>9){
  $iicor_notas_tres="blue";
}
else{
  $iicor_notas_tres="red";
}

if($show->i_media>9){
$iicor_notas_media="blue";
}
else{
$iicor_notas_media="red";
}


if($show->iii_nota_um>9){
  $cor_notas_um="blue";
}
else{
  $iiicor_notas_um="red";
}

if($show->iii_nota_dois>9){
  $iiicor_notas_dois="blue";
}
else{
  $iiicor_notas_dois="red";
}



if($show->iii_media>9){
  $iiicor_notas_um="blue";
}
else{
  $iiicor_notas_um="red";
}

if($show->iii_nota_tres>9){
  $iiicor_notas_tres="blue";
}
else{
  $iiicor_notas_tres="red";
}

if($show->iii_media>9){
$iiicor_notas_media="blue";
}
else{
$iiicor_notas_media="red";
}

  $dados .= '           
                            <td rowspan="2"  > '.$cont++.'</td>
                      </tr>

                   <tr > 
                    <td rowspan="2" colspan="1" > '.$show->Nome.'</td>
                    <td rowspan="2" colspan="1" style="color:'.$cor_notas_um.'"> '.$show->i_nota_um.'</td>
                    <td rowspan="2" colspan="2" style="color:'.$cor_notas_dois.'" > '.$show->i_nota_dois.'</td>
                    <td rowspan="2" colspan="1" style="color:'.$cor_notas_tres.'"> '.$show->i_nota_tres.'</td>
                    <td rowspan="2" colspan="1" style="color:'.$cor_notas_media.'">'.$show->i_media.'</td>
                    <td rowspan="2" colspan="1" style="color:'.$iicor_notas_um.'"> '.$show->ii_nota_um.'</td>
                    <td rowspan="2" colspan="1" style="color:'.$iicor_notas_dois.'"> '.$show->ii_nota_dois.'</td>
                    <td rowspan="2" colspan="1" style="color:'.$iicor_notas_tres.'"> '.$show->ii_nota_tres.'</td>
                    <td rowspan="2" colspan="1" style="color:'.$iicor_notas_media.'"> '.$show->ii_media.'</td>
                    <td rowspan="2" colspan="1" style="color:'.$iiicor_notas_um.'"> '.$show->iii_nota_um.'</td>
                    <td rowspan="2" colspan="1" style="color:'.$iiicor_notas_dois.'"> '.$show->iii_nota_dois.'</td>
                    <td rowspan="2" colspan="1" style="color:'.$iiicor_notas_tres.'"> '.$show->iii_nota_tres.'</td>
                    <td rowspan="2" colspan="1" style="color:'.$iiicor_notas_media.'"> '.$show->iii_media.'</td>
                    
                    
                    <td rowspan="2" colspan="1" >
                    <a href=""class="btn btn-success editBtn" data-bs-toggle="modal" data-bs-target="#editModal_trimestre_um'.$show->id_aluno.'" > <i class="nav-icon fa fa-edit"></i></a>
                    
                   

                    <td rowspan="2" colspan="1" >
                    <a href=""class="btn btn-warning editBtn" data-bs-toggle="modal" data-bs-target="#editModal_trimestre_dois'.$show->id_aluno.'" ><i class="nav-icon fa fa-edit"></i></a>
                    </td>

                    <td rowspan="2" colspan="1" >
                    <a href=""class="btn btn-primary editBtn" data-bs-toggle="modal" data-bs-target="#editModal_trimestre_tres'.$show->id_aluno.'" > <i class="nav-icon fa fa-edit"></i></a>
                    </td>
                   </td>

                  
                 </tr>
                 ';
            
                }
            } else {
            }
        } catch (PDOException $e) {
            echo "Erro" . $e->getMessage();
        }
        
        $dados .= '
        </tfoot>

        </table>';
        
        echo $dados;
        ?>

</div>

</section>



   
           

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
<div id="editModal_trimestre_um<?php echo $show->Id;?>"  class="modal fade">

<div class="modal-dialog modal-lg ">
<div class="modal-content">
<div class="modal-header">
  <h3 class="modal-title">Notas 1º Trimestre do(a): <span style="background-color: #1b97f0;font-weight:bold;color:white;"> <?php echo $show->Nome;?></span></h3>
  <button type="button" class="btn btn-close " data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">


<form action="" method="post" class="was-validated p-3" role="form"  id="form-data">
   
    <input type="text" class="form-control" placeholder="" name="Id" value="<?php echo $show->Id;?>" required hidden>
      
      <div class="container row">
        <div class="container col">
          <label for="" class="form-label" >Média de Avaliações</label>
       <input type="number" class="form-control" placeholder="" name="i_nota_um" value="0" >
        </div>
        <div class="container col">
          <label for="" class="form-label" >1º Prova do Professor</label>
       <input type="number" class="form-control" placeholder="" name="i_nota_dois" value="0" >
        </div>
        </div>
        <div class="container row">
        <div class="container col">
          <label for="" class="form-label" >2º Prova do Professor</label>
       <input type="number" class="form-control" placeholder="" name="i_nota_tres" value="0" >
        </div>
       
        </div>

</div>

<div class="modal-footer">
                     
                     <button class="btn btn-primary" name="Editar_trimestre_um" id="update">Salvar</button>
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
<div id="editModal_trimestre_dois<?php echo $show->Id;?>"  class="modal fade">

<div class="modal-dialog modal-lg ">
<div class="modal-content">
<div class="modal-header">
  <h3 class="modal-title">Notas 2º Trimestre do(a): <span style="background-color: #1b97f0;font-weight:bold;color:white;"> <?php echo $show->Nome;?></span></h3>
  <button type="button" class="btn btn-close " data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">


<form action="" method="post" class="was-validated p-3" role="form"  id="form-data">
   
    <input type="text" class="form-control" placeholder="" name="Id_trimestre_dois" value="<?php echo $show->Id;?>" required hidden>
      
      <div class="container row">
        <div class="container col">
          <label for="" class="form-label" >Média de Avaliações</label>
       <input type="number" class="form-control" placeholder="" name="ii_nota_um" value="0" >
        </div>
        <div class="container col">
          <label for="" class="form-label" >1º Prova do Professor</label>
       <input type="number" class="form-control" placeholder="" name="ii_nota_dois" value="0" >
        </div>
        </div>
        <div class="container row">
        <div class="container col">
          <label for="" class="form-label" >2º Prova do Professor</label>
       <input type="number" class="form-control" placeholder="" name="ii_nota_tres" value="0" >
        </div>
       
        </div>

</div>

<div class="modal-footer">
                     
                     <button class="btn btn-primary" name="Editar_trimestre_dois" id="update">Salvar</button>
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
<div id="editModal_trimestre_tres<?php echo $show->Id;?>"  class="modal fade">

<div class="modal-dialog modal-lg ">
<div class="modal-content">
<div class="modal-header">
  <h3 class="modal-title">Notas 3º Trimestre do(a): <span style="background-color: #1b97f0;font-weight:bold;color:white;"> <?php echo $show->Nome;?></span></h3>
  <button type="button" class="btn btn-close " data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">


<form action="" method="post" class="was-validated p-3" role="form"  id="form-data">
   
    <input type="text" class="form-control" placeholder="" name="Id_trimestre_tres" value="<?php echo $show->Id;?>" required hidden>
      
      <div class="container row">
        <div class="container col">
          <label for="" class="form-label" >Média de Avaliações</label>
       <input type="number" class="form-control" placeholder="" name="iii_nota_um" value="0" >
        </div>
        <div class="container col">
          <label for="" class="form-label" >1º Prova do Professor</label>
       <input type="number" class="form-control" placeholder="" name="iii_nota_dois" value="0" required>
        </div>
        </div>
        <div class="container row">
        <div class="container col">
          <label for="" class="form-label" >º3 Prova do Professor</label>
       <input type="number" class="form-control" placeholder="" name="iii_nota_tres" value="0" required>
        </div>
       
        </div>

</div>

<div class="modal-footer">
                     
                     <button class="btn btn-primary" name="Editar_trimestre_tres" id="update">Salvar</button>
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

<script>
    // Limpar campos do modal quando fechado
    $('#editModal_trimestre_um, #editModal_trimestre_dois, #editModal_trimestre_tres').on('hidden.bs.modal', function () {
        $(this).find('input[type="text"], input[type="number"]').val('');
    });
</script>
