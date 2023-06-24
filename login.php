<?php 
   session_start();
   if(isset($_SESSION['unique_id'])){
     header("location: users.php");
   }
?>

<?php include_once "header.php"; ?>
<body>
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
    border: 1px solid;
    box-shadow: 4px 10px 8px 4px black;
  }
  header{
    color: rgb(255,255,255,1);
    text-align: center;
  }
  .field-input, #logButton:hover{
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
</style>
  <div class="wrapper">
    <section class="form login">
    <a href="index.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
      <header>Login</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>E-mail: </label>
          <input type="text" name="email" placeholder="Seu endereço de E-mail..." required>
        </div>
        <div class="field input">
          <label>Senha: </label>
          <input type="password" name="password" placeholder="Sua Senha..." required>
          <i onclick="tic()" class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Logar" id="logButton">
        </div>
      </form>
      <div class="link">Não Possui uma Conta? <a href="cadastro.php" id="linkFile">Cadastre-se</a></div>
    </section>
  </div>
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>
</html>
