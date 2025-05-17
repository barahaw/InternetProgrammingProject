<?php
session_start();
require_once 'config.php';

$categoryResult = $conn->query("SELECT * FROM category_table");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $category_id = $_POST['category_id'];
    $keywords = isset($_POST['keywords']) ? $_POST['keywords'] : '';
    $author_id = isset($_SESSION['author_id']) ? $_SESSION['author_id'] : 0;
    $status = 'pending';

    $image_name = "";
    if (!empty($_FILES['image']['name'])) {
        $image_name = basename($_FILES["image"]["name"]);
        $target_dir = "uploads/";
        $target_file = $target_dir . $image_name;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }

    $sql = "INSERT INTO news_table (title, body, image, category_id, author_id, status, keywords) VALUES( '$title', '$body', '$image_name', '$category_id', '$author_id', '$status', '$keywords')";
        
    if ($conn->query($sql)) {
      $_SESSION['success_message'] = "تم اضافة الخبر بنجاح.";
  } else {
      $_SESSION['error_message'] = "فشل في اضافة الخبر : " . $conn->error;
  }
    header("Location: add_news.php");
    exit;
    
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>إضافة خبر</title>
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
    <img src="assets/news .png" alt="" class="navbar-toggler-icon">
  </a>
  <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="author_dash.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link active" href="add_news.php">إضافة خبر</a></li>
        <li class="nav-item"><a class="nav-link text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">تسجيل الخروج</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show alert-fixed" role="alert">
      <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
    </div>
  <?php endif; ?>

  <?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger alert-dismissible fade show alert-fixed" role="alert">
      <?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
    </div>
  <?php endif; ?>
</div>

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">إضافة خبر جديد</h4>
    </div>
    <div class="card-body">
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">العنوان:</label>
          <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">المحتوى:</label>
          <textarea name="body" class="form-control" rows="6" required></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">الصورة:</label>
          <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
          <label for="category" class="form-label">اختر القسم</label>
          <select name="category_id" id="category" class="form-select" required>
            <option value="">-- اختر القسم --</option>
            <?php while($cat = $categoryResult->fetch_assoc()): ?>
              <option value="<?= $cat['Id'] ?>"><?= $cat['Name'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">الكلمات المفتاحية (مفصولة بفواصل):</label>
          <input type="text" name="keywords" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">إضافة الخبر</button>
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