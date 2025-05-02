<?php
session_start();
$conn = new mysqli("localhost", "root", "", "internet_programming_pro");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// عند الضغط على زر الدخول
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM user_table WHERE Email = ? AND Password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $_SESSION['user_id'] = $user['Id'];
        $_SESSION['user_role'] = $user['Role'];
        $_SESSION['success_message'] = "تم تسجيل الدخول بنجاح!";

        // توجيه حسب الدور
        switch ($user['Role']) {
            case 'admin':
                header("Location: admin_dash.php");
                break;
            case 'editor':
                header("Location: editor_dash.php");
                break;
            case 'author':
                header("Location: author_dash.php");
                break;
            default:
                $_SESSION['error_message'] = "صلاحية غير معروفة.";
                header("Location: login.php");
                break;
        }
        exit;
    } else {
        $_SESSION['error_message'] = "بيانات الدخول غير صحيحة.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">تسجيل الدخول</h4>
                </div>
                <div class="card-body">

                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger">
                            <?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">البريد الإلكتروني:</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">كلمة المرور:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">تسجيل الدخول</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
