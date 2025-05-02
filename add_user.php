<?php
session_start();
$conn = new mysqli("localhost", "root", "", "internet_programming_pro");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $role  = $_POST['role'];
    $password = $_POST['password']; // مبدئياً بدون تشفير

    $stmt = $conn->prepare("INSERT INTO user_table (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "تم إنشاء المستخدم بنجاح.";
        header("Location: admin_dash.php");
        exit;
    } else {
        $_SESSION['error_message'] = "حدث خطأ أثناء إضافة المستخدم.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>إضافة مستخدم</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">إضافة مستخدم جديد</h4>
    </div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">الاسم:</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">الإيميل:</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">كلمة المرور:</label>
          <input type="text" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">الدور:</label>
          <select name="role" class="form-select" required>
            <option value="author">كاتب</option>
            <option value="editor">محرر</option>
            <option value="admin">مدير</option>
          </select>
        </div>

        <button type="submit" class="btn btn-success">إنشاء المستخدم</button>
        <a href="admin_dashboard.php" class="btn btn-secondary">إلغاء</a>
      </form>
    </div>
  </div>
</div>

</body>
</html>
