<?php
include('includes/header.php'); 
include('includes/aluno.php'); 
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
    <h1 class="h3 mb-0 text-gray-800">Área do Aluno</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modal_novo"></a> -->
  </div>


  <section class="content">            <!-- /.card -->

<div class="table-responsive" id="showUser" >
  
<p style="color: black;font-weight: bold;">PAUTA FINAL 2023/2024</p>


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

                       
                        </tr>

                        ';
                      


$id = $_SESSION["Nome"]["Id"];

$select = "SELECT alunos.id, alunos.Nome, disciplina.Id, disciplina.Disciplina, notas_alunos.id_aluno, notas_alunos.i_nota_um, notas_alunos.i_nota_dois, notas_alunos.i_nota_tres, notas_alunos.ii_nota_um, notas_alunos.ii_nota_dois, notas_alunos.ii_nota_tres, notas_alunos.iii_nota_um, notas_alunos.iii_nota_dois, notas_alunos.iii_nota_tres,  notas_alunos.i_media,notas_alunos.ii_media,notas_alunos.iii_media
FROM alunos
INNER JOIN notas_alunos ON alunos.id = notas_alunos.id_aluno
INNER JOIN disciplina ON disciplina.Id = notas_alunos.id_disciplina
WHERE alunos.id = :id";

 try{
$result=$conect->prepare($select);
$cont=1;
$result->bindParam(':id',$id,PDO::PARAM_INT);
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
                    <td rowspan="2" colspan="1" > '.$show->Disciplina.'</td>
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
