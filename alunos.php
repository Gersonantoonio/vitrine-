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
    flex-wrap: wrap;
   gap: 40px;
    flex-direction: row;
}
table{
 
    
  width: 100%;   
    border-collapse: collapse;

}  
td{
    padding: 20px;
    color: white;
    background-color: #045869;
    font-size: 20px;
}

figure{
    border-radius: 10px 10px 0px 0px;
    background-color: #08778d;
    padding:20px;
    margin: 0;
}
figure h1{
    text-align: center;
    color: white;
}


    </style>
<!-- Begin Page Content -->
<div class="container-fluid">





  <section class="content">            <!-- /.card -->

<div class="acessos">


<?php
$dados = '';


$id = $_SESSION["Nome"]["Id"];

$select = "SELECT alunos.id, alunos.Nome,alunos.usuario, cursos.Curso,turma.turma ,turma.classe,turma.sala
FROM alunos
INNER JOIN turma ON turma.Id = alunos.turma_id
INNER JOIN cursos ON cursos.Id = turma.Curso_id
WHERE alunos.id = :id";

try {
    $result = $conect->prepare($select);
    $result->bindParam(":id", $id, PDO::PARAM_INT);
    $result->execute();
    $n=1;
    $contar = $result->rowCount();
    if ($contar > 0) {
        while ($show = $result->fetch(PDO::FETCH_OBJ)) {
            $dados .= '

<div class="perfil" style="border: 1px solid white;border-radius: 5px; padding: 10px; box-shadow: 1px 1px 4px black;width: 270px;">
    <div style=" display: flex;flex-direction: column;align-items: center;">

   <div style="border: 4px solid #dad1d1e9;width: 100px;height: 100px;border-radius: 50%;padding-top: 4px;padding-left: 3px;">

    <img src="enfermeira.png" alt="" style="width: 85px;height: 85px;border-radius: 50%; border: 2px solid pink;">
   </div>
<h1 style="font-size: 23px;margin-top: 7px;">' . $show->Nome . '</h1>
<h1 style="font-size: 15px;margin-top: 2px;color: #c2bebe;">' . $show->Curso . '</h1>
</div>
<hr style="margin-top: 20px;">

<p style="margin-top: 20px;">Turma: <span style="margin-left:125px;color:steelblue;font-weight:bold;">' . $show->turma . '</span></p>
<hr>
<p style="margin-top: 20px;" >Classe: <span style="margin-left:170px;color:steelblue;font-weight:bold;">' . $show->classe. '</span></p> 
<hr>
<p style="margin-top: 20px;"> Sala: <span style="margin-left:185px;color:steelblue;font-weight:bold;">' . $show->sala . '</span></p> 
<hr >

<button style="background-color: #08778d;color: white;border: none;padding: 6px;margin-top: 10px;border-radius: 10px;width: 120px;" class="visualizar">Visualizar</button>
</div>

<div style="border: 1px solid white;width: 60%;height:0px;">
   

    <table >
        <figure><h1>Informações Pessoais</h1></figure>
        
        <thead>
           
        </thead>
        <tbody>
            <tr>
                <td><i class="fa fa-id-card-o" aria-hidden="true"></i> &nbsp;Nº Interno :</td>
                <td><span style="color: #a01604e9;font-weight: bold;">' . $show->usuario . '</span></td>
            </tr>

            <tr>
                <td><i class="fa fa-address-book" aria-hidden="true"></i> &nbsp;Contacto :</i></td>
                <td><span style="color: #a01604e9;font-weight: bold;">025A564</span></td>
            </tr>

            <tr>
                <td> <i class="fa fa-user-circle-o" aria-hidden="true"></i> &nbsp;Nome do Pai &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></td>
                <td>Manuel Fulama:</td>
            </tr>
            <tr>
                <td><i class="fa fa-female" aria-hidden="true"></i> &nbsp;Nome da Mãe &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></td>
                <td>Manuela fula:</td>
            </tr>
            <tr>
                <td style="border-radius:0px 0px 0px 10px;"><i class="fa fa-address-book" aria-hidden="true"></i> &nbsp;Número de BI &nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></td>
                <td style="border-radius:0px 0px 10px 0px;">025A564MJ790</td>
            </tr>
        </tbody>
    </table>

</div>

    </div>
    ';
   
}
} else {
    // Tratamento para nenhum resultado encontrado
}
} catch (PDOException $e) {
echo "Erro" . $e->getMessage();
}


echo $dados;
?>


</section>

</div>
  

           

  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>

