<?php

    $user   = 'root';
    $pass   = '';
    $host   = 'localhost';
    $dbName = 'practice';


    $connect      = mysqli_connect($host, $user, $pass, $dbName);
    $connectError = checkConnection();




    function checkConnection()
    {
        if(mysqli_connect_error())
        {
            return "Connection faild :".mysqli_connect_error()."<br/>";
        }

            return '';
    }
?>