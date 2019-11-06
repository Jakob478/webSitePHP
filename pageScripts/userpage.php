<?php
    require_once "connectDB.php";

    $name    = $_SESSION['name'];
    $status  = $_SESSION['status'];

    $saveDir        = 'W:/domains/webSitePHP/img/';
    $fileExtensions = ['jpeg', 'png', 'jpg', 'svg'];

    $formData = getFormData();
    $userData = getUserDataFromDB($connect, $name);

    $errors = '';

    $errors = checkName($formData['name']).
              checkCoincidence($connect, $formData['name']).
              checkOldPass($formData['pass'], $userData['password']).
              checkNewPass($formData['pass1'], $formData['pass2']).
              checkFileType($fileExtensions).
              saveImageInDir($saveDir, $errors);

    $alert  = updateUserData($connect, $name, $formData, $errors).
              setUserStatus($connect);


    $usersAlert = deleteOrRecoverUser($connect, $_POST['id']);

    $users      = outputUsersFromDB($connect, $userData['role'], $usersAlert);






















    function setUserStatus($connect)
    {
        if(isset($_POST['id']) && isset($_POST['role']))
        {
            $id     = $_POST['id'];
            $role = $_POST['role'];

            $sql    = "UPDATE users SET role='$role' WHERE user_id='$id'";
            $result = mysqli_query($connect, $sql);

            if ($result) return '';

            return "<div class='alert alert-danger' role='alert'>Add faild:". mysqli_error($connect). "</div>";
        }


        return '';
    }

    function deleteOrRecoverUser($connect, $id)
    {
        if(isset($_POST['delete']) && $id !== '')
        {
            $sqlSelect    = "SELECT status FROM users  WHERE user_id='$id'";
            $resultSelect = mysqli_query($connect, $sqlSelect);

            if($resultSelect)
            {
                $status = '';

                foreach ($resultSelect as $col => $line)
                {
                    foreach ($line as $key => $value)
                    {
                        $status = $value;
                    }
                }

                $status = ($status === 'delete')? 'recover': 'delete';

                $sqlUpdate = "UPDATE users SET status='$status' WHERE user_id='$id'";
                $resultUpdate = mysqli_query($connect, $sqlUpdate);

                if($resultUpdate)
                {
                    $message = "<div class='alert alert-success' role='alert'>$status success</div>";
                }
                else
                {
                    $message = "<div class='alert alert-danger' role='alert'>Faild ".mysqli_error($connect)."</div>";
                }

                return $message;
            }

            return "<div class='alert alert-danger' role='alert'>Faild".mysqli_error($connect)."</div>";
        }

        return '';
    }


    function outputUsersFromDB($connect, $role, $alert)
    {
        if($role !== 'moderator' && $role !== 'admin') return '';

        $sql = "SELECT user_id,name,role,img,status FROM users";
        $result = mysqli_query($connect, $sql);

        if ($result)
        {
            $str  = '';

            $div1 = "<div class=\"container border-bottom shadow-sm users pb-5 pt-1\">
                        <h3 class=\"my-0 mr-md-auto font-weight-normal mb-5 ml-3\">Users</h3>";
            $div2 = "</div>";

            foreach ($result as $col => $line)
            {
                $arr = array();

                foreach ($line as $key => $value)
                {
                    $arr[$key] = $value;
                }


                $str .= outputUserInfo($arr);
            }
        }

        if($str === '') return $str;

        return $div1.$alert.$str.$div2;
    }

    // -------------------- Support functions for function outputUsersFromDB()
    // -------------------- Begin

    function outputUserInfo($arr)
    {
        $str = "<div class=\"container border-bottom shadow-sm userinfo mt-1\">
                    <img src=\"../img/" . $arr['img'] . "\" width=\"50px\" heigth=\"50px\">
                    <div>
                        <p>
                        Name:   " . $arr['name']   . "<br/>
                        Role:   " . $arr['role']   . "<br/>
                        Status: " . $arr['status'] . "
                        </p>
                    </div>
                    ".outputCheckRoleForm($arr['user_id'])."
                    ".outputStatusControlButton($arr)."
                </div>";


        return $str;
    }

    function outputCheckRoleForm($user_id)
    {
        if(!isThisAdmin($_SESSION['status'])) return "<div class='checkstatus'></div>";

        $checkRoleForm = "<div class='checkstatus'>
                            <form action='' method='post'>
                                <select name='role' size='1'>
                                    <option>user</option>
                                    <option>moderator</option>
                                </select>
                                <input type=\"text\" name=\"id\" value=\"" . $user_id . "\"
                                       style='display:none;'>
                                <input type=\"submit\" name=\"set\" value=\"Set\"
                                       class=\"\">
                            </form>
                        </div>";

        return $checkRoleForm;
    }

    function outputStatusControlButton($array)
    {
        if(!isThisAdmin($_SESSION['status'])) return "<div class='butControl'></div>";

        $buttonClass = '';
        $buttonText  = '';

        if(checkUserStatus($array['status']))
        {
            $buttonClass = "btn-danger";
            $buttonText  = "delete";
        }
        else
        {
            $buttonClass = "btn-success";
            $buttonText  = "recover";
        }


        $butControl = "<div class=\"butControl\">
                           <form action=\"\" method=\"post\">
                               <input type=\"text\" name=\"id\" value=\"" . $array['user_id'] . "\"
                                      style='display:none;'>
                               <input type=\"submit\" name=\"delete\" value=\"" . $buttonText . "\"
                                      class=\"btn " . $buttonClass . " mt-3\">
                           </form>
                       </div>";

        return $butControl;
    }

    function checkUserStatus($status)
    {
        if($status === 'delete')
        {
            return false;
        }

        return true;
    }

    function isThisAdmin($role)
    {
        if($role === 'admin')
        {
            return true;
        }

        return false;
    }

    // -------------------- End



    function updateUserData($connect, $name, $formData, $errors)
    {
            if(!$errors && $formData['update'] !== '')
            {
                $sql = "UPDATE users SET name='$formData[name]',     email='$formData[email]',
                                         password='$formData[pass]', img='{$_FILES['image']['name']}'
                                         WHERE name='$name'";

                $result = mysqli_query($connect, $sql);

                if ($result) return "<div class='alert alert-success' role='alert'>Update successfull</div>";

                return "<div class='alert alert-danger' role='alert'>Update faild:".mysqli_error($connect)."</div>";
            }
            else if (isset($formData['update']))
            {
                return "<div class='alert alert-danger' role='alert'>$errors</div>";
            }

            return '';
    }

    // -------------------- Support functions for function updateUserData()
    // -------------------- Begin
    function checkOldPass($pass, $oldPass)
    {

        if($pass !== '')
        {
            if($pass === $oldPass) return '';

            return "Wrong old password<br/>
                    $pass : $oldPass<br/>";
        }

        return "Enter old password<br/>";
    }

    function checkNewPass($pass1, $pass2)
    {

        if($pass1 !== '')
        {
            if($pass2 !== '')
            {
                if(strlen($pass1) < 8) return "password is too small<br/>";
                if($pass1 === $pass2)  return '';

                return "Password are not equel<br/>";
            }

            return "Repeat password<br/>";
        }

        return "Enter new password<br/>";
    }

    function checkCoincidence($connect, $name)
    {
        $sql = "SELECT name FROM users";
        $result = mysqli_query($connect, $sql);

        if($result)
        {
            foreach ($result as $col => $line)
            {
                foreach($line as $key => $value)
                {
                    if($name === $value) return "Name is busy<br/>";
                }
            }

            return '';
        }

        return 'Select name error'. mysqli_error($connect)."<br/>";
    }

    function checkEmail($email)
    {
        if($email !== '')
        {
                return '';
        }

        return "Enter email<br/>";
    }

    function checkName($name)
    {
        if($name !== '')
        {
            //if(strlen($name) > 3)
            //{
                //return '';
            //}
            return '';
            //return "Name length too small<br/>";
        }

        return "Enter name<br/>";
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
    function getFormData()
    {
        $formData = array();

        foreach($_POST as $name=>$value)  $formData[$name] = $value;

        return $formData;
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

?>