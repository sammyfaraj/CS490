//Clock
setInterval(function getTime(){
	var timestamp = String(Date(Date.now()));
	timestamp = timestamp.split("GMT")[0]
	document.getElementById('date').innerHTML = timestamp;
},100);

//Icon Handler
var happy = "./happy.png"
var sad = "./sad.png"
var meh  = "./meh.png"

var happyimg = [
  '<div class="uicomponent-panel-controls-container">',
  '<img src=' + happy + '>',
  '</div>'
].join('\n');

var sadimg = [
  '<div class="uicomponent-panel-controls-container">',
  '<img src=' + sad + '>',
  '</div>'
].join('\n');

var mehimg = [
  '<div class="uicomponent-panel-controls-container">',
  '<img src=' + meh + '>',
  '</div>'
].join('\n');

//Login functionality
function login(form){
  document.getElementById("nthink").innerHTML = 'NJIT LOADING...';
  document.getElementById("dthink").innerHTML = 'DATABASE LOADING...';
	var ajax=new XMLHttpRequest();
  ajax.onreadystatechange = function(){
   	if(ajax.readyState == 4 && ajax.status == 200){	
      var data = JSON.parse(this.responseText);
      var database = data.BACKEND;
      var njit = data.NJIT; 
      document.getElementById("nthink").innerHTML = 'NJIT:';
      document.getElementById("dthink").innerHTML = 'DATABASE:';  
      if (njit == 1){
      document.getElementById("dock1").innerHTML = happyimg;
      }
      else{
      document.getElementById("dock1").innerHTML = sadimg;
      }
  		  if (database == 0){
      document.getElementById("dock2").innerHTML = happyimg;
      }
      else if (database == 1){
      document.getElementById("dock2").innerHTML = mehimg;
      }
      else{
      document.getElementById("dock2").innerHTML = sadimg;
      }
      return;
    	}
	}
	  ajax.open("POST", "../middle/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	  ajax.send("username="+form.username.value+"&password="+form.password.value);
}




//This will soon include the addition of valid credentials to database
function registerForm(){
	var id = document.getElementById("username").value;
    var psw = document.getElementById("password").value;
	if (checkPassword(psw) && checkUsername(id) == true) window.location.href = "outer.html";
	else{
		alert("Invalid Username or Password:\nPassword must have a number\nUsername andPassword must have no whitespace\nUsername and Password must be greater then six characters");
		window.location.href = "register.html";
	}
}

//Check if username is in proper format
function checkUsername(username){
	if (username.len < 6) return false;
	else if (/\s/g.test(username)) return false;
	else return true;
}

//Check if password is in proper format
function checkPassword(password){
	if (password.len < 6) return false;
	else if (!/\d/.test(password)) return false;
	else if (/\s/g.test(password)) return false;
	else return true
}
