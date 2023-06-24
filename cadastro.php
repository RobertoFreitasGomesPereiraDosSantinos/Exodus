<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<style>
  @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900');
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
    border: 1px solid;
    box-shadow: 4px 10px 8px 4px black;
  }
  header{
    color: rgb(255,255,255,1);
    text-align: center;
  }
  .field-input, #cadButton:hover{
    background-color: #2ed573;
  }
  #linkFile{
    color: #7bed9f;
  }
  .back-icon{
    color: rgb(255,255,255);
    height: 200px;
    width: 200px;
  }
  .back-icon:hover{
    opacity: 0.6;
  }
  .field input, input{
    color: #d1d8e0;
    background-color: #6e6e6e;
  }
  .field-input, input::placeholder{
    color: #d1d8e0;
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

/* CSS do preview */
#previewImage{
  display: none;
  width: 200px;
  height: 200px;
  object-fit: cover;
  border: 2px solid #ddd;
  border-radius: 4px;
  margin-top: 30px;
}
</style>
<body>
  <div class="wrapper">
    <section class="form signup">
    <a href="index.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
      <header>Criar uma conta</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>Nome: </label>
            <input type="text" name="fname" placeholder="Seu Nome..." required>
          </div>
          <div class="field input">
            <label>Sobrenome: </label>
            <input type="text" name="lname" placeholder="Seu Sobrenome..." required>
          </div>
        </div>
        <div class="field input">
          <label>E-mail: </label>
          <input type="text" name="email" placeholder="Seu endereço de E-mail..." required>
        </div>
        <div class="field input">
          <label>Senha: </label>
          <input id="senha" type="password" name="password" placeholder="Sua Senha..." required>
          <i onclick="tic()" class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Selecionar Imagem do Perfil</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
          <img id="previewImage" src="#" alt="Imagem de Perfil" style="display: none;">
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Cadastrar" id="cadButton">
        </div>
      </form>
      <div class="link">Já possui uma conta? <a href="login.php" id="linkFile">Faça Login</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>
<script>
  function previewFile() {
    const preview = document.getElementById('previewImage');
    const file = document.querySelector('input[type=file]').files[0];
    const reader = new FileReader();

    reader.onloadend = function() {
      preview.src = reader.result;
      preview.style.display = 'block';
    }

    if(file){
      reader.readAsDataURL(file);
    }else{
      preview.src = '#';
      preview.style.display = 'none';
    }
  }

  document.querySelector('input[type=file]').addEventListener('change', previewFile);

</script>
</body>
</html>
