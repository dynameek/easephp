<?php
    $host = 'localhost';
    $user = '';
    $pass = '';
    
    $handle = mysqli_connect($host, $user, $pass);
    if($handle)
    {
        $sql = "CREATE DATABASE IF NOT EXISTS test_db";
        mysqli_select_db($handle,'test_db');
        if(mysqli_query($handle, $sql))
        {            
            $sql = "CREATE TABLE IF NOT EXISTS users(
                id VARCHAR(35) NOT NULL UNIQUE,
                name VARCHAR(50) NOT NULL,
                email VARCHAR(100) NOT NULL UNIQUE,
                PRIMARY KEY(id)
            )";
            if(mysqli_query($handle, $sql))
            {
               echo "DONE.";
            }else echo "Could not created user table<br>".mysqli_error($handle);
        }else echo "could not create db";
        
        mysqli_close($handle);
    }else
    {
        echo "Could not connect";
    }
?>