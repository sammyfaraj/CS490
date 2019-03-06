//Login functionality
//Arguemnts: Username and password
//Return: 0/1/2
function login(form) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            alert(this.responseText);
            var data = JSON.parse(this.responseText);
            var database = data.role;
            if (database == 2) {
                window.location.replace('teacherview.html')
            } else if (database == 1) {
                window.location.replace('studentview.html')
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
//Add Question
//Arguemnts: Questions data
//Return: None
function addquestion(form) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            getall();
            alert("ADD_QUESTION");
            alert(this.responseText);
            var data = JSON.parse(this.responseText);
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
//Get All
//Arguments: None
//Return: JSON of all questions
function getall() {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            clearquestions();
            alert("GET_ALL");
            alert(JSON.parse(this.responseText));
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
            alert("CREATE_EXAM");
            alert(this.responseText);
            return;
        }
    }
    var qarray = []
    var qids = document.getElementById("buttoninleft").querySelectorAll(".qbutton");
    for (const qid of qids) {
        qarray.push(qid.id[0])
    }
    //var qarr =  JSON.stringify(qarray);
    var sarray = []
    var qscores = document.getElementById("buttoninleft").querySelectorAll(".qbuttonscore");
    for (const qscore of qscores) {
        sarray.push(qscore.value)
    }
    //var sarr =  JSON.stringify(sarray);
    var examName = document.getElementById("examName").value;
    alert("request_id=CREATE_EXAM" + "&exam_name=" + examName + "&questions=" + qarray + "&scores=" + sarray);
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("request_id=CREATE_EXAM" + "&exam_name=" + examName + "&questions=" + qarray + "&scores=" + sarray);
}
//Apply Filter
//Arguments: Filters
//Return: JSON of remaining questions
function applyfilter(form) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            alert("FILTER");
            alert(this.responseText);
            var data = JSON.parse(this.responseText);
            return;
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
//Check if a valid exam exists (a teacher created an exam)
function isavailable(){
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            alert("IS_AVAILABLE");
            alert(this.responseText);
            var data = JSON.parse(this.responseText);
            return;
        }
    }
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("request_id=IS_AVAILABLE");
}
//Get the active exams questions
function getactive() {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            alert("GET_ACTIVE_EXAM");
            alert(this.responseText);
            var data = JSON.parse(this.responseText);
            return;
        }
    }
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("request_id=GET_ACTIVE_EXAM");
}
//Submit a students exam to the database
function submitexam(){
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            alert("SUBMIT_EXAM");
            alert(this.responseText);
            var data = JSON.parse(this.responseText);
            return;
        }
    }
    ajax.open("POST", "../php/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("request_id=SUBMIT_EXAM");
}
//Add a question
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
//Button shifting
function movebutton(value, id) {
    var button = document.createElement("input");
    var score = document.createElement("input");
    score.type = "text"
    score.placeholder = "Enter the amount of points this question is worth"
    score.id = id + 'bscore';
    score.className = 'qbuttonscore';
    button.type = "button";
    button.value = value;
    button.id = id + 'bchild';
    button.className = 'qbutton';
    button.onclick = function() {
        removeElement(id + "bchild", id + "bscore")
    };
    document.getElementById('buttoninleft').appendChild(button);
    document.getElementById('buttoninleft').appendChild(score);
}
//Removes an element from the document
function removeElement(bId, sId) {
    var button = document.getElementById(bId);
    var score = document.getElementById(sId);
    button.parentNode.removeChild(button);
    score.parentNode.removeChild(score);
}
//Clear all questions on right side of screen
function clearquestions(){
  var myNode = document.getElementById("buttoninright");
  while (myNode.firstChild) {
      myNode.removeChild(myNode.firstChild);
  }
}








































