<?php require_once "../pageElements/head.php"; ?>
<?php
    require_once  "../pageScripts/userpage.php";
    refreshUnloginUser('/pages/signup.php');
    outputHead("about");
?>


<div class="d-flex flex-colomn container border-bottom shadow-sm user pb-5 pt-1">
    <div class="container usercard">
        <h4 class="my-0 mr-md-auto font-weight-normal">Name: <?php echo $name;?></h4>
        <h5 class="my-0 mr-md-auto font-weight-normal">Status: <?php echo $userData['role'];?></h5>
        <br>
        <?php echo $alert; ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="username"
                   class="mt-1 form-control">
            <input type="text" name="email" placeholder="email"
                   class="mt-1 form-control">
            <input type="file" name="image" placeholder="userimage"
                   class="mt-1">
            <input type="text" name="pass" placeholder="Old password"
                   class="mt-1 form-control">
            <input type="text" name="pass1" placeholder="New password"
                   class="mt-1 form-control">
            <input type="text" name="pass2" placeholder="Repeat password"
                   class="mt-1 form-control">
            <input type="submit" name="update" value="Update data"
                   class="mt-3 btn btn-success">
        </form>
    </div>
    <div class="container usercard">
        <img src="../img/<?php echo $userData['img'];?>" alt="" class="userimage mt-5">
    </div>
</div>
<br/>
<?php
    echo $users;
?>


