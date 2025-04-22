<?php

function create_connection(){
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "jobhub";
    
    return new mysqli($host,$username,$password,$database);

}
