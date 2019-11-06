<?php require_once "../pageElements/head.php";
      require_once "../pageScripts/registr.php";

      outputHead("registration");
?>

    <div class="container form">
        <h3 class="mb-3">Registration form</h3>
        <?php echo $alert; ?>
        <form action="" method="post">
            <input type="text" name="username" placeholder="Enter username"
                   class="mt-1 form-control">
            <input type="text" name="pass1" placeholder="Enter password"
                   class="mt-1 form-control">
            <input type="text" name="pass2" placeholder="Repeat password"
                   class="mt-1 form-control">
            <input type="submit" name="regist" value="Registration"
                   class="mt-3 btn btn-block btn-outline-primary">
        </form>
        <br/>
        <a class="register" href="signup.php">Login</a>
    </div>

<?php require_once "../pageElements/footer.php"; ?>
