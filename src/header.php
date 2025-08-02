<?php
    session_start();
    include "../classes/database.classes.php";
    include "../includes/get-user.inc.php";
    include "../includes/get-gallery.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <ul>
                <div id="nav-site-title-div">
                <li id="nav-site-title">
                    <h4 id="site-title"><a href="gallery.php">Gallery</a></h4>
                </li>
                </div>
                <div id="nav-item-right-div">
                <li class="nav-item-right">
                <?php
                    if(isset($_SESSION['username'])){
                        $userImg = getUserImage($_SESSION['username']);    
                    ?>
                        <div class="dropdown">
                            <button class="dropdown-button">
                            <Img class="navbar-img" src="<?php echo '../img/user/'.$userImg[0]['usersImg']; ?>">
                            <?php echo $_SESSION['username']; ?>
                            </button>
                            <ul>
                                <li><a class="dropdown-link-a" href="upload.php">Upload</a></li>
                                <li><a class="dropdown-link-a" href="user-settings.php">Profile</a></li>
                                <li><a class="dropdown-link-a" href="includes/logout.inc.php">Logout</a></li>
                            </ul>
                    </div>
                <?php
                    } else {
                ?>
                        <button class="btn btn-primary" onClick="window.location.href='login.php';">LOGIN</button>
                <?php
                    }
                ?>
                </li>
                </div>
                <div>
                <li id="nav-search-item">
                    <div>
                        <form action="search.php" method="get" autocomplete="off">
                            <?php
                                if(isset($_GET['search'])){?>
                                    <input class="form-control nav-search" type="text" name="search" value="<?php echo $_GET['search']?>"placeholder="Search for images..." required>
                            <?php
                                } else { ?>
                                    <input class="form-control nav-search" type="text" name="search" placeholder="Search for images..." required>
                            <?php
                                }
                            ?>
                        </form>
                    </div>
                </li>
                </div>
            </ul>
        </nav>
    </header>