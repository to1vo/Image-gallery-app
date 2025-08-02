<?php
require_once 'header.php';
if(isset($_GET['search']) && !empty($_GET['search']) && !ctype_space($_GET['search'])){
    $searchWord = strtolower($_GET['search']);
    $searchWords = explode(" ", $searchWord);
    $i = 0;
    foreach($searchWords as $word){
        if(empty($word)){
            unset($searchWords[$i]);
        }
        $i += 1;
    }
    $results = false;
    $resultAmount = 0;
    $images = getAllFromGallery();
?>

<div class="container main-div">
    <div class="wrapper">
        <div class="gallery-container row justify-content-center">
<?php
        foreach($images as $image){ 
            $titleWords = explode(" ", strtolower($image['titleGallery']));
            $descWords = explode(" ", strtolower($image['descGallery']));
            // Title
            foreach($titleWords as $word){
                if(in_array($word, $searchWords)){
                    $results = true;
                    break;
                }
            }
            // Desc
            foreach($descWords as $word){
                if(in_array($word, $searchWords)){
                    $results = true;
                    break;
                }
            }
            
            if($results){
                $resultAmount += 1;
            ?>
                <div class="gallery-img-div col">
                    <a href="single.php?img=<?php echo 'img/gallery/'.$image['imgFullNameGallery'];?>&desc=<?php echo $image['descGallery'];?>&title=<?php echo $image['titleGallery'];?>&user=<?php echo $image['userGallery'];?>">
                    <div class="gallery-img-div-inner">
                        <img class="gallery-img uploaded-img"src="<?php echo 'img/gallery/'.$image['imgFullNameGallery'];?>">
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
            if($resultAmount == 0){ ?>
                <div id="no-results-div">
                    <h3>Sadly there are no results for "<?php echo $searchWord; ?>"<h3>       
                </div>
            <?php 
            }
            ?>
        </div>
    </div>
</div>
<?php
} else {
    header('location: gallery.php');
}
require_once 'footer.php';
?>
