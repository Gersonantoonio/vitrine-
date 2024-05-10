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
    
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modal_novo"><i
        class="fas fa-plus-circle  fa-sm text-white-50" ></i> Novo</a>
  </div>


  
   
<?php
  if(isset($_POST['salvar'])) 
{
  if(isset($_POST['salvar'])) {
    $id_turma = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
    $nome = $_POST['Nome'];
    
    // Verificar o último ID de aluno inserido
    $verificar_ultimo_id = $conect->query("SELECT MAX(id) FROM alunos");
    $ultimo_id = $verificar_ultimo_id->fetchColumn();
    $novo_id = $ultimo_id + 1; // Incrementar o último ID para criar um novo ID
    
    // Gerar um código único baseado no novo ID
    $codigo_aluno = "ALUNOS" . str_pad($novo_id, 6, '0', STR_PAD_LEFT); // Prefixo "AL" seguido por um número de 6 dígitos
    $Senha="123";
    $FuncaoD="Aluno";
    // Inserir o aluno no banco de dados com o novo ID e o código gerado
    $cadastro = "INSERT INTO alunos(Nome,Senha, usuario, turma_id,Funcao) VALUES(:nome,:senha, :codigo_aluno, :turma_id,:funcao)";
    $result = $conect->prepare($cadastro); 
    $result->bindParam(':nome', $nome, PDO::PARAM_STR);
    $result->bindParam(':senha', $Senha, PDO::PARAM_STR);
    $result->bindParam(':codigo_aluno', $codigo_aluno, PDO::PARAM_STR);
    $result->bindParam(':funcao', $FuncaoD, PDO::PARAM_STR);
    $result->bindParam(':turma_id', $id_turma, PDO::PARAM_INT);
    $result->execute();
    $contar = $result->rowCount();

    if($contar > 0) {
        echo "Dados Cadastrados";
    } else {
        echo "Dados Não Cadastrados";
    }
}


}



  if(isset($_POST['Editar'])) 
{
$id=$_POST['Id'];

$nome=$_POST['nome'];



  $update="UPDATE  alunos  SET Nome=:nome  WHERE Id=:id ";
 
  $result=$conect->prepare($update); 
  $result->bindParam(':id',$id,PDO::PARAM_INT);
  $result->bindParam(':nome',$nome,PDO::PARAM_STR);


  $result->execute();
  $contar=$result->rowCount();
  if($contar>0){
 
    echo '<div class="alert alert-primary" role="alert">
     Dados Editados!
  </div>';

  }else{
    echo '<div class="alert alert-danger" role="alert">
    Falha ao Editar Dados!
    </div>';
  }
  }





  if(isset($_POST['Ativar'])) {
    $id = $_POST['IdAtivar'];
  
    // Verificar se o ID já existe na tabela notas_alunos
    $verificar_existencia = $conect->prepare("SELECT COUNT(*) FROM notas_alunos WHERE id_aluno = :id");
    $verificar_existencia->bindParam(':id', $id, PDO::PARAM_INT);
    $verificar_existencia->execute();
    $existe = $verificar_existencia->fetchColumn();
  
    if($existe > 0) {
      echo '<div class="alert alert-warning" role="alert">
     Este Aluno Já Está Ativo!
    </div>';
    } else {
        // Se o ID não existe, insira-o na tabela
        $cadastro = "INSERT INTO notas_alunos(id_aluno) VALUES(:id)";
        $result = $conect->prepare($cadastro); 
        $result->bindParam(':id', $id, PDO::PARAM_INT);
  
        $result->execute();
        $contar=$result->rowCount();
    if($contar>0)
    {
      echo '<div class="alert alert-primary" role="alert">
       Aluno Ativado!
     </div>';
    }
    else{
      echo '<div class="alert alert-danger" role="alert">
      Erro Ao Ativar Aluno!
    </div>';
    }
  
  }
  }



?>



  <section class="content">            <!-- /.card -->

<div class="table-responsive" id="showUser" >




<table>
<figure style="margin: 0;"><h1><?php
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
?></h1></figure>
       
        <thead>
        <th>#</h>
    <th>Nome Completo</th>
    <th>Nº Interno</th>
    <th>Mais</th>
        </thead>
        <tbody>
           

 <?php
if(!isset($_GET['id']))
{
  header("Location:turma.php");
  exit;
}
 
$id=filter_input(INPUT_GET,'id',FILTER_DEFAULT);

 $select="SELECT*FROM alunos WHERE turma_id=:id ORDER BY id DESC ";
 try{
$result=$conect->prepare($select);
$cont=1;
$result->bindParam(':id',$id,PDO::PARAM_INT);
$result->execute();
$contar=$result->rowCount();
if($contar>0){
while($show=$result->FETCH(PDO::FETCH_OBJ)){


 ?>



            <tr>
                <td><?php echo $cont++;?></td>
                <td><?php echo $show->Nome;?> </td>
                <td><?php echo $show->usuario;?> </td>
                <td>
                  
                <a href="eliminar/alunos.php?idDel=<?php echo $show->Id;?>" class="btn btn-danger defbtn" onclick="return confirm('Deseja remover ')"><i class="fa fa-trash" aria-hidden="true" style="color:white;" ></i></a>
  &nbsp;
<a href=""class="btn btn-success editBtn" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $show->Id;?>" ><i class="nav-icon fa fa-edit"></i></a>
<a href="alunos_ativar_disciplina.php?id=<?php echo $show->Id;?>&idTurma=<?php echo $id_turma = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);?>"class="btn btn-warning editBtn" ><i class="nav-icon fa fa-toggle-on"></i></a>
              
<!-- <a href="alunos_ativar_disciplina?id= echo $show->Id;?>"class="btn btn-warning editBtn" data-bs-toggle="modal" data-bs-target="#editModalActivar echo $show->Id;?>" ><i class="nav-icon fa fa-toggle-on"></i></a>
               -->

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
          <label for="" class="form-label" >Ano Lectivo</label>
    <input type="text" class="form-control" placeholder="" name="nome" value="<?php echo $show->Nome;?>" required>
            
             
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
<div id="editModalActivar<?php echo $show->Id;?>"  class="modal fade">

<div class="modal-dialog modal-lg ">
<div class="modal-content">
<div class="modal-header">
  <h3 class="modal-title">Cadastrar Curso</h3>
  <button type="button" class="btn btn-close " data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">


<form action="" method="post" class="was-validated p-3" role="form"  id="form-data">
   
    <input type="text" class="form-control" placeholder="" name="IdAtivar" value="<?php echo $show->Id;?>" required hidden>
      
      <div class="container row">
        <div class="container col">
         
        <p>Activar Notas do Aluno</p>
      
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
                  }
                  }
                }
                   
                  catch(PDOException $e){
                  echo "Erro".$e->getMessage();
                  }
                  ?>