<?php
    //FILE VARIABLES
    $assignment = "Project - WS2";
    $cssReset = "styles/normalize.css";
    $css = "styles/edmoilers.css";
    require_once('dbinfo.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Assignment for class.">
    <?php
        echo"<title>WS2 Assignment $assignment</title>";
        echo "<link rel='stylesheet' href='$cssReset'>";
        echo "<link rel='stylesheet' href='$css'>";
    ?>
  </head>

  <div class="site-wrapper">
      <body>
        <header>
            <?php
                echo "<h1>$assignment<h1/>";
            ?>
        </header>
    
        <main>

            <div class="messages">
                <h2>Administering DB From a Form</h2>
                <p>By: Dilraj Pabla</p>
                <a href="form-add.php">Add a Student</a>
                <?php
                    if(isset($_SESSION['errormessages'])){
                        echo "<ul>";
                        foreach($_SESSION['errormessages'] as $error){
                            echo "<li>$error</li>";
                        }
                        echo "</ul>";
                        unset($_SESSION['errormessages']);
                    }

                    unset($_SESSION['id']);
                    unset($_SESSION['firstname']);
                    unset($_SESSION['lastname']);
                ?>
            </div>

            <div class="content">
                <?php
                    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    if(mysqli_connect_errno() != 0){
                        die("<p>Could not connect to DB: ".$mysqli->connect_error."</p>");
                    }

                    // Choose an order to sort the table
                    $sortOrder = "lastname";
                    $choices = array("id", "firstname", "lastname");

                    if(isset($_GET['choice'])){
                        if( in_array($_GET['choice'], $choices) ){
                            $sortOrder = $_GET['choice'];	
                        }else{
                            echo "<p>".$_GET['choice']." is not a valid sort choice! Don't mess with the URL if you want this sort feature to work.</p>";
                        }
                    }
                    $sortOrder = $mysqli->real_escape_string($sortOrder);
                    $query = "SELECT id, firstname, lastname FROM students ORDER BY $sortOrder;";
                    $result = $mysqli->query($query);

                    // Create table from database
                    $fieldnames = $result->fetch_fields();
                    echo "<h3 class='addrecord'>Students:</h3>";
                    echo "<table>";
                    echo "<tr>";
                    foreach($fieldnames as $field){
                        echo "<th><a href='index.php?choice=$field->name'>" .ucfirst($field->name). "</a></th>";
                    }
                    echo "</tr>";
                    while($row = $result->fetch_row()){
                        echo "<tr>";
                        foreach($row as $value){
                            echo "<td>$value</td>";
                        }
                        echo "<td><a href='form-update.php?id=$row[0]&firstname=$row[1]&lastname=$row[2]'>Update</a></td>";
                        echo "<td><a href='form-delete.php?id=$row[0]&firstname=$row[1]&lastname=$row[2]'>Delete</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    $mysqli->close();
                ?>
            </div>
        </main>
        
        <footer>
            <p>&copy;2023 Dilraj Pabla</p>
        </footer>
      </body>
  </div>
</html>