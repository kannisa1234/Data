<?php
header("Content-Type: text/html; charset=UTF-8");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$password = "";
$dbname = "studentdb";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
$student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';
$number = isset($_POST['number']) ? $_POST['number'] : '';
$class = isset($_POST['class']) ? $_POST['class'] : '';

if ($firstname && $lastname && $student_id && $number && $class) {
    $sql = "INSERT INTO students (firstname, lastname, student_id, number, class) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssis", $firstname, $lastname, $student_id, $number, $class);

    if ($stmt->execute()) {
        echo "✅ บันทึกข้อมูลสำเร็จ";
    } else {
        echo "❌ เกิดข้อผิดพลาด: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "❗ กรุณากรอกข้อมูลให้ครบทุกช่อง";
}

$conn->close();
?>
