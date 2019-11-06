<?php require_once "../pageElements/head.php";
      require_once "../pageScripts/addPost.php";?>
<?php
    refreshUnloginUser('/pages/signup.php');
    outputHead("webSitePHP");
?>

    <div class="container form">
        <h3 class="mb-3">Add post</h3>
        <?php echo $alert; ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="header" placeholder="Enter post header"
                   class="mt-1 form-control">
            <input type="file" name="image" placeholder="Post image"
                   class="mt-1">

            <input type="text" name="text" placeholder="Post text"
                   class="mt-1 form-control">
            <input type="text" name="button" placeholder="Post button"
                   class="mt-1 form-control">
            <input type="submit" name="add" value="Add post"
                   class="mt-3 btn btn-block btn-success">
        </form>
        <br/>
    </div>

<?php require_once "../pageElements/footer.php";?>