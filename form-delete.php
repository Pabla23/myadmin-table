<?php
    //FILE VARIABLES
    $assignment = "Project - WS2";
    $cssReset = "styles/normalize.css";
    $css = "styles/edmoilers.css";
    require_once('dbinfo.php');
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
                <h2>Delete a Student</h2>
            </div>

            <div class="content">
                <h3 class="addrecord">Delete a Record - Are you sure?</h3>
                <?php
                    if(isset($_GET['id']) && isset($_GET['firstname']) && isset($_GET['lastname'])){
                        $id = trim($_GET['id']);
                        $firstname = trim($_GET['firstname']);
                        $lastname = trim($_GET['lastname']);
                    }
                    echo "<p>$id $firstname $lastname</p>";
                    session_start();
                    $_SESSION['id'] = $id;
                    $_SESSION['firstname'] = $firstname;
                    $_SESSION['lastname'] = $lastname;
                ?>
                <form action="formprocessing-delete.php" method="POST">
                    <label><input class="radio" type="radio" name="confirm" value="yes" checked>Yes</label>
                    <label><input class="radio" type="radio" name="confirm" value="no">No</label>
                    <br>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </main>
        
        <footer>
            <p>&copy;2023 Dilraj Pabla</p>
        </footer>
      </body>
  </div>
</html>