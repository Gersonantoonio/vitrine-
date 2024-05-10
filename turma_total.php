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
    <h1 class="h3 mb-0 text-gray-800">Total de Turmas: <?php
  $id=filter_input(INPUT_GET,'id',FILTER_DEFAULT);

$select="SELECT*FROM turma";

$result=$conect->prepare($select);
$cont=1;
$result->execute();
$contar=$result->rowCount();

echo $contar;
?></h1>
    
  </div>


  
 

  <section class="content">            <!-- /.card -->

<div class="table-responsive" id="showUser" >




<div class="acessos">

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


             




   
           

  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>
