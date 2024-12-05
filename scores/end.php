<style>
    table, th, td {
        border: 2px solid black;
        padding: 5px;
        text-align: center;
    }
    table{
        margin-left:30px;
    }
</style>
<table>
<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$datadb = 'wordpress';

$connection = new mysqli($host, $user, $pass, $datadb);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$res = $connection->query("SELECT wp_score.id, wp_score.user, wp_score.name, wp_score.score, wp_score.teacher, teacher.name as teacher_name FROM wp_score JOIN teacher ON wp_score.teacher = teacher.name");
$ress = $connection->query("SELECT name FROM wp_human");

echo "<tr><th>نام هنرجو</th><th>نام درس</th><th>نمره</th><th>نام دبیر</th><th>ثبت</th></tr>";

if ($ress->num_rows > 0) {
    $students = $ress->fetch_all(MYSQLI_ASSOC);
    $scores = $res->fetch_all(MYSQLI_ASSOC);
    $studentScores = [];
    
    foreach ($scores as $score) {
        $studentScores[$score['user']][] = $score;
    }

    foreach ($students as $student) {
        if ($student['name'] != 'شریعتمداری') {
            if (isset($studentScores[$student['name']])) {
                foreach ($studentScores[$student['name']] as $score) {
                    echo '<tr>
                        <td>' . htmlspecialchars($student['name']) . '</td>
                        <td>' . htmlspecialchars($score['name']) . '</td>
                        <td><input type="number" name="score[' . $score['id'] . ']" required></td>
                        <td>' . htmlspecialchars($score['teacher_name']) . '</td>
                        <td><button type="submit" name="send[' . $score['id'] . ']" class="btn btn-primary">ثبت نمره</button></td>
                      </tr>';
                }
            } else {
                echo '<tr>
                    <td>' . htmlspecialchars($student['name']) . '</td>
                    <td colspan="4">هیچ نمره‌ای برای این دانش‌آموز پیدا نشد.</td>
                  </tr>';
            }
        }
    }
    
} else {
    echo "<tr><td colspan='5'>هیچ نمره‌ای برای کاربر پیدا نشد.</td></tr>";
}

$connection->close();
?>
</table>
