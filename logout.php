  <?php 
 
        ob_start();
        session_start();
        unset($_SESSION['type']);
        ob_get_clean();
        session_destroy();
        header('Location: login.php');
        
        
    ?>