<?php
include('verificar_login.php');
?>
<?php
include('includes/header.php'); 
include('includes/professor.php');
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
  gap: 10px;
    padding: 10px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    flex-direction: row;
}




    </style>
   
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Turmas de acesso</h1>
  
  </div>


  
  <section class="content">            <!-- /.card -->

<div class="table-responsive" id="showUser" >







<div class="acessos">

<?php

$id=$_SESSION['Nome']['Id'];
// SELECT turma.id, turma.nome, turma_acesso.professor_nome
// FROM turma
// INNER JOIN turma_acesso ON turma.id = turma_acesso.id_turma
// WHERE turma_acesso.id_professor = :id;



$select="SELECT turma.id, turma.turma, cursos.Curso, turma_acesso.id_professor,turma_acesso.disciplina_id, turma_acesso.id_turma,disciplina.Id, disciplina.Disciplina, professores.disciplina_id
FROM turma
INNER JOIN turma_acesso ON turma.id = turma_acesso.id_turma
INNER JOIN cursos ON turma.curso_id = cursos.Id

INNER JOIN professores ON turma_acesso.disciplina_id= professores.disciplina_id

INNER JOIN disciplina ON disciplina.Id = professores.disciplina_id


WHERE turma_acesso.id_professor = :id";

//  $select="SELECT*FROM turma_acesso WHERE id_professor=:id";

 try{
$result=$conect->prepare($select);
$cont=1;
$result->bindParam(':id',$id,PDO::PARAM_INT);
$result->execute();
$contar=$result->rowCount();
if($contar>0){
while($show=$result->FETCH(PDO::FETCH_OBJ))
{
  

echo'
<a href="alunos_total.php?id='.$show->id_turma.'&idDisciplina='.$show->disciplina_id.'" class="btn btn-success editBtn"  >
<div class="turmas" >
    <h1 style="text-align: center;">'.$show->turma.'</h1>
    <p style="text-align: center;">Disciplina:<span>'.$show->Disciplina.'</span></p>
    <p style="text-align: center;">Curso: <span>'.$show->Curso.'</span></p>
    
</div>
</a>

';

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




   
           

  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>
