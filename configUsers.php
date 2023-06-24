<?php
session_start();
include_once "php/config.php";
if(!isset($_SESSION['unique_id'])){
  header("location: login.php");
  exit();
}
$unique_id = $_SESSION['unique_id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$unique_id}");
$result = mysqli_fetch_assoc($query);
?>
<?=include_once 'header.php'?>
<style>
  html {
            scroll-behavior: smooth;
        }
 body{
    background-color: rgba(0,0,0,0.7);
    font-family: 'Poppins', sans-serif;
  }
.wrapper{
    background-color: rgb(0,0,0,0.4);
    color: rgb(255,255,255,0.7);
    font-weight: light;
  }
  header{
    color: rgb(255,255,255,1);
    text-align: center;
  }
label{
    color: rgba(255,255,255,0.8);
    font-family: 'Poppins', sans-serif;
}
.inputText{
  width: 380px;
  height: 25px;
  color: #d1d8e0;
  background-color: #6e6e6e;
}
.updateData{
    font-family: 'Poppins', sans-serif;
    color: white;
    background-color: #2ed573;
    width: 100px;
}
.updateData:hover{
    background-color: #7bed9f;
    opacity: 0.6;
  }
  input[type=text] {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			box-sizing: border-box;
			border: 3px solid #ccc;
			-webkit-transition: 0.5s;
			transition: 0.5s;
			outline: none;
	}
	input[type=text]:focus {
			border: 3px solid #1e272e;
	}
  .field-input, input::placeholder{
    color: #d1d8e0;
  }
.back-icon{
    color: rgb(255,255,255);
    height: 200px;
    width: 200px;
}.back-icon:hover{
  opacity: 0.6;
}
input[type=file]::file-selector-button {
  border: 2px solid #d2dae2;
  padding: .2em .4em;
  border-radius: .2em;
  background-color: #1e272e;
  color: #d1d8e0;
  transition: 1s;
}

input[type=file]::file-selector-button:hover {
  background-color: #78e08f;
  border: 2px solid #00cec9;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exodus - Configurações</title>
</head>
<body>
  <div class="wrapper">
    <section class="users">
    <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
      <section>
      <header>Configurações</header>
      <form action="configUsers.php" method="post" enctype="multipart/form-data">
        <div>
        <label>Nome:</label> <input type="text" name="fname2" class="inputText" width="100px" required value="<?=$result['fname']?>"> <br>
        <label>Sobrenome:</label> <input type="text" name="lname2" class="inputText" required value="<?=$result['lname']?>"><br>
        <label>Nova senha:</label> <input id="senha" type="password" placeholder=" *preenchimento opcional" name="pass2" class="inputText"><i onclick="passView()" id="olho" class="fas fa-eye"></i> <br>
        <label>Imagem de Perfil:</label><input type="file" name="img2" accept="image/x-png,image/gif,image/jpeg,image/jpg"><br><br>
        <button type="submit" class="updateData" onclick="atualizarDados()"><b>Alterar</b></button>
        </div>
      </form>
      </section>
    </section>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="javascript/pass-show-hide.js"></script>
   <script>
    function atualizarDados(){
      let atualizarDados = confirm("Deseja alterar as informações?");
      if(!atualizarDados){
        event.preventDefault();
      }else{
        alert("Dados atualizados!");
      }
    }
  </script>
</body>
</html>
<?php
if (!empty($_POST)) {
  if (empty($_POST['pass2']) && $_FILES['img2']['error'] != 0) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname2']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname2']);
    $query = mysqli_query($conn, "UPDATE users SET fname = '{$fname}', lname = '{$lname}' WHERE unique_id = {$unique_id}");
    if ($query) {
      header("location: users.php");
    }
  } else if($_FILES['img2']['error'] != 0){
    $fname = mysqli_real_escape_string($conn, $_POST['fname2']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname2']);
    $pass = md5(mysqli_real_escape_string($conn, $_POST['pass2']));
    $query = mysqli_query($conn, "UPDATE users SET fname = '{$fname}', lname = '{$lname}', password = '{$pass}' WHERE unique_id = {$unique_id}");
    if ($query) {
      header("location: users.php");
    }
  } else if (empty($_POST['pass2'])) {
    $img_name = $_FILES['img2']['name'];
    $img_type = $_FILES['img2']['type'];
    $tmp_name = $_FILES['img2']['tmp_name']; 
    $img_explode = explode('.',$img_name);
    $img_ext = end($img_explode);
    $extensions = ["jpeg", "png", "jpg"];
    if(in_array($img_ext, $extensions) === true){
        $types = ["image/jpeg", "image/jpg", "image/png"];
        if(in_array($img_type, $types) === true){
            $time = time();
            $new_img_name = $time.$img_name;
            if(move_uploaded_file($tmp_name,"php/images/".$new_img_name)){
              $fname = mysqli_real_escape_string($conn, $_POST['fname2']);
              $lname = mysqli_real_escape_string($conn, $_POST['lname2']);
              $pass = md5(mysqli_real_escape_string($conn, $_POST['pass2']));
              $query = mysqli_query($conn, "UPDATE users SET fname = '{$fname}', lname = '{$lname}', img = '{$new_img_name}' WHERE unique_id = {$unique_id}");
              if ($query) {
                header("location: users.php");
              }
            }
      }
    }
  } else {
    $img_name = $_FILES['img2']['name'];
    $img_type = $_FILES['img2']['type'];
    $tmp_name = $_FILES['img2']['tmp_name']; 
    $img_explode = explode('.',$img_name);
    $img_ext = end($img_explode);
    $extensions = ["jpeg", "png", "jpg"];
    if(in_array($img_ext, $extensions) === true){
        $types = ["image/jpeg", "image/jpg", "image/png"];
        if(in_array($img_type, $types) === true){
            $time = time();
            $new_img_name = $time.$img_name;
            if(move_uploaded_file($tmp_name,"php/images/".$new_img_name)){
              $fname = mysqli_real_escape_string($conn, $_POST['fname2']);
              $lname = mysqli_real_escape_string($conn, $_POST['lname2']);
              $pass = md5(mysqli_real_escape_string($conn, $_POST['pass2']));
              $query = mysqli_query($conn, "UPDATE users SET fname = '{$fname}', lname = '{$lname}', password = '{$pass}', img = '{$new_img_name}' WHERE unique_id = {$unique_id}");
              if ($query) {
                header("location: users.php");
              }
            }
        }
    }
  }
}