<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $role = $_POST['role'];
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    if (!$email) {
        $_SESSION['error_message'] = "الإيميل غير صالح.";
        header("Location: add_user.php");
        exit;
    }

    $check = $conn->query("SELECT email FROM user_table WHERE email='$email'");
    if ($check->num_rows > 0) {
        $_SESSION['error_message'] = "الإيميل مستخدم بالفعل.";
        header("Location: add_user.php");
        exit;
    }


    $stmt = $conn->prepare("INSERT INTO user_table (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $name, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "تم إنشاء المستخدم بنجاح.";
    } else {
        $_SESSION['error_message'] = "فشل في إنشاء المستخدم: " . $stmt->error;
    }
    $stmt->close();
    header("Location: admin_dash.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>إضافة مستخدم</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .alert-fixed {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 1050;
      min-width: 300px;
    }
  </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="assets/news.png" alt="شعار الأخبار" width="30">
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="admin_dash.php">لوحة تحكم المدير</a></li>
        <li class="nav-item"><a class="nav-link text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">تسجيل الخروج</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show alert-fixed" role="alert">
      <?= htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
    </div>
  <?php endif; ?>

  <?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger alert-dismissible fade show alert-fixed" role="alert">
      <?= htmlspecialchars($_SESSION['error_message']); unset($_SESSION['error_message']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
    </div>
  <?php endif; ?>
</div>

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
          <input type="password" name="password" class="form-control" required>
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
        <a href="admin_dash.php" class="btn btn-secondary">إلغاء</a>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title" id="logoutModalLabel">
          <img src="https://cdn-icons-png.flaticon.com/512/1828/1828843.png" width="24" class="me-2">
          تأكيد تسجيل الخروج
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
      </div>
      <div class="modal-body text-center">
        هل أنت متأكد أنك تريد تسجيل الخروج؟
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
        <a href="logout.php" class="btn btn-danger">تأكيد الخروج</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const alerts = document.querySelectorAll('.alert');
  alerts.forEach(alert => {
    setTimeout(() => {
      const bsAlert = new bootstrap.Alert(alert);
      bsAlert.close();
    }, 10000);
  });
</script>
</body>
</html>