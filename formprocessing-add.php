<?php
    require_once('dbinfo.php');
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if( mysqli_connect_errno() != 0 ){
        die("<p>Could not connect to DB: ".$mysqli->connect_error."</p>");
    }

    $id = "";
    $firstname = "";
    $lastname = "";
    $errors = array();
    $studentNumberPattern = "/^A0[0-9]{7}$/i";
    session_start();

    //error checking on id
    if(isset($_POST['id'])){
        $id = trim($_POST['id']);
        $id = $mysqli->real_escape_string($id);
        if(empty($id)){
            $errors[] = "The record could not be added.";
        } else {
            if(preg_match($studentNumberPattern, $id) == 0){
                $errors[] = "The record could not be added.";
            } else {
                //error checking on firstname
                if(isset($_POST['firstname'])){
                    $firstname = trim($_POST['firstname']);
                    $firstname = $mysqli->real_escape_string($firstname);
                    if(empty($firstname)){
                        $errors[] = "The record could not be added.";
                    } else {
                        //error checking on lastname
                        if(isset($_POST['lastname'])){
                            $lastname = trim($_POST['lastname']);
                            $lastname = $mysqli->real_escape_string($lastname);
                            if(empty($lastname)){
                                $errors[] = "The record could not be added.";
                            } else {
                                $query = "INSERT INTO students (id, firstname, lastname) VALUES ('$id', '$firstname', '$lastname');";
                                $result = $mysqli->query($query);
                                if($result == false){
                                    $errors[] = "The record could not be added.";
                                } else {
                                    $errors[] = "Record Added: $id $firstname $lastname";
                                }
                            }
                        } else {
                            $errors[] = "The record could not be added.";
                        }
                    }
                } else {
                    $errors[] = "The record could not be added.";
                }
            }
        }
    } else {
        $errors[] = "The record could not be added.";
    }

    $_SESSION['errormessages'] = $errors;
    $mysqli->close();
    header("location: index.php");
    die();
?>