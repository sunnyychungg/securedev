<?php
$dBServername= "localhost";
$dBUsername= "root";
$dBPassword = "";
$dBName= "test";

//create connection
$conn= mysqli_connect($dBServername,$dBUsername,$dBPassword,$dBName);

// check connection 
if(!$conn) 
{
    die("Connection failed ". mysqli_connect_error());


}