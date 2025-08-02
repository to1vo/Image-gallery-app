<?php
require_once 'header.php';
    if(isset($_GET['img']) && isset($_GET['desc']) && isset($_GET['title']) &&  isset($_GET['user'])){
        $img = $_GET['img'];
        $desc = $_GET['desc'];
        $title = $_GET['title'];
        $user = $_GET['user'];
        
        if(empty($user)){
            $user = "Unknown";
        }

    } else {
        header('location: gallery.php');
    }
    $userImg = getUserImage($user);
    $images = getAllFromGallery();
    $searchWords = explode(" ", strtolower($title));
    $results = false;
?>

<div class="container mt-3 main-div">
    <div class="wrapper">
        <div class="single-container">
            <div class="single-div-img">
                <a href="#">
                    <img class="single-img uploaded-img" src="<?php echo $img;?>" oncontextmenu="return false;">
                </a>
            </div>
            <div class="single-div">
                <h3><?php echo $title;?></h3>
                <p><?php echo $desc;?></p>
                <a id="single-user-link" href="user-info.php?user=<?php echo $user; ?>">
                        <p>
                        <?php
                        if($user == "Unknown"){
                        ?>
                            <img class="userimg" src="img/user/default-user-img.png" alt="profile-picture">
                            <b><?php echo $user?></b>
                        <?php
                        } else {
                            ?>
                            <img class="userimg" src="<?php echo 'img/user/'.$userImg[0]['usersImg']; ?>" alt="profile-picture"> 
                            <b><?php echo $user;?></b>
                        <?php
                        }
                        ?>
                    </p>
                </a>
                <div class="mt-4 mb-5">
                    <form action="includes/save-image.inc.php?img='<?php echo $img; ?>'&&desc='<?php echo $desc; ?>'&&title='<?php echo $title; ?>'" method="post">
                        <button class="btn btn-primary" type="submit" name="downloadimage">Save</button>
                    </form>
                </div>
                <h5>Comments</h5>
            </div>
        </div>
        <h5 class="text-center mt-5">Similar</h5>
        <div class="gallery-container row justify-content-center">
            <?php
                foreach($images as $image){
                    if(('img/gallery/'.$image['imgFullNameGallery']) != $img){
                    $titleWords = explode(" ", strtolower($image['titleGallery']));
                    // Title
                    foreach($titleWords as $word){
                        if(in_array($word, $searchWords)){
                            $results = true;
                            break;
                        }
                    } 
                    if($results){ ?>
                        <div class="gallery-img-div col">
                        <a href="single.php?img=<?php echo 'img/gallery/'.$image['imgFullNameGallery'];?>&desc=<?php echo $image['descGallery'];?>&title=<?php echo $image['titleGallery'];?>&user=<?php echo $image['userGallery']; ?>">
                            <div class="gallery-img-div-inner">
                                <img class="gallery-img uploaded-img"src="<?php echo 'img/gallery/'.$image['imgFullNameGallery'];?>" oncontextmenu="return false;">
                                <h4 class="hover-text">Open</h4>
                            </div>
                        </a>
                        <div class="desc">
                            <p><?php echo $image['descGallery'];?></p>
                        </div>
                    </div>
                <?php
                    }
                    $results = false;
                }
                }
                ?>
            </div>
    </div>
</div>
<?php
    require_once 'footer.php';
?>

