<?php
    // script to delete a record from the database based on selection of radio buttons
    
    require_once('dbinfo.php');
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if( mysqli_connect_errno() != 0 ){
        die("<p>Could not connect to DB: ".$mysqli->connect_error."</p>");
    }
    $id = "";
    $firstname = "";
    $lastname = "";
    $choice = "";
    $errors = array();

    //getting id, firstname, and lastname from session
    session_start();
    if(isset($_SESSION['id']) && isset($_SESSION['firstname']) && isset($_SESSION['lastname'])){
        $id = $_SESSION['id'];
        $firstname = $_SESSION['firstname'];
        $lastname = $_SESSION['lastname'];
    } else {
        $errors[] = "The record could not be deleted.";
    }

    $id = $mysqli->real_escape_string($id);

    //error checking on choice
    if(isset($_POST['confirm'])){
        $choice = trim($_POST['confirm']);
        if($choice === "no"){
            $errors[] = "The record was not deleted.";
        } else {
            $query = "DELETE FROM students WHERE id = '$id';";
            $result = $mysqli->query($query);
            if($result == false){
                $errors[] = "The record could not be deleted.";
            } else {
                $errors[] = "Record Deleted: $id $firstname $lastname";
            }
        }
    } else {
        $errors[] = "The record could not be deleted.";
    }

    $_SESSION['errormessages'] = $errors;
    $mysqli->close();
    header("location: index.php");
    die();
?>