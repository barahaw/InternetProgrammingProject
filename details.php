<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="assets/news .png" type="image/x-icon">
    <title>Details</title>
    <style>
        nav {
            background-color: #0f1432;
        }
        .navbar-nav .nav-link {
            color: white !important;
        }
    </style>
</head>

<body>
    <nav class="navbar d-flex justify-content-between navbar-expand-lg ">
        <div class=" container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="assets/news .png" alt="" class="navbar-toggler-icon">
            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mb-2 mb-lg-0 text-white ">
                    <li class="nav-item "><a class="nav-link active " href="index.php">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="catogry.php?category=سياسة">سياسة</a></li>
                    <li class="nav-item"><a class="nav-link" href="catogry.php?category=اقتصاد">اقتصاد</a></li>
                    <li class="nav-item"><a class="nav-link" href="catogry.php?category=صحة">صحة</a></li>
                    <li class="nav-item"><a class="nav-link" href="catogry.php?category=رياضة">رياضة</a></li>
                </ul>
                <form class="d-flex me-auto" role="search">
                    <input class="form-control me-2" type="search" placeholder="بحث" aria-label="بحث"
                        style="direction: rtl;">
                </form>
            </div>
            <div class="d-flex align-items-center">
                <div class="d-none d-lg-flex align-items-center px-2">
                    <div style="border-left: 1px solid #808080; height: 25px;"></div>
                </div>
                <div class="d-none d-lg-flex align-items-center px-2">
                    <div style="border-left: 1px solid #808080; height: 25px;"></div>
                </div>
                <div class="d-flex flex-column align-items-center text-center ms-3">
                    <div class="text-white">
                        <i class="bi bi-cloud-moon-fill"></i> 8&deg;C
                    </div>
                    <div class="text-white">الدوحة</div>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mt-2">
        <section class="row">
            <div class="row">
                <div class="col-md-8">
                    <span class="text-secondary" id="news-category"></span>
                    <h1 class="mt-2" id="news-title"></h1>
                    <span id="news-date"></span>
                    <div class="d-flex justify-content-between my-3">
                        <span>شارك القصة</span>
                        <span>
                            <a href="#" class="text-dark me-2"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="text-dark me-2"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="text-dark me-2"> <i class="bi bi-envelope"></i></a>
                            <a href="#" class="text-dark me-2"><i class="bi bi-share"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </section>
        <section class="row">
            <div class="col-md-8">
                <div class="card border bg-secondary d-inline-block">
                    <img class="card-img-top img-fluid" id="news-image" src="" alt="وصف الصورة" style="display:none;">
                    <div class="card-body p-3">
                        <p class="mb-0 text-light" id="news-image-caption"></p>
                    </div>
                </div>

                <div class="mt-4 d-flex align-items-center">
                    <button type="button" class="btn btn-secondary btn-sm rounded-circle" id="increase-font">+</button>
                    <span class="mx-2 fw-bold">الخط</span>
                    <button type="button" class="btn btn-secondary btn-sm rounded-circle" id="decrease-font">-</button>
                </div>
                <div id="news-body"></div>
            </div>
            <div class="col">
            <?php
echo '<h6 class="fw-bold d-inline-block  border-3  border-bottom  border-primary mb-0  text-muted" id="more-from-category-heading" style="display:none"></h6>';
?>
            <script>
                function updateMoreFromCategoryHeading(category) {
                    var heading = document.getElementById('more-from-category-heading');
                    if (heading && category) {
                        heading.textContent = 'المزيد من ' + category;
                        heading.style.display = '';
                    } else if (heading) { 
                        heading.style.display = 'none';
                        heading.textContent = '';
                    }
                }
            </script>

                <div class="    border-top   border-2 border-secondary pt-2 mt-0">
                    <ul class="list-unstyled" id="sidebar-news-list">
                    </ul>
                    <div class="card border-0 text-center" id="dynamic-ad-placeholder">
                        <img src="assets/ad.png" alt="advertise" class="img-fluid" width="250">
                    </div>
                </div>

        </section>
        <section class="row mt-4">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">التعليقات</div>
                    <div class="card-body">
                        <form id="comment-form">
                            <input type="hidden" name="news_id" id="comment-news-id">
                            <div class="mb-2">
                                <input type="text" class="form-control" name="username" id="comment-username" placeholder="اسمك" required>
                            </div>
                            <div class="mb-2">
                                <textarea class="form-control" name="content" id="comment-content" rows="3" placeholder="اكتب تعليقك هنا..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">إرسال التعليق</button>
                            <div id="comment-message" class="mt-2"></div>
                        </form>
                        <hr>
                        <div id="comments-list"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="row g-3 d-flex justify-content-between">
            <div class="col-md-8">
                <div class="mt-4">
                    <h6 class="border-bottom p-1">
                        <span class="border-bottom border-4 border-primary mb-0  text-secondary">
                            اقرا ايضا
                        </span>
                    </h6>
                    <ul class="list-unstyled" id="related-news-list">
                    </ul>
                </div>
            </div>
            <div class=" mt-5 col-md-3 gy-10 ">
                <h6 class="border-bottom p-1 ">
                    <span class="border-bottom border-4 border-primary ">موضوعات ذات صلة</span>
                </h6>
                <div class="container">
                    <div class="row" id="related-topics-list">
                    </div>
                </div>

            </div>
        </section>


    </main>

    <footer class=" bg-light py-4">
        <div class="container">
            <div class="row text-center text-md-start">

                <div class="col-md-3 text-center text-md-end">
                    <img src="assets/news .png" alt="logo" style="max-width: 80px;">
                    <p class="mt-2 text-muted">
                        تغطية إخبارية شاملة ومتنوعة للوسائط للأحداث الجارية والعاجلة، وتفتح الوصول إلى
                        شبكة متنوعة
                        من البرامج السياسية والاجتماعية.
                    </p>
                </div>
                <div class="col-md-3 text-center text-md-start">
                    <h6 class="fw-bold">
                        روابط
                    </h6>
                    <ul class="list-unstyled fw-bold">
                        <li>سياسة</li>
                        <li>اقتصاد</li>
                        <li>فن وثقافة</li>
                        <li>رياضة</li>
                        <li>منوعات</li>

                    </ul>
                </div>

                <div class="col-md-3 text-center text-md-start">
                    <h6 class="fw-bold">عن الموقع</h6>
                    <ul class="list-unstyled fw-bold">
                        <li>من نحن </li>
                        <li>اعلن معنا </li>


                    </ul>
                </div>

                <div class="col-md-3 d-flex flex-column align-items-center">
                    <h6 class="fw-bold">اتصل بنا</h6>
                    <div class="d-flex gap-2">
                        <span class="bg-dark rounded-circle d-inline-block" style="width: 20px; height: 20px;"></span>
                        <span class="bg-dark rounded-circle d-inline-block" style="width: 20px; height: 20px;"></span>
                        <span class="bg-dark rounded-circle d-inline-block" style="width: 20px; height: 20px;"></span>
                        <span class="bg-dark rounded-circle d-inline-block" style="width: 20px; height: 20px;"></span>
                        <span class="bg-dark rounded-circle d-inline-block" style="width: 20px; height: 20px;"></span>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <script src="JS/details.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>