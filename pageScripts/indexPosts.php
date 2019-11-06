<?php
    require_once "connectDB.php";

    $table     = 'posts';

    $alert     = deletePost($connect, $table).
                 recoverPost($connect, $table);

    $posts     = outputPostsFromTable($connect, $table);































    function recoverPost($connect, $table)
    {

        $button = isset($_POST['recover'])? 1: '';
        $postId = isset($_POST['id'])? $_POST['id']: '';

        if($button && $postId)
        {
            $sql = "UPDATE $table SET status='exist' WHERE num='$postId'";

            $result = mysqli_query($connect, $sql);

            if($result)
            {
                return "<div class='alert alert-success' role='alert'>Recover succsess</div>";
            }

            return "<div class='alert alert-danger' role='alert'>Recover faild".mysqli_error($connect)."</div>";
        }

        return '';
    }

    function deletePost($connect, $table)
    {

        $button = isset($_POST['delete'])? 1: '';
        $postId = isset($_POST['id'])? $_POST['id']: '';

        if($button && $postId)
        {
            $sql = "UPDATE $table SET status='deleted' WHERE num='$postId'";

            $result = mysqli_query($connect, $sql);

            if($result)
            {
                return "<div class='alert alert-success' role='alert'>delete succsess</div>";
            }

            return "<div class='alert alert-danger' role='alert'>Delete faild".mysqli_error($connect)."</div>";
        }

        return '';
    }

    function outputPostsFromTable($connect, $table) {

        $sql = "SELECT * FROM $table";
        $result = mysqli_query($connect, $sql);

        if($result) {
            $str = '';

            foreach ($result as $col => $lineArray) {
                $arr = array();

                foreach($lineArray as $key => $value) {
                    $arr[$key] = $value;
                }


                $str .= outputExistPost($arr).
                        outputDeletedPost($arr);
            }

            return $str;
        }
        else
        {
            return "Error: ".mysqli_error($connect);
        }

    }

    // -------------------- Support functions for function outputPostsFromTable()
    // -------------------- Begin

    function outputExistPost($arr)
    {
        if(checkPostStatus($arr['status']))
        {
            $str = "<div class=\"card mb-4 shadow-sm\">
                                    <div class=\"card-header\">
                                        <div>
                                            <h4 class=\"my-0 font-weight-normal\">" . $arr['header'] . "</h4>
                                            <h6 class=\"my-0 font-weight-normal\"><i>" . $arr['user'] . "</i></h6>
                                        </div>
                                        " . outputDeletePostButton($arr) . "
                                    </div>
                                    <div class=\"card-body\">
                                        <div class=\"img-block\">
                                            <img src=\"img/" . $arr['image'] . "\" alt=\"\">
                                        </div>
                                        <ul class=\"list-unstyled mt-3 mb-4\">
                                            <li>" . $arr['text'] . "</li>
                                        </ul>
                                        <button type=\"button\" 
                                                class=\"btn btn-lg btn-block btn-outline-primary\">" . $arr['button'] . "</button>
                                    </div>
                                </div>";

            return $str;
        }

        return '';
    }

    function outputDeletePostButton($arr)
    {

        if(checkAdmin($_SESSION['status']) || $arr['user'] === $_SESSION['name'])
        {
            $deletePostButton = "<form action='' method='post'>
                                                <input type='text' name='id' value='".$arr['num']."' style='display:none;'/>
                                                <input type='submit' class='delBut' name='delete' value=''/>
                                             </form>";

            return $deletePostButton;
        }

        return '';
    }

    function outputDeletedPost($arr)
    {
        if(!checkPostStatus($arr['status']))
        {
            if(checkAdmin($_SESSION['status']) || $arr['user'] === $_SESSION['name'])
            {
                $recoverPostButton = "<form action='' method='post'>
                                                <input type='text' name='id' value='" . $arr['num'] . "' style='display:none;'/>
                                                <input type='submit' class='recBut' name='recover' value='recover'/>
                                          </form>";


                $str = "<div class=\"card mb-4 shadow-sm\">
                                <h3 class='delPostHeader'>Post was deleted</h3>
                                " . $recoverPostButton . "
                            </div>";

                return $str;
            }

            return '';
        }

        return '';
    }

    function checkPostStatus($status)
    {
        if($status === 'exist')
        {
            return true;
        }

        return false;
    }

    function checkAdmin($status)
    {
        if($status === 'admin' || $status === 'moderator')
        {
            return true;
        }

        return false;
    }
    //--------------------end


    //--------------------old code
    function outputValue($val_1, $val_2, $addValue)
    {
        if($val_1 === $val_2)
        {
            return $addValue;
        }
        else
        {
            return '';
        }
    }

    function addDataInTable($connect, $tableName, $columnNames, $values)
    {

        $sql = "INSERT INTO $tableName($columnNames) VALUES ($values)";
        $result = mysqli_query($connect, $sql);

        if($result)
        {
            return "Add in $tableName values $values was succsessfull";
        }
        else
        {
            return "Error: ".mysqli_error($connect);
        }

    }
?>