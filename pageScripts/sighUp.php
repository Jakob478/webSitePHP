<?php
    require_once "connectDB.php";

    $name  = isset($_POST['name'])? $_POST['name']: '';
    $pass  = isset($_POST['pass'])? $_POST['pass']: '';


    $errorMessage .= $refreshError.
                     $connectError.
                     checkValueInDB('name', $name,  $connect).
                     checkValueInDB('password', $pass, $connect).
                     checkStatus($errorMessage, $connect, $name);































    function loginUser($error, $connect)
    {
        $button       = isset($_POST['login']) ? $_POST['login'] : '';
        $refreshError = isset($_SESSION['error'])? $_SESSION['error']: '';


        if($refreshError)
        {
            unset($_SESSION['error']);
            return "<div class='alert alert-warning'>$refreshError<br/></div>";
        }

        if($error && $button)
        {
            return "<div class='alert alert-danger'>$error</div>";
        }
        else if ($button)
        {
            $_SESSION['status'] = searchUserRole($connect, $_POST['name']);
            $_SESSION['name']   = $_POST['name'];
            die( "<meta http-equiv='refresh' content='0;URL=../index.php'>");
        }

        return '';
    }

    function checkStatus($error,$connect,  $name)
    {
        if($error) return '';

        $sql    = "SELECT status FROM users WHERE name='$name'";
        $result = mysqli_query($connect, $sql);

        if($result)
        {
            $errorMsg = '';
            $status = '';

            foreach ($result as $col => $line)
            {
                foreach ($line as $key => $value)
                {
                    $status = $value;
                }
            }

            if($status === 'delete')
            {
                $errorMsg = 'Your account was deleted';
                return $errorMsg;
            }

            return $errorMsg;
        }

        return "Error". mysqli_error($connect)."<br/>";;
    }

    function searchUserRole($connect, $userName)
    {
        $sql = "SELECT role FROM users WHERE name='$userName'";
        $result = mysqli_query($connect, $sql);

        if($result)
        {
            $status = '';

            foreach($result as $key => $value)
            {
                foreach($value as $k =>$v)
                {
                    $status = $v;
                }
            }

            return $status;
        }

        return "Error". mysqli_error($connect)."<br/>";
    }

    function checkValueInDB($columnName, $searchVal, $connect)
    {
        $sqlRequest  = "SELECT $columnName FROM users";
        $queryResult = mysqli_query($connect, $sqlRequest);

        if($queryResult)
        {
            foreach ($queryResult as $key => $value)
            {
                foreach ($value as $k => $val)
                {
                    if($val === $searchVal) return '';
                }
            }

            return "Wrong $columnName<br/>";
        }

        return "Error".mysqli_error($connect)."<br/>";
    }


?>