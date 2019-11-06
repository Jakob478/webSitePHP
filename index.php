<?php require_once "pageElements/head.php";
      require_once "pageScripts/indexPosts.php";?>
<?php
    refreshUnloginUser('/pages/signup.php');
    outputHead("webSitePHP");
?>
<!--    <a href="pageScripts/posts.php"posts class="btn btn-lg btn-primary">Post</a>-->
    <div class="container mt-5">
        <h3 class="mb-5">Our text</h3>
        <?php echo $alert;?>

        <div class="d-flex flex-wrap container">

            <?php echo $posts;?>

        </div>
        <a class="mt-3 ml-4 btn btn-success" href="pages/addpost.php">Add post</a>
    </div>

<?php require_once "pageElements/footer.php"; ?>