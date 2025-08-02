<?php
    require_once 'header.php';
    if(isset($_SESSION['username'])){
        header('location: gallery.php');
    }
?>
    <div class="container main-div">
    <div class="login-div">
        <h1>Sign Up</h1>
        <?php
            if(isset($_GET['error'])){ ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php
            }
        ?>
        <div>
        <form action="includes/signup.inc.php" method="post">
            <label for="username">Username</label>
            <input class="form-control login-form-field" type="text" id="username" name="username" placeholder="Username" required>
            <label for="password">Password</label>
            <input class="form-control login-form-field" type="password" id="password" name="password" placeholder="Password min length 5" required>
            <input class="form-control login-form-field" type="password" id="password" name="passwordrepeat" placeholder="Repeat password" required>
            <label for="email">Email</label>
            <input class="form-control login-form-field" type="text" id="email" name="email" placeholder="Email" required>
            <button class="btn btn-primary login-button" type="submit" name="signup">Sign up</button>
        </form>
        </div>
        <p>Already have an account? <a href="login.php">Login from here!</a></p>
    </div>
    </div>
</body>
</html>
<?php 
require_once 'footer.php';
?>