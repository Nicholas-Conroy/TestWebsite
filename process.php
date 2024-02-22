<?php
    //if(isset($_POST['submit'])){} 
    // best practice to use other method

    if($_SERVER["REQUEST_METHOD"] == "POST"){ //checks if post was used as the method to accesss php page
        $firstname = htmlspecialchars($_POST['user-fname']);     
        $lastname = htmlspecialchars($_POST['user-lname']);
        $hobby = htmlspecialchars($_POST['user-hobby']);
        $color = htmlspecialchars($_POST['user-color']);

        if(empty($firstname)){ //checks if first name field was left blank, sends user back if this is true
            //NOTE: front-end security ('required' attribute, or JS, are not actually secure as they can be edited in dev tools)
            header(('Location: index.html'));
            exit();
        }

        echo $firstname ." ";
        echo $lastname . " ";
        echo $hobby . " ";
        echo $color . " ";

        echo "<h2 style='color: red'>Wow<h2>";
        echo $_SERVER['PHP_SELF']; 
    }
    else {
        header('Location: index.html'); //sends user back to html page if user accesses php page incorrectly; security measure
        // header('HTTP/1.1 404 Not Found');
    }


//other superglobals: $_COOKIE[""], $_SESSION[""], $_FILES[""], $_REQUEST[""], $_ENV[""]

// ? > not necessary for files with only php    
?> 

