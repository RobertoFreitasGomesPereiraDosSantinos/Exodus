const searchBar = document.querySelector(".search input"),
searchIcon = document.querySelector(".search button"),
userStandard = document.getElementById("geral"),
userSenders = document.getElementById("senders"),
userFriends = document.getElementById("friends");


searchIcon.onclick = ()=>{
  searchBar.classList.toggle("show");
  searchIcon.classList.toggle("active");
  searchBar.focus();
  if(searchBar.classList.contains("active")){
    searchBar.value = "";
    searchBar.classList.remove("active");
  }
}

searchBar.onkeyup = ()=>{
  let searchTerm = searchBar.value;
  if(searchTerm != ""){
    searchBar.classList.add("active");
  }else{
    searchBar.classList.remove("active");
  }
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/search.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          userStandard.innerHTML = data;
        }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm);
}

setInterval(() =>{
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php/users.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          if(!searchBar.classList.contains("active")){
            userStandard.innerHTML = data;
          }
        }
    }
  }
  xhr.send();
}, 500);

document.getElementById('padron').click();
function openTab(event, idTab) {
  if (idTab == 'senders') {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/usersRequest", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            if(!searchBar.classList.contains("active")){
              userSenders.innerHTML = data;
            }
          }
      }
    }
    let abas = document.getElementsByClassName('contents')
      for (let index = 0; index < abas.length; index++) {
          abas[index].style.display = 'none'
      }
      let aba = document.getElementById(idTab);
      aba.style.display = 'block'
      let tabs = document.getElementsByClassName('tab-btn')
      for (let index = 0; index < tabs.length; index++) {
          tabs[index].classList.remove('active')
      }
      event.currentTarget.className += ' active'
      xhr.send();
  } else if(idTab == 'geral') {
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "php/users.php", true);
      xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            if(!searchBar.classList.contains("active")){
              userStandard.innerHTML = data;
            }
          }
        }
      }
    let abas = document.getElementsByClassName('contents')
      for (let index = 0; index < abas.length; index++) {
          abas[index].style.display = 'none'
      }
      let aba = document.getElementById(idTab);
      aba.style.display = 'block'
      let tabs = document.getElementsByClassName('tab-btn')
      for (let index = 0; index < tabs.length; index++) {
          tabs[index].classList.remove('active')
      }
      event.currentTarget.className += ' active'
      xhr.send();
  } else if(idTab == 'friends') {
      let xhr = new XMLHttpRequest();
        xhr.open("GET", "php/usersFriends.php", true);
        xhr.onload = ()=>{
          if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
              let data = xhr.response;
              if(!searchBar.classList.contains("active")){
                userFriends.innerHTML = data;
              }
            }
          }
        }
      let abas = document.getElementsByClassName('contents')
        for (let index = 0; index < abas.length; index++) {
            abas[index].style.display = 'none'
        }
        let aba = document.getElementById(idTab);
        aba.style.display = 'block'
        let tabs = document.getElementsByClassName('tab-btn')
        for (let index = 0; index < tabs.length; index++) {
            tabs[index].classList.remove('active')
        }
        event.currentTarget.className += ' active'
        xhr.send();
  }
}
