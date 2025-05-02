<?php
session_start();
$conn = new mysqli("localhost", "root", "", "internet_programming_pro");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['Id']);
    $title = $_POST['Title'];
    $body = $_POST['body'];
    $category_id = $_POST['category_id'];

    $image_name = "";

    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . basename($_FILES["image"]["name"]);
        $target_dir = "uploads/";
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql = "UPDATE news_table SET Title = ?, Body = ?, Category_Id = ?, image = ? WHERE Id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssisi", $title, $body, $category_id, $image_name, $id);
        } else {
            $_SESSION['error_message'] = "فشل في رفع الصورة.";
            header("Location: edit_news.php?id=$id");
            exit;
        }
    } else {
        $sql = "UPDATE news_table SET Title = ?, Body = ?, Category_Id = ? WHERE Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $title, $body, $category_id, $id);
    }

    if (isset($stmt) && $stmt->execute()) {
        $_SESSION['success_message'] = "تم تعديل الخبر بنجاح!";
    } else {
        $_SESSION['error_message'] = "حدث خطأ أثناء التعديل.";
    }
    header("Location: edit_news.php?id=$id");
    exit;

    
}
