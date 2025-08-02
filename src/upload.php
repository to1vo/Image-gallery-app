<?php
    require_once 'header.php';

if(isset($_SESSION['username'])){ ?>
    <div class="container mt-5 main-div">
        <div class="gallery-upload">
        <h1>Upload image!</h1>
        <?php
            if(isset($_GET['upload'])){ ?>
            <p class="error"><?php echo $_GET['upload']; ?></p>   
        <?php        
            } elseif(isset($_GET['success'])){ ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php
            }
        ?>
            <form action="../includes/gallery-upload.inc.php" method="post" enctype="multipart/form-data">
                <label for="filename">Name</label>
                <input class="form-control login-form-field" type="text" id="filename" name="filename" placeholder="File name..."><br>
                <label for="filetitle">Title</label>
                <input class="form-item form-control login-form-field" id="filetitle" type="text" name="filetitle" placeholder="Image title..." required><br>
                <label for="filedesc">Description</label>
                <input class="form-item form-control login-form-field" id="filedesc" type="text" name="filedesc" placeholder="Image description..."><br>
                <input class="form-item form-control login-form-field" type="file" name="file" required><br>
                <button class="btn btn-primary" type="submit" name="submit">UPLOAD</button>
            </form>
            <p class="mt-3">Title for the image is required</p>
            <p>It is recommended that the image is vertical</p>
        </div>
    </div>
<?php } else {
    header('location: login.php');
} 
require_once 'footer.php';
?>
