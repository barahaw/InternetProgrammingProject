<?php
session_start();
require_once 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['Id']);
    $title = $_POST['Title'];
    $body = $_POST['body'];
    $category_id = $_POST['category_id'];
    $keywords = isset($_POST['keywords']) ? $_POST['keywords'] : '';

    $image_name = "";

    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . basename($_FILES["image"]["name"]);
        $target_dir = "assets/";
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $stmt = $conn->prepare("UPDATE news_table SET Title = ?, Body = ?, Category_Id = ?, image = ?, keywords = ? WHERE Id = ?");
            $stmt->bind_param('sssssi', $title, $body, $category_id, $image_name, $keywords, $id);
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "تم تعديل الخبر بنجاح!";
            } else {
                $_SESSION['error_message'] = "حدث خطأ أثناء التعديل.";
            }
            $stmt->close();
            header("Location: edit_news.php?id=$id");
            exit;
        } else {
            $_SESSION['error_message'] = "فشل في رفع الصورة.";
            header("Location: edit_news.php?id=$id");
            exit;
        }
    } else {
        $stmt = $conn->prepare("UPDATE news_table SET Title = ?, Body = ?, Category_Id = ?, keywords = ? WHERE Id = ?");
        $stmt->bind_param('ssssi', $title, $body, $category_id, $keywords, $id);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "تم تعديل الخبر بنجاح!";
        } else {
            $_SESSION['error_message'] = "حدث خطأ أثناء التعديل.";
        }
        $stmt->close();
        header("Location: edit_news.php?id=$id");
        exit;
    }
}
