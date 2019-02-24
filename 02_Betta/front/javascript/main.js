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
   	if(ajax.readyState == 4 && ajax.status == 200){	
      var data = JSON.parse(this.responseText);
      alert(this.responseText);
      var database = data.role; 
  	  if (database == 2){
      window.location.replace('teacherview.html')
      }
      else if (database == 1){
      window.location.replace('studentview.html')
      }
      else{
      alert("INVALID USERNAME AND PASSWORD");
      }
      return;
    }
  }
  ajax.open("POST", "../php/login.php", true);
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajax.send("request_id=LOGIN"+"&username="+form.username.value+"&password="+form.password.value);
}

//Add Question
//Arguemnts: Questions data
//ReturnL None
function addquestion(form){
}

//Get All
//Arguments: None
//Return: JSON of all questions
function getall(){
}

//Create Exam
//Arguments: Exam id and points
//Return: None
function createexam(form){
}


//Apply Filter
//Arguments: Filters
//Return: JSON of remaining questions
function applyfilter(form){
}