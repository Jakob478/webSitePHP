<?php session_start();?>

<?php
    out();
    function outputHead($title) { ?>

        <!doctype html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">

            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
                  crossorigin="anonymous">
            <link rel="stylesheet" href="../css/style.css">
            <title><?php echo $title?></title>
        </head>
        <body>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <h5 class="my-0 mr-md-auto font-weight-normal">webSitePHP</h5>

            <?php echo outputButtonsAndLinks();?>

        </div>

<?php } ?>

<?php
    function outputButtonsAndLinks()
    {
        $str = "";

        if(checkUserLogin())
        {
            $str = "<nav class='my-2 my-md-0 mr-md-3'>
                        <a class='p-2 text-dark' href='../index.php'>Home</a>
                        <a class='p-2 text-dark' href='../pages/chat.php'>Chat</a>
                    </nav>
                    
                    <form action='' method='post'>
                        <a class='username mr-3' href='/pages/userPage.php'>
                             ".$_SESSION['status'].": ".$_SESSION['name']."
                        </a>
                
                        <input type='submit' name='out' value='out' class='btn btn-outline-primary'>
                    </form>";
        }
        else
        {
            $str = "<a class='btn btn-outline-primary' href='../pages/signup.php'>Login</a>";
        }

        return $str;
    }

    function out()
    {
        if($_POST['out'] === 'out')
        {
            unset($_SESSION['name']);
        }
    }

    function refreshUnloginUser($path)
    {
        if(!checkUserLogin())
        {
            $_SESSION['error'] = 'Please login';
            echo "<meta http-equiv='refresh' content='0;URL=$path'>";
            exit;
        }
    }

    function checkUserLogin()
    {
        if (isset($_SESSION['name']) && $_SESSION['name'] !== '')
        {
            return true;
        }
        else
        {
            return false;
        }
    }
?>