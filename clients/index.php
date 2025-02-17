<?php
    session_start();

    if (isset($_SESSION['client_id'])) {
        header('Location: views/dashboard.php');
        exit();
    }

    header('Location: controllers/login.php');
    exit();
?>
<?php
