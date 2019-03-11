//Login functionality
//Arguemnts: Username and password
//Return: 0/1/2
function login(form) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var data = JSON.parse(this.responseText);
            var database = data.role;
            if (database == 2) {
                window.location.replace('teacherview.html')
            } else if (database == 1) {
                window.location.replace('studentview.html')
                localStorage.setItem("loginusername",form.username.value);
            } else {
                alert("INVALID USERNAME AND PASSWORD");
            }
            return;
        }
    }
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("request_id=LOGIN" +
        "&username=" + form.username.value +
        "&password=" + form.password.value);
}

//Add Question to Database
//Arguemnts: Questions data
//Return: None
function addquestion(form) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            getall();
            var data = JSON.parse(this.responseText);
            document.getElementById("createquestionform").reset();
            return;
        }
    }
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send(
        "request_id=ADD_QUESTION" +
        "&intro=" + form.newintro.value +
        "&id=null" +
        "&topic=" + form.newtopic.value +
        "&diff=" + form.newdiff.value +
        "&score=" + form.newscore.value +
        "&func_name=" + form.newfuncname.value +
        "&paramname=" + form.newpname.value +
        "&paramtype=" + form.newptype.value +
        "&inone=" + form.newinone.value +
        "&outone=" + form.newoutone.value +
        "&intwo=" + form.newintwo.value +
        "&outtwo=" + form.newouttwo.value);
}

//Get All Questions
//Arguments: None
//Return: JSON of all questions
function getall() {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            clearquestions();
            for (x of JSON.parse(this.responseText)) {
                var id = x[0];
                var qstn = x[1];
                var topic = x[2];
                var diff = x[3];
                addbutton(qstn, id, diff, topic);
            }
        }
    }
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("request_id=GET_ALL");
}

//Create Exam
//Arguments: Exam id and points
//Return: None
function createexam(form) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            window.location.replace('teacherview.html')
            return;
        }
    }
    var qarray = []
    var qids = document.getElementById("buttoninleft").querySelectorAll(".qbutton");
    for (const qid of qids) {
        qarray.push(qid.id);
    }
    //var qarr =  JSON.stringify(qarray);
    var sarray = []
    var qscores = document.getElementById("buttoninleft").querySelectorAll(".qbuttonscore");
    for (const qscore of qscores) {
        sarray.push(qscore.value)
    }
    //var sarr =  JSON.stringify(sarray);
    var examName = document.getElementById("examName").value;
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("request_id=CREATE_EXAM" + 
    "&exam_name=" + examName + 
    "&questions=" + qarray + 
    "&scores=" + sarray
    );
}

//Apply Filter to Questions
//Arguments: Filters
//Return: JSON of remaining questions
function applyfilter(form) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            clearquestions();
            for (x of JSON.parse(this.responseText)) {
                var id = x[0];
                var qstn = x[1];
                var topic = x[2];
                var diff = x[3];
                addbutton(qstn, id, diff, topic);
                }
        }
    }
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("request_id=FILTER" +
        "&topic=" + form.qfiltertopic.value +
        "&diff=" + form.qfilterdiff.value +
        "&key=" + form.qfilterkey.value
    );
}

//Check if an Exam Exists, Teacher Side
//Arguments: None
//Return: 1/0
function tisavailable(){
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var data = JSON.parse(this.responseText);
            status = data.status;
            if (status == 1) {
                alert("Cannot Create Exam When One is Active!");
            } else if (status == 0) {
                window.location.replace('createexam.html');
            } else {
                alert("Error");
            }
            return 1;
        }
    }
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("request_id=IS_AVAILABLE");
}

//Check if an Exam Exists, Student Side
//Arguments: None
//Return: 1/0
function sisavailable(){
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var data = JSON.parse(this.responseText);
            status = data.status;
            if (status == 1) {
                window.location.replace('takeexam.html');
            } else if (status == 0) {
                alert("No Exam is Available to Take!");
            } else {
                alert("Error");
            }
            return 1;
        }
    }
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("request_id=IS_AVAILABLE");
}


//Get the Currently Active Exam
//Arguments: None
//Return: Active Exam Questions
function getactive() {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var data = JSON.parse(this.responseText);
            for (x of data) {
              addquestionbox(x[0]);
            }
            return;
        }
    }
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("request_id=GET_ACTIVE_EXAM");
}

