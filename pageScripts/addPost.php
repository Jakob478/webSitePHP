<?php
    require_once "connectDB.php";

    $table     = 'posts';
    $column    = 'header, image, text, button, user';


    $header = isset($_POST['header'])? $_POST['header']: '';
    $image  = isset($_FILES['image'])? $_FILES['image']: '';
    $text   = isset($_POST['text'])? $_POST['text']: '';
    $button = isset($_POST['button'])? $_POST['button']: '';


    $addValuesInDB  = "'$header', '{$_FILES[image][name]}', '$text', '$button', '$_SESSION[name]'";

    $saveDir        = 'W:/domains/webSitePHP/img/';
    $fileExtensions = ['jpeg', 'png', 'jpg', 'svg'];


    $errorMessage  = '';

    $errorMessage .= validateText($header, 20).
                     validateText($text, 255).
                     validateText($button, 20).
                     checkImgSize(2097152).
                     checkFileType($fileExtensions).
                     saveImageInDir($saveDir, $errorMessage);


    $alert = addPost($connect, $errorMessage, $table, $column, $addValuesInDB);














    function addPost($connect, $error, $tableName, $columns, $values)
    {
        if(!$error && isset($_POST['button']))
        {
            $sqlRequest = "INSERT INTO $tableName ($columns) VALUES ($values)";
            $result = mysqli_query($connect, $sqlRequest);

            if($result)
            {
                return "<div class='alert alert-success' role='alert'>Post added</div>";
            }

            return "<div class='alert alert-danger' role='alert'>Add faild:". mysqli_error($connect). "</div>";
        }
        else if(isset($_POST['button']))
        {
            return "<div class='alert alert-danger' role='alert'>$error</div>";
        }

        return '';
    }

    function saveImageInDir($saveDir, $error)
    {
        if(!$error)
        {
            $saveResult = move_uploaded_file($_FILES['image']['tmp_name'], $saveDir.$_FILES['image']['name']);

            if($saveResult) return '';

            return "Save image faild<br/>";
        }

        return '';
    }
    function checkFileType($fileTypes)
    {

        for($i = 0; $i < count($fileTypes); $i++)
        {
            if($_FILES['image']['type'] === "image/".$fileTypes[$i]) return '';
        }

        return "file must be image<br/>";
    }

    function checkImgSize($imageSize)
    {
        if(/*isset($_POST['add']) && */isset($_FILES['image']))
        {
            if($_FILES['image']['size'] > $imageSize)
            {
                return "file size too big<br/>";
            }

            return '';
        }

        return "Choose image<br/>";
    }

    function validateText($text, $textLength)
    {
        if(strlen($text) > $textLength)
        {
            return "header mus be smaller than $textLength symbols<br/>";
        }

        return '';
    }

?>