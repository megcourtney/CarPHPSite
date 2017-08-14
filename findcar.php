<?php

$con = mysqli_connect('localhost','root','root', 'mysql');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
$input = $_POST['userInput'];   //initializes variables
$sortBy = $_POST['sortBy'];

// get all the search terms separately
$searchterms = explode(' ', $input);

$sql= "SELECT car.status, car.Color, carspecs.Make, carspecs.Model, carspecs.Year, carspecs.Size, car.ID, car.picture, car.picture_type FROM
        car JOIN carspecs 
        ON car.CarSpecsID = carspecs.ID
        WHERE ((";  //beginning of SQL statement

foreach ($searchterms as $term) {//for each search term in the input
          $sql.="car.Color = '".$term."' OR
            carspecs.Make = '".$term."' OR
            carspecs.Model = '".$term."' OR
            carspecs.Year = '".$term."' OR carspecs.Size = '".$term."' OR "; //concatenate this to the sql statement
}
if ($sortBy == "none") {    //default sorts by year
    $sql .= "carspecs.Size = '0') AND car.status = 1) ORDER BY carspecs.Year";
}
else if ($sortBy == "Color") {  //sorts by color
    $sql .= "carspecs.Size = '0') AND car.status = 1) ORDER BY car.".$sortBy;
}
else {  //sorts by whatever sortby is
    $sql .= "carspecs.Size = '0') AND car.status = 1) ORDER BY carspecs.".$sortBy;
}

$result = mysqli_query($con,$sql);  //executes sql
$row_count = mysqli_num_rows($result);  //counts the rows in the result

$html = "";

for ($j = 0; $j < $row_count; ++$j) {   //for every row
    $row = mysqli_fetch_array($result); //fetch the next row
    $html.="<div class='search_item'>";
    $html.= '<img src="data:' . $row["picture_type"] . ';base64,' . base64_encode($row["picture"]) . '">';
    $html.="<div class='car_make_background'>";   
    $html.=     "<div class='car_make'>" . $row['Make'] .  "</div>";
    $html.=     "<div class='car_model'>" . $row['Model'] . " | ". $row['Year']. "</div>";
    $html.="</div>";
    $html.="<div class='car_size'>Size: " . $row['Size'] . "</div>";
    $html.=     "<div class='car_color'>Color "
                    ."<div class='" . $row['Color'] . "'></div>"
                ."</div>";
    $html.="<div id = '".$row['ID']."' onclick = 'rent_car(this.id);' class='car_rent'>Rent Car</div>";    
    $html.="</div>";    //adds the appropriate html for the car
}


echo($html);    //returns html to the ajax
mysqli_close($con);