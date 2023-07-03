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
                <h2>Add a Student</h2>
            </div>

            <div class="content">
                <h3 class="addrecord">Add a Record:</h3>
                <form action="formprocessing-add.php" method="POST">
                    <label for="id">Student ID:</label>
                    <input type="text" name="id" id="id">
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" id="firstname">
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" id="lastname">
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