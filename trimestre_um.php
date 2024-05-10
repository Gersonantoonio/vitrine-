<?php
include('verificar_login.php');
?>
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
        table{
            width: 100%;
            border-collapse: collapse;
        }
      
        td{
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            
        }
        

       

P{
    text-align: center;
}
.cor{
    background-color: #1b97f0;
    color: white;
    font-weight: bold;
    text-align: center;
}
    </style>   

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Área do Aluno </h1>
  
  </div>




  <section class="content">            <!-- /.card -->

<div class="table-responsive" id="showUser" >





<p style="color: black;font-weight: bold;">BOLETIM DE NOTAS-I TRIMESTRE 2023/2024</p>

    </div>
   
<table style=" margin-top: 10px;">



<tbody>
  
 

<?php
$dados = '';

$dados .= '
<table>
    <thead>
        <tr>
            <th rowspan="2" class="cor">Nº</th>
            <th rowspan="2" class="cor">Disciplina</th>
            <th colspan="5" class="cor" style="text-align: center;">I Trimestre</th>
        </tr>
        <tr>
            <th colspan="2" class="cor">MAC1</th>
            <th colspan="1" class="cor">NPPI</th>
            <th colspan="1" class="cor">NPPI</th>
            <th colspan="1" class="cor">MTI</th>
        </tr>
    </thead>
    <tbody>';

$id = $_SESSION["Nome"]["Id"];

$select = "SELECT alunos.id, alunos.Nome, disciplina.Id, disciplina.Disciplina, notas_alunos.id_aluno, notas_alunos.i_nota_um, notas_alunos.i_nota_dois, notas_alunos.i_nota_tres,notas_alunos.i_media
FROM alunos
INNER JOIN notas_alunos ON alunos.id = notas_alunos.id_aluno
INNER JOIN disciplina ON disciplina.Id = notas_alunos.id_disciplina
WHERE alunos.id = :id";
$cor_notas_um;
$cor_notas_dois;
$cor_notas_tres;
$cor_notas_media;
try {
    $result = $conect->prepare($select);
    $result->bindParam(":id", $id, PDO::PARAM_INT);
    $result->execute();
    $n=1;
    $contar = $result->rowCount();
    if ($contar > 0) {
        while ($show = $result->fetch(PDO::FETCH_OBJ)) {

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

           
            $dados .= '

            <tr>
                <td rowspan="2">' . ($n++) . '</td>
               
            </tr>
            
            <tr>
                
                <td rowspan="2">' . $show->Disciplina . '</td>
                <td rowspan="2" colspan="1" style="color:'.$cor_notas_um.'">' . $show->i_nota_um . '</td>
                <td rowspan="2" colspan="2" style="color:'.$cor_notas_dois.'">' . $show->i_nota_dois . '</td>
                <td rowspan="2" colspan="1" style="color:'.$cor_notas_tres.'">' . $show->i_nota_tres . '</td>
                 <td rowspan="2" colspan="1" style="color:'.$cor_notas_media.'">' . $show->i_media . '</td>
            </tr>';
            
        }
    } else {
        // Tratamento para nenhum resultado encontrado
    }
} catch (PDOException $e) {
    echo "Erro" . $e->getMessage();
}

$dados .= '
    </tbody></table>';

echo $dados;
?>


</div>
</section>


   
           

  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>

