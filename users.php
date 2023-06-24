<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
    exit();
  }
?>
<?php include_once "header.php"; ?>
<style>
  html {
    scroll-behavior: smooth;
  }
  body {
    background-color: rgba(0, 0, 0, 0.7);
    font-family: 'Poppins', sans-serif;
  }

  .wrapper {
    background-color: rgba(0, 0, 0, 0.3);
    color: rgba(255, 255, 255, 0.7);
    border: 1px solid;
    box-shadow: 4px 10px 6px 4px black;
  }

  .tab {
    background-color: gray;
    border: 2px solid black;
    border-bottom: none;
    border-radius: 5px 5px 0px 0px;
    overflow: hidden; /* Adicionado para ocultar o conteúdo fora do contêiner */
    transition: height 0.3s ease; /* Adicionado para animação de deslize suave */
    position: relative;
    z-index: 1;
  }

  .tab-btn {
    background-color: gray;
    border: none;
    outline: none;
    border-radius: 5px 5px 0px 0px;
    cursor: pointer;
    padding: 10px 16px;
    font-weight: bold;
    transition: background-color 0.3s ease; /* Adicionado para animação de mudança de cor suave */
  }

  .tab-btn:hover {
    background-color: rgb(195, 195, 195);
  }

  .tab-btn.active {
    background-color: rgba(0, 0, 0, 0.3);
    color: #2ed573;
    border-bottom: 3px solid #2ed573;
  }
  .tab-btn.active::after {
    content: "";
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 100%;
    height: 3px;
    background-color: #2ed573;
    animation: slideIn 0.3s ease-in-out;
  }
  @keyframes slideIn {
    0% {
      transform: scaleX(0);
      transform-origin: left;
    }
    100% {
      transform: scaleX(1);
      transform-origin: left;
    }
  }
  .contents {
    border: 1px solid gray;
    border-top: none;
    border-radius: 0px 0px 5px 5px;
    padding: 6px 12px;
    display: none;
    transition: height 0.3s ease; /* Adicionado para animação de deslize suave */
  }

  .invites {
    display: inline;
    width: 100px;
  }

  .users-list,
  .contents {
    color: rgba(255, 255, 255, 0.7);
  }
  .content img{
    border: 2px solid white;
  }
  #geral,
  span {
    color: rgba(255, 255, 255, 0.8);
  }

  #geral,
  p {
    color: #ffffffb3;
  }

  .users header .configUsers:hover {
    opacity: 0.7;
  }

  .users header .logout:hover {
    opacity: 0.7;
  }

  .details p {
    color: #2ed573;
  }

  /* Style the Image Used to Trigger the Modal */
#myImg {
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <img src="php/images/<?php echo $row['img']; ?>" id="myImg" alt="Imagem de Perfil de <?php echo $row['fname']." ".$row['lname'];?>">
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        <a href="configUsers.php" class="logout"><i class="fa-solid fa-user-gear"></i></a>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout" onclick="confirmLogout()">Sair</a>
      </header>
      <div class="search">
        <span class="text">Selecione alguém para conversar</span>
        <input type="text" placeholder="Digite para pesquisar...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
      <div class="tab">
            <button onclick="openTab(event, 'geral')" class="tab-btn" id="padron">Usuários</button>
            <button onclick="openTab(event, 'senders')" class="tab-btn">Pedidos de amizade</button>
            <button onclick="openTab(event, 'friends')" class="tab-btn">Amigos</button>
        </div>
        <div id="geral" class="contents">
          
        </div>
        <div id="senders" class="contents">
            
        </div>
        <div id="friends" class="contents">
            
        </div>
      </div>
    </section>
<div id="myModal" class="modal">

<span class="close">&times;</span>

<img class="modal-content" id="img01">

<div id="caption"></div>
</div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="javascript/users.js"></script>
  <script>
  function confirmLogout() {
    var confirmLogout = confirm("Deseja sair?");
    if (!confirmLogout) {
      event.preventDefault(); 
    }else{
      alert("Saindo...");
    }
  }

  function adicionarList(){
    let adicionarList = confirm("Deseja enviar a solicitação?")
    if(!adicionarList){
      event.preventDefault();
    }else{
      alert("Solicitação enviada!");
    }
  }

  function removeList(){
    let removeList = confirm("Deseja remover o amigo?");
    if(!removeList){
      event.preventDefault();
    }else{
      alert("Amigo removido!");
    }
  }
</script>
<script>
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
</script>
</body>
</html>
