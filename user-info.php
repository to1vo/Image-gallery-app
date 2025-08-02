<?php
require_once 'header.php';
if(isset($_GET['user'])){
    $username = $_GET['user'];
    // Jos käyttäjälle on kirjauduttu niin siirrytään eri sivulle
    if(isset($_SESSION['username'])){
        if($username == $_SESSION['username']){
            header("location: user-settings.php");
        }
    }
    $conn = new Dbh();
    // Katsotaan onko käyttäjä olemassa
    if(!empty($username)){
        // Tarkistetaan ettei käyttäjä ole "Unknown" niminen
        if($username != "Unknown"){
            checkUserByName($username);
        }
    } else {
        header("location: gallery.php");
    }
    // Haetaan käyttäjän kuvat
    $images = getGalleryByUserAndFetch($username);
    // Haetaan käyttäjän tiedot
    $user = getUserAndFetch($username);

?>

    <div class="container mt-3 main-div">
        <div class="user-info-div">
            <?php
            if(!empty($username && $username != "Unknown")){?>
                <div class="user-info-profile-picture-div">
                    <img class="user-info-profile-image" src="<?php echo 'img/user/'.$user[0]['usersImg']; ?>" alt="default-user-img">
                </div>
                <h2><?php echo $username; ?></h2>
                <div class="info-div">
                <?php if(!empty($user[0]['usersInfo'])){?>
                    <p class="user-info-text"><?php echo $user[0]['usersInfo']; ?></p>
                    <?php } else { ?>
                        <p>No information</p>
                <?php } ?>
                </div>
                <h6 class="mt-5 text-center">Uploaded images</h6>
                <div class="gallery-container row justify-content-center">
                    <?php
                        foreach($images as $image){
                    ?>
                        <div class="gallery-img-div col">
                            <a href="single.php?img=<?php echo 'img/gallery/'.$image['imgFullNameGallery'];?>&desc=<?php echo $image['descGallery'];?>&title=<?php echo $image['titleGallery'];?>&user=<?php echo $image['userGallery']; ?>">
                                <div class="gallery-img-div-inner">
                                    <img class="gallery-img uploaded-img"src="<?php echo 'img/gallery/'.$image['imgFullNameGallery']?>" oncontextmenu="return false;">
                                    <h4 class="hover-text">Open</h4>
                                </div>
                            </a>
                            <div class="user-profile-image-desc">
                                <h6><?php echo $image['descGallery']; ?></h6>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                </div>
                <?php } else { ?>
                    <h3>This user has no profile</h3>
                <?php 
                    } 
                ?>
        </div>
    </div>

<?php
} else {
    header('location: gallery.php');
}
require_once 'footer.php';
?>