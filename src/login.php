<?php
    require_once 'header.php';
    if(isset($_SESSION['username'])){
        header('location: gallery.php');
    }
?>
    <div class="container main-div">
        <div class="login-div">
            <h1>Login</h1>
            <?php
                if(isset($_GET['error'])){?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php
                } elseif(isset($_GET['success'])){?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php
                }
            ?>
            <div>
            <form action="../includes/login.inc.php" method="post">   
                <label for="email">Username</label>
                <input class="form-control login-form-field" type="text" id="username" name="username" placeholder="Username" required>
                <label for="password">Password</label>
                <input class="form-control login-form-field" type="password" id="password" name="password" placeholder="Password" required>
                <button class="btn btn-primary login-button" type="submit" name="login">Login</button>
            </form>
            </div>
            <p>Dont have an account? <a href="signup.php">Create one here!</a></p>
        </div>
    </div>
</body>
</html>
<?php 
require_once 'footer.php';
?>