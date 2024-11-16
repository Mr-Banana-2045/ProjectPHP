<?php
/**
 * Plugin Name: فرم نمره
 */
function scores() {
    $host = 'sql311.infinityfree.com';
    $user = 'if0_37718715';
    $pass = 'c881FNW7LC4';
    $datadb = 'if0_37718715_wp242';
    
    $connection = new mysqli($host, $user, $pass, $datadb);
    
    // بررسی اتصال به پایگاه داده
    if ($connection->connect_error) {
        return "Connection failed: " . $connection->connect_error;
    }

    session_start();

    // بررسی ورود کاربر
    if (isset($_SESSION['username'])) {
        $username = htmlspecialchars($_SESSION['username']);
        
        $stmt = $connection->prepare("SELECT score, name FROM wp_score WHERE family = ? ORDER BY score DESC");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        
        $res = $stmt->get_result();
        
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                echo $row['name'] . ' --------------------------------------- ' . $row['score'] . "<br>";
            }
        } else {
            echo "هیچ نمره‌ای برای کاربر پیدا نشد.";
        }
        
        $stmt->close();
    } else {
        echo "لطفاً وارد شوید.";
    }
    
    $connection->close();
}

add_shortcode('score_data', 'scores');
?>
