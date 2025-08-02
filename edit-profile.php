<?php
    require_once 'header.php';
    $username = $_SESSION['username'];
    $user = getUserAndFetch($username);
    
?>

<div class="container mt-3 main-div">
        <div class="edit-profile-div">
                <h2>Edit profile</h2>
                <?php
                    if(isset($_GET['error'])){?>
                    <p class="error"><?php echo $_GET['error']; ?></p>    
                <?php
                }
                ?>
                <form action="includes/profile-update.inc.php" method="post" enctype="multipart/form-data">
                    <label for="username">Username</label>
                    <input type="text" class="form-item form-control edit-profile-form-field" id="username" name="username" value="<?php echo $_SESSION['username']; ?>" placeholder="Username">
                    <label for="userinfo">Information</label>
                    <textarea class="form-item form-control edit-profile-form-field" id="userinfo" name="userinfo" rows="5" placeholder="Information about you"><?php echo $user[0]['usersInfo']; ?></textarea>
                    <label for="avatarfile">Profile picture</label><br>
                    <div class="edit-profile-img-div">
                        <img class="user-info-profile-image" src="<?php echo 'img/user/'.$user[0]['usersImg']; ?>" alt="default-user-img">
                    </div>
                    <input class="form-item form-control edit-profile-form-field" type="file" id="avatarfile" name="avatarfile"><br>
                    <button type="submit" class="btn btn-primary" name="profileupdate">Save</button>
                </form>
        </div>
    </div>

<?php
    require_once 'footer.php';
?>