<!-- If user is not logged In! -->
<?php if(!isset($_SESSION['username'])): ?>
    <p class="alert alert-danger text-center"><?php echo "You need to login first to access this page!"; ?></p>
    <img src="imgs/loading 5.gif" style="display: block; margin: auto; width:50%;">
    <h3 class="text-center">Redirecting to Login Page in 5 seconds!</h3>
    <?php header('Refresh: 6; url=login.php'); ?>
<?php endif;?>