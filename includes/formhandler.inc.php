<!-- ADD: validation for age (>= 0) -->

<?php
    //mysqlconnect is obsolete, mysqli is fine, pdo is general db purpose (not just mysql)

    //if(isset($_POST['submit'])){} 
    // best practice to use other method


    //*** Check form submitted correctly and get data */
    if($_SERVER["REQUEST_METHOD"] == "POST"){ //checks if post was used as the method to accesss php page
        $firstname = htmlspecialchars($_POST['user-fname']);     
        $lastname = htmlspecialchars($_POST['user-lname']);
        $age = htmlspecialchars($_POST['user-age']);
        $color = htmlspecialchars($_POST['user-color']);

        if(empty($firstname)){ //checks if first name field was left blank, sends user back if this is true
            //NOTE: front-end security ('required' attribute, or JS, are not actually secure as they can be edited in dev tools)
            header(('Location: ../index.html'));
            exit();
        }
    }
    else {
        header('Location: ../index.html'); //sends user back to html page if user accesses php page incorrectly; security measure
        // header('HTTP/1.1 404 Not Found');
    }

    try {
        require_once "db.inc.php";

         //*** Query (insert) 
         //don't put data directly in query, can allow users to destroy db with sql
        $query = "INSERT INTO info VALUES (:fname, :lname, :age, :color)";

        //prepared statement, accepts valid query
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":fname", $firstname);
        $stmt->bindParam(":lname", $lastname);
        $stmt->bindParam(":age", $age);
        $stmt->bindParam(":color", $color);

        $stmt->execute();

        //close connection and prepared statement, happens automatically but good practice to free up space in bigger program
        $pdo = null;
        $stmt = null;

        header("Location: ../index.html");

        die();
    } catch (PDOExeption $e) {
        die($e->getMessage());
    }

   
    