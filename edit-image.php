<?php
require_once 'header.php';
if(isset($_GET['image'])){
    $username = $_SESSION['username'];
    $imgfullname = $_GET['image'];
    $image = getGalleryByImgnameAndFetch($imgfullname);
    $images = getGalleryByUserAndFetch($username);
?>

<div class="container mt-3 main-div">
    <div class="wrapper">
        <div class="single-container">
            <div class="single-div-img">
                <a href="#">
                    <img class="single-img uploaded-img" src="<?php echo 'img/gallery/'.$imgfullname;?>" oncontextmenu="return false;">
                </a>
            </div>
            <div class="single-div">
                <h3>Edit image</h3>
                <div class="edit-image-form-div">
                <form action="includes/image-update.inc.php?imgfullname=<?php echo $imgfullname; ?>" method="post">
                    <label for="title">Title</label>
                    <input type="text" class="form-item form-control edit-image-form-field" id="title" name="title" value="<?php echo $image[0]['titleGallery']; ?>" placeholder="Title">
                    <label for="desc">Description</label>
                    <input type="text" class="form-item form-control edit-image-form-field" id="desc" name="desc" value="<?php echo $image[0]['descGallery']; ?>" placeholder="Description">
                    <button type="submit" name="imageupdate" class="btn btn-primary edit-image-form-field">Save changes</button>
                </form>
                </div>
            </div>
        </div>
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