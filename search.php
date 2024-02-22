<?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){ //checks if post was used as the method to accesss php page
        $searchCriteria = htmlspecialchars($_POST['search-bar']);  
    }
   else {
    header('Location: ./Pages/resources.html');
   }

   try {
        require_once "includes/db.inc.php";

        $query = "SELECT firstName, lastName, favColour from Info where favColour = :searchCriteria";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":searchCriteria", $searchCriteria);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;

    } catch (PDOExeption $e) {
        die("Query failed: " . $e->getMessage());        
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search Results</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Libre+Franklin">
        <link rel="stylesheet" href="./Styles/styles.css">
        <link rel="stylesheet" href="./Styles/search_results_styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <h1 id="web-title"> <a href="../index.html">Nicholas' Website</a> </h1>

        <!-- navigation header -->
        <header id="home-header">
            <div id="navbar-container">
                <nav id="nav-bar">
                    <a class="nav-link" href="./Pages/about.html">About</a>
                    <a class="nav-link" href="./Pages/resources.html">Resources</a>
                    <a class="nav-link" href="./Pages/weather.html">Weather</a>
                    <a class="nav-link" href="#">Contact Us</a>
                </nav>
            </div>
        </header>

        <h3 id="results-title">Search Results</h3>

        <div id="results-body">
            <?php
                if(empty($result)){
                    echo "<div>";
                    echo "<p>There were no results</p>";
                    echo "</div>";
                }
                else {
                    echo "<div>";
                    foreach($result as $row){
                        echo "<p class=\"output-data\">" . htmlspecialchars($row["firstName"]) . " " . htmlspecialchars($row["lastName"]) . "</p>";
                    }
                    echo "<p> They like " . htmlspecialchars($row["favColour"]) . " </p>";
                    echo "</div>";
                }
            ?>
        </div>

        <a href="./Pages/resources.html" id="search-link">Search Again</a>
    
        
    </body>
</html> 