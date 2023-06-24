const pswrdField = document.querySelector(".form input[type='password']"),
toggleIcon = document.querySelector(".form .field i");

function tic() {
  if(pswrdField.type === "password"){
    pswrdField.type = "text";
    toggleIcon.classList.add("active");
  }else{
    pswrdField.type = "password";
    toggleIcon.classList.remove("active");
  }
}
const pass = document.getElementById('senha'),
  olhoIcon = document.getElementById('olho');
  function passView() {
    if(pass.type === "password"){
      pass.type = "text";
      olhoIcon.classList.add("active");
    }else{
      pass.type = "password";
      olhoIcon.classList.remove("active");
    }
  }
  