<?php
    require_once 'header.php';
    $images = getAllFromGallery();
?>
<br>
<!-- Toivo Lindholm 2023 -->
<div class="container main-div">
    <div class="wrapper">
        <div class="gallery-container row justify-content-center">
            <?php 
                foreach($images as $image){ ?>
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
                ?>
            </div>
        </div>
</div>
<?php
    require_once 'footer.php';
?>