//Submit a Completed Exam
//Arguments: Answers of student
//Return: None
function submitexam(){
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            alert(this.responseText);
            window.location.replace('studentview.html')
            return;
        }
    }
    var aarray = "";
    var answers = document.getElementById("buttoninright").querySelectorAll(".answers");
    for (var answer of answers){
      aarray +=  answer.value + "|~|";
    }
    
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("request_id=SUBMIT_EXAM" +
    "&answers=" + aarray +
    "&username=" + localStorage.getItem('loginusername'));
}

//Get All Pending Grades
//Arguments: None
//Return: Username, Questions, Answers, Scores, Comments
function reviewgrades(){
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var data = JSON.parse(this.responseText);
            return;
        }
    }
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("request_id=GET_TEMP_GRADES");
} 

//Teacher Changes Active Exam to Inactive
//Arguments: None
//Return: None
function endexam(){
var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var data = JSON.parse(this.responseText);
            return;
        }
    }
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("request_id=END_EXAM");
}

//Get Temp Grades
//Arguments: None
//Return: Username, Scores, Answers, Comments
function gettempgrades(){
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
           var data = JSON.parse(this.responseText);

           for (x of data) {
            username = x[0];
            scores = x[1];
            answers = x[2];
            comments = x[3];
            createscorebutton(username,scores,answers,comments);
            }
            return;
        }
    }
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("request_id=GET_TEMP_GRADES");
} 

//Creates Buttons for username
//Arguments:Username, Scores, Answers, Comments 
function createscorebutton(username,scores,answers,comments){
    var button = document.createElement("input");
    var linebreak = document.createElement("br");
    button.type = "button";
    button.value = username;
    button.id = username;
    button.className = 'qbutton';
    button.onclick = function() {
        window.location.replace('usernamescores.html');
        localStorage.setItem("username",username);
        localStorage.setItem("scores",scores);
        localStorage.setItem("answers",answers);
        localStorage.setItem("comments",comments);
    };
    document.getElementById('buttonin').appendChild(linebreak);
    document.getElementById('buttonin').appendChild(button);
    document.getElementById('buttonin').appendChild(linebreak);
}

//Create field for teacher to see student info
//Arguments: Username, Scores, Answers, Comments 
function teacherreview(username,scores,answers,comments){
    var usernamebox = document.createElement("input");
      usernamebox.type = "text";
      usernamebox.placeholder = "scores";
      usernamebox.id = 'usernamebox';
      usernamebox.value = username;
      
    document.getElementById('buttonin').appendChild(usernamebox);
    
    scores = scores.split(",");
    answers = answers.split("|~|");
    comments = comments.split(",");
    
    for (var i = 0; i < scores.length; i++){
      var scoresbox = document.createElement("input");
      scoresbox.type = "text";
      scoresbox.placeholder = "scores";
      scoresbox.id = 'scoresbox';
      scoresbox.className = 'qbuttonscore';
      scoresbox.value = scores[i];
    
    var answersbox = document.createElement("textarea");
      answersbox.rows = "5";
      answersbox.cols = "80";
      answersbox.placeholder = "answers";
      answersbox.id = 'answersbox';
      answersbox.value = answers[i];
      answersbox.className = "answers";
    
    var commentsbox = document.createElement("textarea");
      commentsbox.rows = "5";
      commentsbox.cols = "80";
      commentsbox.placeholder = "comments";
      commentsbox.id = 'commentsbox';
      commentsbox.value = comments[i];
      commentsbox.className = "comments";
      
    var linebreak0 = document.createElement("br");
    var linebreak1 = document.createElement("br");
    var linebreak2 = document.createElement("br");

    
    
    document.getElementById('buttonin').appendChild(linebreak0)
    document.getElementById('buttonin').appendChild(scoresbox); 
    
    document.getElementById('buttonin').appendChild(linebreak1); 
    document.getElementById('buttonin').appendChild(answersbox);
    
    document.getElementById('buttonin').appendChild(linebreak2); 
    document.getElementById('buttonin').appendChild(commentsbox);
      }
    
}

//Post Final Grades 
//Arguments: None
//Return: None
function postfinalgrades(){
  
  fanswer = ''
  fcomment = ''
  fscore = ''
  
  var fusername = document.getElementById('usernamebox').value;
  
  var answers = document.getElementById("buttonin").querySelectorAll(".answers");
    for (const answer of answers) {
      fanswer += answer.value + '|~|';
    }
  var comments = document.getElementById("buttonin").querySelectorAll(".comments");
    for (const comment of comments) {
      fcomment += comment.value + ',';
    }
  var scores = document.getElementById("buttonin").querySelectorAll(".qbuttonscore");
    for (const score of scores) {
      fscore +=score.value +',';
    }
    
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            window.location.replace('studentscores.html')
            return;
        }
    }
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("request_id=POST_FINAL_GRADES" +
    "&answers=" + fanswer.slice(0, -3) +
    "&comments=" + fcomment.slice(0, -1) +
    "&scores=" + fscore.slice(0, -1) +
    "&username=" + fusername);
}



