<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<style>
  html {
            scroll-behavior: smooth;
        }
  body{
    background-color: rgba(0,0,0,0.7);
    font-family: 'Poppins', sans-serif;
  }
   .wrapper{
    background-color: rgba(0,0,0,0.6);
    color: rgba(255,255,255,0.9);
    border: 1px solid;
    box-shadow: 4px 10px 8px 4px black;
    border-radius: 3px;
  } 
  .details{
    color: rgba(255,255,255,0.9);
  }
  header{
    background-color: #808080;
  }
  .typing-area{
    color: rgba(255,255,255,0.9);
    background-color: #808080;
  }
  .chat-box{
    background-color: #4b4b4b;
  }
  .back-icon{
    color: #f1f2f6;
  }
  .back-icon:hover{
    opacity: 0.6;
  }
  .typing-area button{
    background-color: #20bf6b;
  }
  .chat-area img{
    border: 2px solid white;
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
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $_SESSION['user_id'] = $user_id;
          }else{
            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['img']; ?>" id="myImg" alt="Imagem de Perfil de <?php echo $row['fname']." ".$row['lname'];?>">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">
          
      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Digite uma mensagem aqui..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
    <div id="myModal" class="modal">

<span class="close">&times;</span>

<img class="modal-content" id="img01">

<div id="caption"></div>
</div>
  </div>

  <script src="javascript/chat.js"></script>
  <script>
    function apagar(){
      let apagar = confirm("Deseja apagar a mensgem?");
      if(!apagar){
        event.preventDefault();
      }else{
        alert("Mensagem apagada!");
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
<script>
  function playSound() {
    var audio = new Audio('audio/notificationReceive.mp3');
    audio.play();
  }

  var submitButton = document.querySelector('.typing-area button');
   submitButton.addEventListener('click', function(){
    playSound();
  });

</script>
</body>
</html>
