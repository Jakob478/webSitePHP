<form action="" method="post">
    <input type="text" name="username" placeholder="username">    <br>
    <input type="text" name="email" placeholder="email">          <br>
    <input type="file" name="image" placeholder="userimage">      <br>
    <input type="text" name="pass" placeholder="Old password">    <br>
    <input type="text" name="pass1" placeholder="New password">   <br>
    <input type="text" name="pass2" placeholder="Repeat password"><br>
    <input type="submit" name="update" value="Update data">       <br>
</form>
<?php
    require_once "connectDB.php";
        $error = '';
        $formData = getFormData();

        if(isset($formData['update'])) {
            foreach ($formData as $key => $value) {
                echo "$key => $value<br/>";
            }
        } else {
            echo "<p style='color:red;'>press update</p>";
        }
        $error = 'fdgfds';
        echo $error;
















function getFormData() {
    static $error = 'error';
    $formData = array();

    foreach($_POST as $name=>$value)  $formData[$name] = $value;

    return $formData;
}


/*
    # $name = $_SESSION['name'];

    $userData = getUserData($connect, 'Admin');

    if($userData) {
        foreach ($userData as $key => $value) {
            echo "$key => $value<br/>";
        }
    } else {
        echo 'error';
    }
    function getUserData($connect, $name) {

        $sql    = "SELECT name,email,role FROM users WHERE name='$name'";
        $result = mysqli_query($connect, $sql);

        if($result) {
            $userData = array();

            foreach($result as $num => $line) {
                foreach ($line as $colName => $colValue) {
                    $userData[$colName] = $colValue;
                }
            }

            return $userData;
        }

        return false;
    }
*/

/*
    echo searchUserStatus($connect, 'user1');

    function searchUserStatus($connect, $userName) {
        $sql = "SELECT role FROM users WHERE name='$userName'";
        $result = mysqli_query($connect, $sql);

        if($result) {
            $status = '';

            foreach($result as $key => $value) {
                foreach($value as $k =>$v) {
                    //echo $k;
                    $status = $v;
                }
            }

            return $status;
        }

        return "Error". mysqli_error($connect)."<br/>";
    }
*/
/*
    $string = "admin0=>root;admin1=>root1;admin2=>root2;admin3=>root3;";

    function checkUserForExistance($wayToFile, $searchName) {
        $file     = fopen($wayToFile, "r");
        if(filesize($wayToFile) > 0) {
            $fileText = fread($file, filesize($wayToFile));
        } else {
            $fileText = '';
        }

        $searchSym1 = '=>';
        $searchSym2 = ';';
        $strSlice   = '';
        $strLength  = 0;

        $searchPos1 = 0;
        $searchPos2 = 0;


        while($searchPos1 < strlen($fileText)) {
            $searchPos2 = strpos($fileText, $searchSym1, $searchPos1);
            $strLength  = $searchPos2 - $searchPos1;
            $strSlice   = substr($fileText, $searchPos1, $strLength);

            if(trim($strSlice) !== '' && trim($strSlice) === trim($searchName)) {
                return "$searchName is taken<br/>";
            }

            $searchPos1 = strpos($fileText, $searchSym2, $searchPos2) + 1;
        }

        fclose($file);
        return "";
    }*/

    //echo checkUserForExistance('../users/users.txt', 'admin5');
?>