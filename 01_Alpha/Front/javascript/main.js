//Clock
setInterval(function getTime(){
	var timestamp = String(Date(Date.now()));
	timestamp = timestamp.split("GMT")[0]
	document.getElementById('date').innerHTML = timestamp;
},100);

//Login functionality
function login(form){
	var ajax=new XMLHttpRequest();
  ajax.onreadystatechange = function(){
    document.getElementById("demo").innerHTML = "loading...";
		if(ajax.readyState == 4 && ajax.status == 200){	
			document.getElementById("demo").innerHTML = this.responseText;
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
