<?php require_once "../pageElements/head.php";
      require_once "../pageScripts/Chat.php";?>

<?php
    refreshUnloginUser('/pages/signup.php');
    outputHead("chat");
?>

    <div class="container">
        <h3 class="mb-3">Chat</h3>
        <div class="container border-bottom shadow-sm userin">
            <?php echo outputMessagesFromDB($connect); ?>
        </div>
        <form action="" method="post">
            <textarea name="message" class="form-control mt-2" placeholder="Enter massege"></textarea>
            <input type="submit" name="send" value="enter"
                   class="mt-1 btn btn-success">
        </form>
    </div>

<?php require_once "../pageElements/footer.php"; ?>
