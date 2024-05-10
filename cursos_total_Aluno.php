<?php
include('includes/header.php'); 
include('includes/aluno.php'); 
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
   
  </div>




  <section class="content">            <!-- /.card -->

<div class="table-responsive" id="showUser" >




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


           

  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>
