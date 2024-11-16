<?php
/**
 * Plugin Name: فرم دیتا
 */
function input(){
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $datadb = 'wordpress';

    $connection = new mysqli($host, $user, $pass, $datadb);
    if ($connection->connect_error) {
        return "Connection Failed: " . $connection->connect_error;
    }

    session_start();
    if (isset($_SESSION['username'])) {
        $username = htmlspecialchars($_SESSION['username']);
        $connection->close();
        return "<h4>User : " . $username . "</h4>";
    } else {
        $connection->close();
    }
}
add_shortcode('input_user', 'input');
?>
