<?php
        require_once "connectDB.php";

        $userName = isset($_POST['username'])? $_POST['username']: '';
        $pass1    = isset($_POST['pass1'])? $_POST['pass1']: '';
        $pass2    = isset($_POST['pass2'])? $_POST['pass2']: '';
        $regist   = isset($_POST['regist'])? $_POST['regist']: '';

        $errorMessage = "";

        $errorMessage .= $connectError.
                         checkValueOnEnter($userName,'username').
                         checkValueOnEnter($pass1,'password1').
                         checkValueOnEnter($pass2,'password2').
                         validatePassword($pass1, $pass2).
                         checkUserForExistance($userName, $connect);


        $alert = saveUserInDataBase($errorMessage, $userName, $pass1, $connect, $regist);


























        function validatePassword($pass_1, $pass_2)
        {
            if($pass_1 !== $pass_2)
            {
                return "passwords are not equal<br/>";
            }
            else if (strlen($pass_1) < 8)
            {
                return 'password length must be more than 8 symbols';
            }

            return '';
        }

        function saveUserInDataBase($error, $name, $password, $connection, $button)
        {
            if($error !== '' && $button !== '')
            {
                return "<div class='alert alert-danger' role='alert'>$error</div>";
            }
            else if ($button !== '')
            {
                $query  = "INSERT INTO users (name, email, password) VALUES ('$name','' ,'$password')";
                $queryResult = mysqli_query($connection, $query);

                if($queryResult)
                {
                    return "<div class='alert alert-success' role='alert'>register succsess</div>";
                }

                return "<div class='alert alert-danger' role='alert'>$error</div>".mysqli_error($connection);
            }

            return '';
        }

        function checkUserForExistance($name, $connect)
        {

            $sqlRequest  = "SELECT name FROM users";
            $queryResult = mysqli_query($connect, $sqlRequest);
            $message     = "This name is busy";

            if($queryResult)
            {

                foreach($queryResult as $key => $value)
                {
                    foreach($value as $k => $val)
                    {
                        if($val === $name) return $message;
                    }
                }
            }

            return '';
        }

        function checkValueOnEnter($value, $valueName)
        {
            if($value === '')
            {
                return "please enter $valueName <br/>";
            }

            return '';
        }

?>