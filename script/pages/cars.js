function init(){        //calls functions to populate the rented cars and history tabs, as well as the user's name
    make_search_field("search_field", "Type car make, model, year, color, etc.");
    get_rented_cars();
    get_rental_history();
    populateName();
}

function find_car(){    //finds the cars based on user input
    var ajax = ajaxObject();
    var data = new FormData();
    data.append("userInput", $("search_field").value);  //adds the search field input to the formdata object
    data.append("sortBy", $("sortby").value);       //adds the sort by input to the formdata object
    var success = function(text) {
        $("search_results").innerHTML = text;   //sets the search results to the html "text"
    };
    
    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4 && ajax.status === 200) {
            success(ajax.responseText); //sets the search results to response from PHP
        }       
    };   
    ajax.open("POST", "findcar.php");   //calls the findcar php file
    ajax.send(data);    //sends that file the data
}

function rent_car(id) { //rents a car, takes the id of the car as input
    var ajax = ajaxObject();
    var data = new FormData();
    data.append("carID", id);   //adds carID to the formdata object
    
    ajax.onreadystatechange = function() {
//        alert("readystatechange");
        if (ajax.readyState === 4 && ajax.status === 200) {
            show_message("Car has been rented successfully.");  //shows the message
            find_car(); //updates search results
            get_rented_cars();  //updates rented cars
        }       
    };   
    ajax.open("POST", "rentCar.php");   //calls rencar php file
    ajax.send(data);    //sends that file the data
}

function return_car(id) {   //returns a car, takes the id of the car as input
    var ajax = ajaxObject();
    var data = new FormData();
    data.append("carID", id);
    
    ajax.onreadystatechange = function() {
//        alert("readystatechange");
        if (ajax.readyState === 4 && ajax.status === 200) {
            //alert("hi butts"); 
            show_message("Car has been returned successfully.");
            get_rented_cars();  //updates the tabs
            get_rental_history();
            find_car();
        }       
    };   
    ajax.open("POST", "returnCar.php");
    ajax.send(data);
}

function get_rented_cars() {    //populates rented cars tab
    var ajax = ajaxObject();

    var success = function(text) {
        $("rented_cars").innerHTML = text;
    };
    
    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4 && ajax.status === 200) {
            success(ajax.responseText); //sets rented cars html to the php response
        }       
    };   
    ajax.open("POST", "getRentals.php");
    ajax.send();
}

function get_rental_history() { //populates rental history tab
    var ajax = ajaxObject();
    
    var success = function(text) {
        $("returned_cars").innerHTML = text;
    };
    
    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4 && ajax.status === 200) {
            success(ajax.responseText); //sets returned cars html to the php response
        }       
    };   
    ajax.open("POST", "getHistory.php");
    ajax.send();
}

function logout(){  //logs the user out
    var ajax = ajaxObject();
    
    ajax.onreadystatechange = function() {
        //alert("readystatechange");
        if (ajax.readyState === 4 && ajax.status === 200) { 
            window.location.assign("index.php");    //sends user back to login screen
        }       
    };   
    ajax.open("POST", "logout.php");    //calls logout php file
    ajax.send();
}

function close_message(){
    $("background").style.display = "none";
    $("message_box").style.display = "none";
    $("message").innerHTML = "";
}

function show_message(text){
    $("background").style.display = "block";
    $("message_box").style.display = "block";
    $("message").innerHTML = text;
}

function populateName(){    //populates name in upper right corner
    var ajax = ajaxObject();
    
    ajax.onreadystatechange = function() {

        if (ajax.readyState === 4 && ajax.status === 200) {
            var data = ajax.responseText;
            $('username').innerHTML = data; //sets user name inner text to the php response
        
        }
    };
    ajax.open("POST", "getName.php");   //calls the getname php function
    ajax.send();
}