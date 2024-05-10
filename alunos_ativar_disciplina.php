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
    
   
  </div>


  
   
<?php
  

  if(isset($_POST['Ativar'])) {
    $idDISC = $_POST['IdAtivar'];
  $id_aluno=filter_input(INPUT_GET,'id',FILTER_DEFAULT);
  
    // Verificar se o ID já existe na tabela notas_alunos
    $verificar_existencia = $conect->prepare("SELECT COUNT(*) FROM notas_alunos  WHERE  id_disciplina = :idDisc AND id_aluno = :idAluno  ");
    $verificar_existencia->bindParam(':idDisc', $idDISC, PDO::PARAM_INT);
    $verificar_existencia->bindParam(':idAluno', $id_aluno, PDO::PARAM_INT);
    
    $verificar_existencia->execute();
    $existe = $verificar_existencia->fetchColumn();
  
    if($existe > 0) {
      echo '<div class="alert alert-warning" role="alert">
      Esta Disciplina Já Está Ativo!
    </div>';
    } 
    else {
        // Se o ID não existe, insira-o na tabela
        $cadastro = "INSERT INTO notas_alunos(id_aluno,id_disciplina) VALUES(:idAluno, :idDisc)";
        $result = $conect->prepare($cadastro); 
        $result->bindParam(':idAluno', $id_aluno, PDO::PARAM_INT);
        $result->bindParam(':idDisc', $idDISC, PDO::PARAM_INT);
        $result->execute();
        $contar=$result->rowCount();
    if($contar>0)
    {
      echo '<div class="alert alert-primary" role="alert">
       Disciplina Ativado!
     </div>';
    }
    else{
      echo '<div class="alert alert-danger" role="alert">
      Erro Ao Ativar Disciplina!
    </div>';
    }
  
  }
  }



?>



  <section class="content">            <!-- /.card -->

<div class="table-responsive" id="showUser" >




<table>
<figure style="margin: 0;"><h1><?php
  $idAluno=filter_input(INPUT_GET,'id',FILTER_DEFAULT);

$select="SELECT*FROM alunos WHERE Id=:id ORDER BY id DESC LIMIT 6";

$result=$conect->prepare($select);
$cont=1;
$result->bindParam(':id',$idAluno,PDO::PARAM_INT);
$result->execute();
$contar=$result->rowCount();
if($contar>0){
while($show=$result->FETCH(PDO::FETCH_OBJ)){

   echo $show->Nome;
  }}
?></h1></figure>
       
        <thead>
        <th>#</h>
    <th>Disciplinas</th>
    <th>Ativar</th>
        </thead>
        <tbody>
           

 <?php
if(!isset($_GET['idTurma']))
{
  header("Location:turma.php");
  exit;
}
 
$id_turma=filter_input(INPUT_GET,'idTurma',FILTER_DEFAULT);

$select="SELECT disciplina.Disciplina,turma_acesso.disciplina_id
FROM disciplina
INNER JOIN turma_acesso ON disciplina.Id = turma_acesso.disciplina_id

WHERE id_turma=:id";

//  $select="SELECT*FROM alunos WHERE turma_id=:id ORDER BY id DESC ";
 try{
$result=$conect->prepare($select);
$cont=1;
$result->bindParam(':id',$id_turma,PDO::PARAM_INT);
$result->execute();
$contar=$result->rowCount();
if($contar>0){
while($show=$result->FETCH(PDO::FETCH_OBJ)){


 ?>



            <tr>
                <td><?php echo $cont++;?></td>
                <td><?php echo $show->Disciplina;?> </td>
                <td>
                  
                
<a href=""class="btn btn-warning editBtn" data-bs-toggle="modal" data-bs-target="#editModalActivar<?php echo $show->disciplina_id;?>" ><i class="nav-icon fa fa-toggle-on"></i></a>
              
              </td>
                
            </tr>

            
            <!-- <tr>
                <td style="border-radius:0px 0px 0px 10px;"><i class="fa fa-address-book" aria-hidden="true"></i> &nbsp;Número de BI &nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></td>
                <td style="border-radius:0px 0px 10px 0px;">025A564MJ790</td>
            </tr> -->
       


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
           $id_turma=filter_input(INPUT_GET,'idTurma',FILTER_DEFAULT);

           $select="SELECT disciplina.Disciplina,turma_acesso.disciplina_id
           FROM disciplina
           INNER JOIN turma_acesso ON disciplina.Id = turma_acesso.disciplina_id
           
           WHERE id_turma=:id";
           
           //  $select="SELECT*FROM alunos WHERE turma_id=:id ORDER BY id DESC ";
            try{
           $result=$conect->prepare($select);
           $cont=1;
           $result->bindParam(':id',$id_turma,PDO::PARAM_INT);
           $result->execute();
           $contar=$result->rowCount();
           if($contar>0){
           while($show=$result->FETCH(PDO::FETCH_OBJ)){
           

                  ?>
                      
<!-- Modal visualizar -->
<div id="editModalActivar<?php echo $show->disciplina_id;?>"  class="modal fade">

<div class="modal-dialog modal-lg ">
<div class="modal-content">
<div class="modal-header">
  <h3 class="modal-title">Ativar Disciplina para o Aluno</h3>
  <button type="button" class="btn btn-close " data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">


<form action="" method="post" class="was-validated p-3" role="form"  id="form-data">
   
    <input type="text" class="form-control" placeholder="" name="IdAtivar" value="<?php echo $show->disciplina_id;?>" required hidden>
      
      <div class="container row">
        <div class="container col">
         
        <p>Activar Notas do Aluno </p>
      
        </div>


</div>

<div class="modal-footer">
                     
                     <button class="btn btn-primary" name="Ativar" id="update">Ativar</button>
                     </div>
  
</form>
</div>

       
                   </div>
                 </div>
                 </div>
                  <!-- FECHAMENTO DA  Modal visualizar -->
                  
                  <?php

               echo $show->disciplina_id;
                  }
                  }
                }
                   
                  catch(PDOException $e){
                  echo "Erro".$e->getMessage();
                  }
                  ?>