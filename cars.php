<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>My Account</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style/general.css">
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <script type="text/javascript"  src='script/general/general.js'></script>
        <script type="text/javascript"  src='script/pages/login.js'></script>
        <script type="text/javascript"  src='script/pages/cars.js'></script>
    </head>
    <body onload="init();">
        <div class="container">

            <div class="account">
                <div class="welcome">

                    <a  onclick="logout()">Logout</a>  
                    <a href="" id="username">baked potato</a>       <!--POPULATE USERNAME-->
                    <img id="user_loading" class="user_loading_hidden" src="images/loading.gif">
                </div>

                <img src="images/car.png">
                <p>Rent a Car</p>

            </div>
            <div  class="tabs" id="tabs">
                <div onclick="show_tab(this)" class="tab_pressed"> Find Car
                    <div class="tab_detail"> 
                        
                        <div class="search_bar">
                            <input id="search_field" class="search_field" onkeydown="maybefindcar(event);" type="text"><div onclick="find_car();" class="search_button"><img src="images/glass.png"></div>
                        </div>
                        <select id='sortby' class='sort sort_by_button' onchange='find_car();'> 
                          <option value="none">Sort By</option>
                          <option class='sort_option' value="Color">Color</option>
                          <option class='sort_option' value="Model">Model</option>
                          <option class='sort_option' value="Make">Make</option>
                          <option class='sort_option' value="Year">Year</option>
                          <option class='sort_option' value="Size">Size</option>
                        </select>
                        <img id="find_car_loading" class="loading_hidden" src="images/loading.gif">
                        <div id="search_results">               <!--POPULATE CAR SEARCH-->
                        </div>
                    </div>
                </div>

                <div onclick="show_tab(this)" class="tab"> Rented Cars

                    <div class="tab_detail_hidden"> 
                        <img id="rented_car_loading" class="loading_hidden" src="images/loading.gif">
                        <div id="rented_cars">
                                                    <!--POPULATE RENTED CARS-->
                        </div>
                    </div>
                </div>
                <div onclick="show_tab(this)" class="tab"> Rental History

                    <div class="tab_detail_hidden"> 
                        <img id="returned_car_loading" class="loading_hidden" src="images/loading.gif">
                        <div id="returned_cars"></div>
                                                    <!--POPULATE RETURNED CARS-->
                    </div>
                </div>
            </div>
        </div>
        <div id="background" class="msg_box_background">
        </div>
            <div id="message_box" class="message_box">
                <img onclick="close_message()" src="images/close_icon.png">
                <div class="message" id="message"></div>
                <img id="message_loading" class="loading_hidden" src="images/loading.gif">
                <div onclick="close_message()" class="close_button">Ok</div>
            </div>
        

    </body>
</html>

