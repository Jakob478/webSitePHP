<?php
    require_once "connectDB.php";

    $name    = $_SESSION['name'];
    $status  = $_SESSION['status'];

    $userData = getUserDataFromDB($connect, $name);

    $date = date("d.m.y");
    $time = date("H.i.s");

    $message = isset($_POST['message'])? $_POST['message']: '';

    $error = checkMessage($message).
             deleteMessage($connect).
             recoverMessage($connect);

    $alert = enterMessage($connect, $userData, $message, $date, $time, $error);


































    function recoverMessage($connect)
    {
        if(!(isset($_POST['recover']) && isset($_POST['id']))) return '';

        $id = $_POST['id'];

        $sql = "UPDATE chatmsg SET status='exist' WHERE id='$id'";
        $result = mysqli_query($connect, $sql);

        if($result)
        {
            return "";
        }

        return mysqli_error($connect);
    }

    function deleteMessage($connect)
    {
        if(!(isset($_POST['delete']) && isset($_POST['id']))) return '';

        $id = $_POST['id'];

        $sql = "UPDATE chatmsg SET status='deleted' WHERE id='$id'";
        $result = mysqli_query($connect, $sql);

        if($result)
        {
            return "";
        }

        return mysqli_error($connect);
    }

    function enterMessage($connect, $userData, $message, $date, $time, $error)
    {
        if(isset($_POST['send']) && !$error)
        {
            $sql = "INSERT INTO chatmsg (username, role, message, data, time, img)
                    VALUES ('{$userData['name']}', '{$userData['role']}',
                            '$message', '$date', '$time', '{$userData['img']}')";
            $result = mysqli_query($connect, $sql);

            if($result)
            {
                return '';
            }

            return mysqli_error($connect)."<br/>";
        }
    }


    function checkMessage($message)
    {
        if($message === '')
        {
            return "Enter message<br/>";
        }

        return '';
    }

    function getUserDataFromDB($connect, $name)
    {

        $sql    = "SELECT * FROM users WHERE name='$name'";
        $result = mysqli_query($connect, $sql);

        if($result)
        {
            $userData = array();

            foreach($result as $num => $line)
            {
                foreach ($line as $colName => $colValue)
                {
                    $userData[$colName] = $colValue;
                }
            }

            return $userData;
        }

        return "Error". mysqli_error($connect);
    }

    function outputMessagesFromDB($connect)
    {
        $sql = "SELECT * FROM chatmsg";
        $result = mysqli_query($connect, $sql);

        if ($result)
        {
            $str    = '';

            foreach ($result as $col => $line)
            {
                $arr = array();

                foreach ($line as $key => $value)
                {
                    $arr[$key] = $value;
                }


                $str .= outputMessage($arr).
                        outputDeletedMessage($arr);
            }
        }

        return $str;
    }

    //-------------------- Support functions for function outputMessagesFromDB()
    //-------------------- Begin

    function outputMessage($arr)
    {
        if(checkMessageExist($arr['status']))
        {
            $str = "<div class=\"container border-bottom shadow-sm userinfo mt-1\">
                        <div class=\"userimg\">
                            <img src=\"../img/" . $arr['img'] . "\" width=\"50px\" height=\"50px\" alt=\"\">
                            <p class=\"chattext\">
                            " . $arr['username'] . "<br/>
                            " . $arr['data'] . "<br/>
                            </p>
                        </div>
                        <div class=\"message\">
                            <p>" . $arr['message'] . "</p>
                        </div>
                        <div></div>
                        " . outputDeleteMsgButton($arr) . " 
                    </div>";

            return $str;
        }

        return '';
    }

    function outputDeleteMsgButton($arr)
    {
        $deleteMsgButton = '';

        if(checkUserRole($_SESSION['status']) || $arr['username'] === $_SESSION['name'])
        {
            $deleteMsgButton = "<form action='' method='post'>
                                    <input type='text' name='id' value='".$arr['id']."' style='display:none;'/>
                                    <input type='submit' class='delMsg' name='delete' value=''/>
                                </form>";
        }

        return $deleteMsgButton;
    }

    function outputDeletedMessage($arr)
    {
        if(!checkMessageExist($arr['status']))
        {
            $recoverMsgButton = '';

            if(checkUserRole($_SESSION['status']) || $arr['username'] === $_SESSION['name'])
            {
                $recoverMsgButton = "<form action='' method='post' class='mr-5'>
                                         <input type='text' name='id' value='".$arr['id']."' style='display:none;'/>
                                         <input type='submit' class='' name='recover' value='recover'/>
                                     </form>";
            }

            $str = "<div class=\"container border-bottom shadow-sm userinfo mt-1\">
                        <p></p>
                        <p></p>
                        <p class='deleteMessage'><i>message was deleted</i></p>
                        ".$recoverMsgButton."
                    </div>";

            return $str;
        }

        return '';
    }

    function checkMessageExist($msgStatus)
    {
        if($msgStatus === 'exist')
        {
            return true;
        }

        return false;
    }

    function checkUserRole($role)
    {
        if($role === 'admin' || $role === 'moderator')
        {
            return true;
        }

        return false;
    }

    //-------------------- end




?>