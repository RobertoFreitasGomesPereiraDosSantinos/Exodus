<?php
session_start();
if(isset($_SESSION['unique_id'])){
  header("location: users.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXODUS | Seu lugar para conversar </title>
    <link rel="icon" type="image/icon" href="logo/logochatbg.png">
    <style>
        html {
            scroll-behavior: smooth;
        }
        body{
            background-color: rgba(0,0,0,0.8);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }
        h1{
            color: rgb(255,255,255);
            text-align: center;
            align-items: center;
            animation: fadeIn 3s;
        }
        @keyframes fadeIn {
  0% { opacity: 0; }
  100% { opacity: 1; }
}
        b{
            color: #2ed573;
        }
        a{
            text-decoration: none;
            color: white;
            font-family: 'Poppins', sans-serif;
        }
        a:hover{
            opacity: 0.3;
            color: #2ed573;
        }
        button{
            height: 45px;
            border: none;
            color: #fff;
            font-size: 17px;
            background: #333;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 13px;
        }
        header {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            background-color: #3ae374;
            padding: 20px 20px;
        }
        nav {
            width: 200px;
            display: flex;
            justify-content: space-between;
        }
        #nomeLogo{
            color: #3ae374;
            font-family: 'Poppins', sans-serif;
            font-size: 6vw;
            font-weight: bold;
            font-variant: small-caps;
            margin-top: 30px;
            margin-left: 30px;
         }
        #linhaRodape{
            border: 4px #3ae374 solid;
        }
        footer{
            margin-top: 300px;
        }
        .copyright{
            color: #3ae374;
            font-family: 'Poppins', sans-serif;
            font-size: X-Large;
            font-weight: bold;
            font-variant: small-caps;
            margin-top: -60px;
            margin-left: 1250px;
         }
        #linkExodus{
            text-decoration: none;
            color: #3ae374;
            font-family: 'Poppins', sans-serif;
        }
        .nomeExodus{
            color: #f1f2f6;
            font-family: 'Poppins', sans-serif;
            font-size: 6vw;
            font-weight: bold;
            font-variant: small-caps;
            margin-top: 30px;
            margin-left: 30px;
            -webkit-text-stroke-width: 2px;
            -webkit-text-stroke-color: #000;
        }
        #logoCopy{
            color: #3ae374;
            font-family: 'Poppins', sans-serif;
            font-size: 3.5vw;
            font-weight: bold;
            font-variant: small-caps;
            margin-top: -65px;
            margin-left: 1200px;
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.1);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader {
            border: 4px solid #fff;
            border-top: 4px solid #2ed573;
            border-radius: 50%;
            width: 40px;
             height: 40px;
            animation: spin 1s linear infinite;
        }

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
section { height: 90vh; }
.tag {
  opacity: 0;
  transform: translate(0, 10vh);
  transition: all 1s;
}

.tag.visible {
  opacity: 1;
  transform: translate(0, 0);
}

.red { background-color: rgba(0,0,0,0.2); }
.blue { background-color: rgba(0,0,0,0.2); }
.green { background-color: rgba(0,0,0,0.2); }


    </style>
</head>
<body>
<header>
    <div><a href='#' class = "logo"><img src="logo/logochatbg.png" width="140" height="140"></a></div>
    <div class="nomeExodus">EXODUS</div>
    <nav>    
   <button><a href="cadastro.php" class="logo">Registrar-se</a></button>
   <button><a href="login.php" class="logo">Login</a></button>
    </nav> 
</header>
   <h1>Bem-Vindo ao <b>Exodus</b></h1>
   <h1> Nós estamos animados em recebê-lo(a) em nossa plataforma, onde você pode se conectar e trocar mensagens com pessoas de todo o mundo. <br>

 </h1>
<section class="tag red"><h1>Seja para enviar mensagens de texto, ou simplesmente para conversar com novos amigos, você está no lugar certo!</h1><img src="imagesSite/imageUsers" style="margin-left: 820px;"></section>
<section class="tag blue"><h1>Nossa plataforma é fácil de usar e oferece recursos avançados de mensagens para garantir uma experiência de usuário agradável e segura. Além disso, nossa comunidade é moderada para assegurar um ambiente amigável e respeitoso. Então, prepare-se para explorar e desfrutar de conversas significativas, compartilhar histórias, interesses e criar conexões duradouras em nosso site de mensagens online. Estamos ansiosos para ter você conosco e ver as amizades e relacionamentos que você irá construir aqui!</h1><img src="imagesSite/imageChat" style="margin-left: 520px;"></section>
<section class="tag green"  style="margin-top: 100px;"><h1>Junte-se a nós agora e comece a sua jornada de mensagens online!
</h1><img src="imagesSite/imageRegister" style="margin-left: 520px;"><br>
<button style="margin-left: 700px; background: #2ed573; border: 2px solid; box-shadow: 4px 4px 4px 4px black; font-weight: bold;"><a href="cadastro.php" class="logo">Registrar-se</a></button> </section>
<h1>
<br> - Atenciosamente,
<b>Exodus<b>.
</h1>
<footer>
    <hr id="linhaRodape">
<div id='nomeLogo'><a href='#' id="linkExodus">Exodus</a></div>

<div class='copyright'><i>Corporation <br>NULL POINT - 2023</i></div>
<div id="logoCopy">&copy;</div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  //função para pegar os elementos e criar as variáveis
    $(document).on("scroll", function() {
  var pageTop = $(document).scrollTop();
  var pageBottom = pageTop + $(window).height();
  var tags = $(".tag");
  //percorre as variáveis adicionando as funções
  for (var i = 0; i < tags.length; i++) {
    var tag = tags[i];
    if ($(tag).position().top < pageBottom) {
      $(tag).addClass("visible");
    } else {
      $(tag).removeClass("visible");
    }
  }
});


</script>
<script>
$(document).ready(function() {
  // Função para exibir a animação de loading
  function showLoadingAnimation() {
    // Cria um elemento de overlay
    var overlay = $('<div class="overlay"></div>');

    // Adiciona a animação de loading ao overlay
    var loader = $('<div class="loader"></div>');
    overlay.append(loader);

    // Adiciona o overlay ao corpo do documento
    $('body').append(overlay);
  }

  // Evento de clique no botão "Registrar-se"
  $('button a[href="cadastro.php"]').click(function(e) {
    e.preventDefault(); // Impede o comportamento padrão do link
    showLoadingAnimation(); // Exibe a animação de loading

    // Redireciona para a página de cadastro após um pequeno atraso (para visualizar a animação)
    setTimeout(function() {
      window.location.href = "cadastro.php";
    }, 2000); // Tempo de atraso em milissegundos (aqui é 2 segundos, você pode ajustar conforme necessário)
  });

  // Evento de clique no botão "Login"
  $('button a[href="login.php"]').click(function(e) {
    e.preventDefault(); // Impede o comportamento padrão do link
    showLoadingAnimation(); // Exibe a animação de loading

    // Redireciona para a página de login após um pequeno atraso (para visualizar a animação)
    setTimeout(function() {
      window.location.href = "login.php";
    }, 1500); // Tempo de atraso em milissegundos (aqui é 1.5 segundos, você pode ajustar conforme necessário)
  });
});
</script>

</body>
</html>