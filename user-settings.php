<?php
    require_once 'header.php';
// Onko käyttäjä kirjautunut
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];

    // Haetaan kirjautuneen käyttäjän kuvat
    $images = getGalleryByUserAndFetch($username);
    // Haetaan kirjautuneen käyttäjän tiedot
    $user = getUserAndFetch($username);
?>

<div class="container mt-3 main-div">
        <div class="user-info-div">
            <div class="user-info-profile-picture-div">
                <img class="user-info-profile-image" src="<?php echo 'img/user/'.$user[0]['usersImg']; ?>" alt="user-profile-picture">
            </div>
                <h2><?php echo $username; ?></h2>
                <div class="info-div">
                <?php if(!empty($user[0]['usersInfo'])){?>
                    <p class="user-info-text"><?php echo $user[0]['usersInfo']; ?></p>
                    <?php } else { 
                        ?>
                        <p>No information</p>
                <?php } ?>
                </div>
                <button type="button" class="btn btn-primary" onClick="window.location.href='edit-profile.php';">Edit profile</button>
                <h6 class="mt-5 text-center">Your images</h6>
                <div class="gallery-container row justify-content-center">
                    <?php
                    foreach($images as $image){ ?>
                        <div class="gallery-img-div col">
                            <a href="single.php?img=<?php echo 'img/gallery/'.$image['imgFullNameGallery'];?>&desc=<?php echo $image['descGallery'];?>&title=<?php echo $image['titleGallery'];?>&user=<?php echo $image['userGallery']; ?>">
                            <div class="gallery-img-div-inner">
                                <img class="gallery-img uploaded-img"src="<?php echo 'img/gallery/'.$image['imgFullNameGallery']?>" oncontextmenu="return false;">
                                <h4 class="hover-text">Preview</h4>
                                <h4 class="hover-text"><a href="edit-image.php?image=<?php echo $image['imgFullNameGallery']; ?>">Edit</a></h4>
                            </div>
                            </a>
                            <div class="user-profile-image-desc">
                                <h6></h6>
                            </div>
                        </div>
                    <?php } ?>
                </div>
        </div>
    </div>
<?php
    } else {
        header("location: gallery.php");
    }
    require_once 'footer.php';
?>