//Get Final Grades
function getfinalgrades(){
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
           var data = JSON.parse(this.responseText);
            scores = data.grades.split(",");
            answers = data.answers.split("|~|");
            comments = data.comments.split(",");
            
            for (var i = 0; i < scores.length; i++){
            
                  var scoresbox = document.createElement("input");
                  scoresbox.type = "text";
                  scoresbox.placeholder = "scores";
                  scoresbox.id = 'scoresbox';
                  scoresbox.className = 'qbuttonscore';
                  scoresbox.value = scores[i];
                
                var answersbox = document.createElement("textarea");
                  answersbox.rows = "5";
                  answersbox.cols = "80";
                  answersbox.placeholder = "answers";
                  answersbox.id = 'answersbox';
                  answersbox.value = answers[i];
                  answersbox.className = "answers";
                
                var commentsbox = document.createElement("textarea");
                  commentsbox.rows = "5";
                  commentsbox.cols = "80";
                  commentsbox.placeholder = "comments";
                  commentsbox.id = 'commentsbox';
                  commentsbox.value = comments[i];
                  commentsbox.className = "comments";
                  
                var linebreak0 = document.createElement("br");
                var linebreak1 = document.createElement("br");
                var linebreak2 = document.createElement("br");
            
                
                
                document.getElementById('buttonin').appendChild(linebreak0)
                document.getElementById('buttonin').appendChild(scoresbox); 
                
                document.getElementById('buttonin').appendChild(linebreak1); 
                document.getElementById('buttonin').appendChild(answersbox);
                
                document.getElementById('buttonin').appendChild(linebreak2); 
                document.getElementById('buttonin').appendChild(commentsbox);
                  }             
        }
    }
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("request_id=GET_FINAL_GRADES" +
    "&username=" + localStorage.getItem('loginusername'));
} 






//Add Text Boxes for Student Taking Exam
//Arguments: Text
function addquestionbox(value){
    var question = document.createTextNode(value);
    var linebreak1 = document.createElement("br");
    var linebreak2 = document.createElement("br");
    var linebreak3 = document.createElement("br");
    var textarea = document.createElement("textarea");
    textarea.rows = "5";
    textarea.cols = "80";
    textarea.id = value;
    textarea.className = "answers";
    document.getElementById('buttoninright').appendChild(linebreak1);
    document.getElementById('buttoninright').appendChild(question);
    document.getElementById('buttoninright').appendChild(linebreak2);
    document.getElementById('buttoninright').appendChild(textarea);
    document.getElementById('buttoninright').appendChild(linebreak3);
}

//Add QButton on Right
//Arguments: Question Value, ID, Difficulty, and Topic
function addbutton(value, id, diff, topic) {
    var button = document.createElement("input")
    button.type = "button";
    button.value = value;
    button.id = id + 'bparent';
    button.className = 'qbutton';
    button.onclick = function() {
        movebutton(value, id)
    };
    document.getElementById('buttoninright').appendChild(button)
}

//Shift QButton from Righ to Left
//Qbutton ID and Value
function movebutton(value, id) {
    var button = document.createElement("input");
    var score = document.createElement("input");
    score.type = "text"
    score.placeholder = "Enter the amount of points this question is worth"
    score.id = id + 'bscore';
    score.className = 'qbuttonscore';
    button.type = "button";
    button.value = value;
    button.id = id;
    button.className = 'qbutton';
    button.onclick = function() {
        removeElement(id, id + "bscore")
    };
    document.getElementById('buttoninleft').appendChild(button);
    document.getElementById('buttoninleft').appendChild(score);
}

//Removes QButton on Left
//Arguments: Qbutton ID and Score ID
function removeElement(bId, sId) {
    var button = document.getElementById(bId);
    var score = document.getElementById(sId);
    button.parentNode.removeChild(button);
    score.parentNode.removeChild(score);
}

//Clear All Right Qbuttons
//Arguments: None
function clearquestions(){
  var myNode = document.getElementById("buttoninright");
  while (myNode.firstChild) {
      myNode.removeChild(myNode.firstChild);
  }
}









































