<?php

session_start();    //gets the session



// remove all session variables
session_unset();    //unsets all the session vars

// destroy the session 
session_destroy();  //destroys the session
