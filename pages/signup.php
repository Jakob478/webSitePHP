<?php require_once "../pageElements/head.php";
      require_once "../pageScripts/sighUp.php";
      $alert = loginUser($errorMessage, $connect);
      outputHead("sign up");
?>

    <div class="container form">
        <h3 class="mb-3">Login</h3>
        <?php echo $alert;?>
        <form  method="post">
            <input type="text" name="name" placeholder="Name"
                   class="mt-1 form-control">
            <input type="text" name="pass" placeholder="Password"
                   class="mt-1 form-control">
            <input type="submit" name="login" value="Login"
                   class="mt-3 btn btn-block btn-outline-primary">
        </form>
        <br/>
        <a class="register" href="registration.php">Registration</a>
    </div>

<?php require_once "../pageElements/footer.php"; ?>