<?php
session_start();
require_once 'config.php';


if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: admin_dash.php");
    exit;
}

$id = intval($_GET['id']);
$user = $conn->query("SELECT * FROM user_table WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "UPDATE user_table SET name = '$name', email = '$email' , role = '$role' WHERE id = '$id'";

    if ($conn->query($sql)) {
        $_SESSION['success_message'] = "تم تعديل بيانات المستخدم بنجاح.";
    } else {
        $_SESSION['error_message'] = "حدث خطأ أثناء التعديل.";
    }
    header("Location: admin_dash.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>تعديل مستخدم</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">تعديل بيانات المستخدم</h4>
    </div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">الاسم:</label>
          <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['Name']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">الإيميل:</label>
          <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['Email']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">الدور:</label>
          <select name="role" class="form-select" required>
            <option value="author" <?= $user['Role'] === 'author' ? 'selected' : '' ?>>كاتب</option>
            <option value="editor" <?= $user['Role'] === 'editor' ? 'selected' : '' ?>>محرر</option>
            <option value="admin" <?= $user['Role'] === 'admin' ? 'selected' : '' ?>>مدير</option>
          </select>
        </div>

        <button type="submit" class="btn btn-success">تحديث</button>
        
        <a href="admin_dash.php" class="btn btn-secondary">إلغاء</a>
      </form>
    </div>
  </div>
</div>

</body>
</html>
