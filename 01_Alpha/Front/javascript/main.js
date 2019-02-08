setInterval(function getTime(){
	var timestamp = String(Date(Date.now()));
	timestamp = timestamp.split("GMT")[0]
	document.getElementById('date').innerHTML = timestamp;
},100);

function login(){
	//Setup local data for sending
	var id = document.getElementById("username").value;
    var psw = document.getElementById("password").value;
	var data = {"user":id, "password":psw};
	var fdata = JSON.stringify(data);
	//Send the local data to php file
	var xmlhttp = new XMLHttpRequest();	
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText
		}
    };
	xmlhttp.open('POST','../middle/login.php');
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlhttp.send(fdata);
	//Receive Response 
	if (xmlhttp.readyState === XMLHttpRequest.Done){
		if(xmlhttp.status === 200){
			var response = JSON.parse(xmlhttp.responseText);
			//Chance temp variables once return variables are explecitly defined 
			document.getElementById("NJIT").innerHTML=response.TEMPNJIT;
			document.getElementById("DATABASE").innerHTML=response.TEMPDATABASE;
		} 	
		else {
			alert('There was a problem with the request.');
		}		
	}
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
