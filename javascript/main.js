setInterval(function getTime(){
	var timestamp = String(Date(Date.now()));
	timestamp = timestamp.split("GMT")[0]
	document.getElementById('date').innerHTML = timestamp;
},100);

//This will be replaced by login handling (check database for valid credentials)
function tempError(){
	alert("We are temporarily not accepting any logins!")
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

function checkUsername(username){
	if (username.len < 6) return false;
	else if (/\s/g.test(username)) return false;
	else return true;
}

function checkPassword(password){
	if (password.len < 6) return false;
	else if (!/\d/.test(password)) return false;
	else if (/\s/g.test(password)) return false;
	else return true
}
