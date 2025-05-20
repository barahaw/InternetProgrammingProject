<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="shortcut icon" href="assets/news .png" type="image/x-icon">
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
                <form class="d-flex me-auto" role="search" id="main-search-form">
                    <input class="form-control me-2" type="search" placeholder="بحث" aria-label="بحث"
                        style="direction: rtl;">
                    <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
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

    <main class="container mt-4">

        <div class="row g-5 mb-5" id="main-random-news"></div>

        <div class="row mb-5" id="most-read-section"></div>

        <script>
            function renderMainRandomNews(newsArr) {
                if (!Array.isArray(newsArr) || newsArr.length === 0) {
                    return '<div class="alert alert-info">لا توجد أخبار متاحة حالياً.</div>';
                }
                let html = '';
                if (newsArr[0]) {
                    html += `
                    <div class="col-md-4">
                        <div class="card bg-dark text-white">
                            <a href="details.php?id=${newsArr[0].id}"><img src="assets/${newsArr[0].image}" class="card-img-top" alt="${newsArr[0].title}" style="aspect-ratio:16/14;object-fit:cover;"></a>
                            <div class="card-body">
                                <h6 class="card-title text-secondary">${newsArr[0].category || ''}</h6>
                                <a href="details.php?id=${newsArr[0].id}" class="text-white text-decoration-none"><h5>${newsArr[0].title || ''}</h5></a>
                                <p class="card-text">${newsArr[0].summary || newsArr[0].excerpt || ''}</p>
                                <p class="card-text text-secondary">${newsArr[0].body ? newsArr[0].body.substring(0, 120) : ''}</p>
                                <p class="card-text text-info">${newsArr[0].author ? 'الكاتب: ' + newsArr[0].author : ''}</p>
                            </div>
                        </div>
                    </div>`;
                }
                html += '<div class="col-md-3">';
                for (let i = 1; i <= 2; i++) {
                    if (newsArr[i]) {
                        html += `
                        <div class="card mb-3 border-0">
                            <a href="details.php?id=${newsArr[i].id}"><img src="assets/${newsArr[i].image}" class="card-img-top" alt="${newsArr[i].title}" style="aspect-ratio:16/14;object-fit:cover;"></a>
                            <div class="card-body">
                                <h6 class="card-title text-secondary-emphasis">${newsArr[i].category || ''}</h6>
                                <a href="details.php?id=${newsArr[i].id}" class="text-dark text-decoration-none"><p class="card-text font-weight-bold text-dark">${newsArr[i].title || ''}</p></a>
                                <p class="card-text text-info">${newsArr[i].author ? 'الكاتب: ' + newsArr[i].author : ''}</p>
                            </div>
                        </div>`;
                    }
                }
                html += '</div>';
                html += '<div class="col-md-3">';
                for (let i = 3; i <= 4; i++) {
                    if (newsArr[i]) {
                        html += `
                        <div class="card mb-3 border-0">
                            <a href="details.php?id=${newsArr[i].id}"><img src="assets/${newsArr[i].image}" class="card-img-top" alt="${newsArr[i].title}" style="aspect-ratio:16/14;object-fit:cover;"></a>
                            <div class="card-body">
                                <h5 class="card-title">${newsArr[i].category || ''}</h5>
                                <a href="details.php?id=${newsArr[i].id}" class="text-dark text-decoration-none"><p class="card-text">${newsArr[i].title || ''}</p></a>
                                <p class="card-text text-info">${newsArr[i].author ? 'الكاتب: ' + newsArr[i].author : ''}</p>
                            </div>
                        </div>`;
                    }
                }
                html += '</div>';
                return html;
            }

            function loadMainRandomNews() {
                fetch('random_news.php')
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('main-random-news').innerHTML = renderMainRandomNews(data);
                    })
                    .catch(() => {
                        document.getElementById('main-random-news').innerHTML = '<div class="alert alert-danger">حدث خطأ أثناء تحميل الأخبار.</div>';
                    });
            }
            window.addEventListener('DOMContentLoaded', loadMainRandomNews);

            function renderMostReadSection(data) {
                let listHtml = data.list.map((item, idx) => `
                    <li class="py-2 border-bottom">
                        <strong class="text-muted">${idx + 1}.</strong>
                        <a href="details.php?id=${item.id}" class="text-decoration-none text-dark">${item.title}</a>
                    </li>
                `).join('');
                let moreNewsHtml = '';
                if (data.moreNews && data.moreNews.length) {
                    moreNewsHtml = `
                        <div class="mt-4">
                            <div class="row g-3">
                                ${data.moreNews.slice(0, 3).map((news, idx) => {
                                    if (idx === 0) {
                                        return `
                                        <div class="col-md-6 col-lg-4">
                                            <div class="card border-0 h-100 d-flex flex-column">
                                                <a href="details.php?id=${news.id}"><img src="assets/${news.image || 'more1.png'}" class="card-img-top" alt="News Image" style="aspect-ratio:16/14;object-fit:cover;"></a>
                                                <div class="card-body">
                                                    <span class="text-secondary">${news.category || ''}</span>
                                                    <h6 class="card-title">
                                                        <a href="details.php?id=${news.id}" class="text-decoration-none text-dark">${news.title}</a>
                                                    </h6>
                                                    <p class="card-text text-secondary">${news.excerpt || ''}</p>
                                                </div>
                                            </div>
                                        </div>
                                        `;
                                    } else {
                                        return `
                                        <div class="col-md-6 col-lg-4">
                                            <div class="card border-0 h-100 d-flex flex-column">
                                                <div class="card-body order-1 mb-2">
                                                    <span class="text-secondary">${news.category || ''}</span>
                                                    <h6 class="card-title">
                                                        <a href="details.php?id=${news.id}" class="text-decoration-none text-dark">${news.title}</a>
                                                    </h6>
                                                    <p class="card-text text-secondary">${news.excerpt || ''}</p>
                                                </div>
                                                <a href="details.php?id=${news.id}" class="order-2 mt-1"><img src="assets/${news.image || 'more1.png'}" class="card-img-top" alt="News Image" style="aspect-ratio:16/14;object-fit:cover;"></a>
                                            </div>
                                        </div>
                                        `;
                                    }
                                }).join('')}
                            </div>
                        </div>
                    `;
                } else {
                    moreNewsHtml = '<div class="alert alert-info">لا يوجد المزيد من الأخبار.</div>';
                }
                return `
                    <div class="row ">
                        <span class="col-md border-bottom">
                            <div class="d-flex justify-content-between mt-3">
                                <div class="border-bottom border-3 border-primary pb-1">
                                    <h5 class="text-secondary">الاكثر قراءة</h5>
                                </div>
                                <div class="border-bottom border-3 border-primary pb-1">
                                    <h5>المزيد من الأخبار</h5>
                                </div>
                                <div>
                                    <div class="col">
                                        <a class="text-decoration-none text-primary" href="#more-news-list"> المزيد</a>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                    <section class="row mt-3">
                        <div class="col-md-4">
                            <ul class="list-unstyled">${listHtml}</ul>
                        </div>
                        <div class="col-md-8">
                            <div id="more-news-list">${moreNewsHtml}</div>
                        </div>
                    </section>
                `;
            }
            function loadMostReadSection() {
                fetch('most_read.php')
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('most-read-section').innerHTML = renderMostReadSection(data);
                    });
            }
            window.addEventListener('DOMContentLoaded', loadMostReadSection);

            function addCategoryMoreLinks() {
                const sectionMap = {
                    'political-news-section': 'سياسة',
                    'economic-news-section': 'اقتصاد',
                    'sport-news-section': 'رياضة',
                    'health-news-section': 'صحة'
                };
                Object.entries(sectionMap).forEach(([sectionId, category]) => {
                    const section = document.getElementById(sectionId);
                    if (section) {
                        section.addEventListener('click', function(e) {
                            const target = e.target;
                            if (target && target.matches('a.text-decoration-none, a.more-link')) {
                                e.preventDefault();
                                window.location.href = `catogry.php?category=${encodeURIComponent(category)}`;
                            }
                        });
                    }
                });
            }
            window.addEventListener('DOMContentLoaded', addCategoryMoreLinks);

            const mainSearchForm = document.getElementById('main-search-form');
            if (mainSearchForm) {
                mainSearchForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const q = this.querySelector('input[type="search"]').value.trim();
                    if (!q) return;
                    window.location.href = `catogry.php?q=${encodeURIComponent(q)}`;
                });
            }
        </script>

        <section class="row g-1 mb-5" id="political-news-section"></section>

        <script>
            function renderSectionWithMainAndSideCards(data, sectionTitle) {
                let mainCard = data.main ? `
                    <div class="col-md-6">
                        <div class="card border-0 h-100">
                            <a href="details.php?id=${data.main.id}"><img src="assets/${data.main.image}" class="card-img-top" alt="${data.main.title}" style="aspect-ratio:16/14;object-fit:cover;"></a>
                            <div class="card-body">
                                <h6 class="card-title mt-2">${data.main.category}</h6>
                                <a href="details.php?id=${data.main.id}" class="text-decoration-none text-dark"><strong>${data.main.title}</strong></a>
                                <p class="text-secondary">${data.main.excerpt}</p>
                            </div>
                        </div>
                    </div>
                ` : '';
                let sideCards = '';
                if (data.side && data.side.length > 0) {
                    for (let i = 0; i < 4; i += 2) {
                        sideCards += '<div class="col-md-3 d-flex flex-column gap-2">';
                        for (let j = i; j < i + 2 && j < data.side.length; j++) {
                            const card = data.side[j];
                            sideCards += `
        <div class="card border-0 mb-2 p-1" style="font-size:0.92rem;">
            <a href="details.php?id=${card.id}"><img src="assets/${card.image}" class="card-img-top" alt="${card.title}" style="aspect-ratio:16/14;object-fit:cover;"></a>
            <div class="card-body p-2">
                <h6 class="card-title text-secondary-emphasis mb-1" style="font-size:0.95rem;">${card.category || ''}</h6>
                <a href="details.php?id=${card.id}" class="text-dark text-decoration-none"><p class="card-text font-weight-bold text-dark mb-1" style="font-size:0.98rem;">${card.title || ''}</p></a>
                <p class="card-text text-info mb-0" style="font-size:0.9rem;">${card.author ? 'الكاتب: ' + card.author : ''}</p>
            </div>
        </div>
    `;
                        }
                        sideCards += '</div>';
                    }
                }
                return `
                    <div class="row ">
                        <span class="col-md border-bottom">
                            <div class="d-flex justify-content-between">
                                <h5>
                                    <span class="border-bottom border-4 border-primary pb-1 container">${sectionTitle}</span>
                                </h5>
                                <a href="#" class="text-decoration-none">المزيد</a>
                            </div>
                        </span>
                    </div>
                    <div class="row g-3">
                        ${mainCard}
                        ${sideCards}
                    </div>
                `;
            }
            function loadPoliticalNewsSection() {
                fetch('section_news.php?category=سياسة&full=1')
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('political-news-section').innerHTML = renderSectionWithMainAndSideCards(data, 'سياسة');
                    });
            }
            window.addEventListener('DOMContentLoaded', loadPoliticalNewsSection);
        </script>

        <section class="row g-2 mb-5" id="economic-news-section"></section>

        <script>
            function renderEconomicNewsSection(data) {
                return renderSectionWithMainAndSideCards(data, 'اقتصاد');
            }
            function loadEconomicNewsSection() {
                fetch('section_news.php?category=اقتصاد&full=1')
                    .then(res => res.json())
                    .then data => {
                        document.getElementById('economic-news-section').innerHTML = renderEconomicNewsSection(data);
                    });
            }
            window.addEventListener('DOMContentLoaded', loadEconomicNewsSection);
        </script>

        <section class="row g-2 mb-5" id="sport-news-section"></section>

        <script>
            function renderSportNewsSection(data) {
                let mainCard = data.main ? `
                    <div class="col-md-6 gy-3">
                        <div class="card border-0 h-100">
                            <a href="details.php?id=${data.main.id}"><img src="assets/${data.main.image}" class="card-img-top" alt="${data.main.title}" style="aspect-ratio:16/14;object-fit:cover;"></a>
                            <div class="card-body">
                                <h6 class="card-title">${data.main.category}</h6>
                                <a href="details.php?id=${data.main.id}" class="text-decoration-none text-dark"><strong>${data.main.title}</strong></a>
                                <p class="text-secondary">${data.main.excerpt}</p>
                            </div>
                        </div>
                    </div>
                ` : '';
                let sideCards = '';
                if (data.side && data.side.length > 0) {
                    for (let i = 0; i < 4; i += 2) {
                        sideCards += '<div class="col-md-3 d-flex flex-column gap-2">';
                        for (let j = i; j < i + 2 && j < data.side.length; j++) {
                            const card = data.side[j];
                            sideCards += `
        <div class="card border-0 mb-2 p-1" style="font-size:0.92rem;">
            <a href="details.php?id=${card.id}"><img src="assets/${card.image}" class="card-img-top" alt="${card.title}" style="aspect-ratio:16/14;object-fit:cover;"></a>
            <div class="card-body p-2">
                <h6 class="card-title text-secondary-emphasis mb-1" style="font-size:0.95rem;">${card.category || ''}</h6>
                <a href="details.php?id=${card.id}" class="text-dark text-decoration-none"><p class="card-text font-weight-bold text-dark mb-1" style="font-size:0.98rem;">${card.title || ''}</p></a>
                <p class="card-text text-info mb-0" style="font-size:0.9rem;">${card.author ? 'الكاتب: ' + card.author : ''}</p>
            </div>
        </div>
    `;
                        }
                        sideCards += '</div>';
                    }
                }
                return `
                    <div class="row gy-3">
                        <span class="col-md border-bottom">
                            <div class="d-flex justify-content-between">
                                <h6>
                                    <span class="border-bottom border-4 border-primary pb-1 container">رياضة</span>
                                </h6>
                                <a href="#" class="text-decoration-none">المزيد</a>
                            </div>
                        </span>
                    </div>
                    <div class="row g-3">
                        ${mainCard}
                        ${sideCards}
                    </div>
                `;
            }
            function loadSportNewsSection() {
                fetch('section_news.php?category=رياضة&full=1')
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('sport-news-section').innerHTML = renderSportNewsSection(data);
                    });
            }
            window.addEventListener('DOMContentLoaded', loadSportNewsSection);
        </script>

        <section class="row g-2 mb-5" id="health-news-section"></section>

        <script>
            function renderHealthNewsSection(data) {
                let mainCard = data.main ? `
                    <div class="col-md-6">
                        <div class="card border-0 h-100">
                            <a href="details.php?id=${data.main.id}"><img src="assets/${data.main.image}" class="card-img-top" alt="${data.main.title}" style="aspect-ratio:16/14;object-fit:cover;"></a>
                            <div class="card-body">
                                <h5 class="card-title px-2">${data.main.category}</h5>
                                <a href="details.php?id=${data.main.id}" class="text-decoration-none text-dark"><strong>${data.main.title}</strong></a>
                                <p class="text-secondary">${data.main.excerpt}</p>
                            </div>
                        </div>
                    </div>
                ` : '';
                let sideCards = '';
                if (data.side && data.side.length > 0) {
                    for (let i = 0; i < 4; i += 2) {
                        sideCards += '<div class="col-md-3 d-flex flex-column gap-2">';
                        for (let j = i; j < i + 2 && j < data.side.length; j++) {
                            const card = data.side[j];
                            sideCards += `
        <div class="card border-0 mb-2 p-1" style="font-size:0.92rem;">
            <a href="details.php?id=${card.id}"><img src="assets/${card.image}" class="card-img-top" alt="${card.title}" style="aspect-ratio:16/14;object-fit:cover;"></a>
            <div class="card-body p-2">
                <h6 class="card-title text-secondary-emphasis mb-1" style="font-size:0.95rem;">${card.category || ''}</h6>
                <a href="details.php?id=${card.id}" class="text-dark text-decoration-none"><p class="card-text font-weight-bold text-dark mb-1" style="font-size:0.98rem;">${card.title || ''}</p></a>
                <p class="card-text text-info mb-0" style="font-size:0.9rem;">${card.author ? 'الكاتب: ' + card.author : ''}</p>
            </div>
        </div>
    `;
                        }
                        sideCards += '</div>';
                    }
                }
                return `
                    <div class="row gy-3">
                        <span class="col-md border-bottom">
                            <div class="d-flex justify-content-between">
                                <h5>
                                    <span class="border-bottom border-4 border-primary pb-1 container">صحة</span>
                                </h5>
                                <a href="#" class="text-decoration-none">المزيد</a>
                            </div>
                        </span>
                    </div>
                    <div class="row g-3">
                        ${mainCard}
                        ${sideCards}
                    </div>
                `;
            }
            function loadHealthNewsSection() {
                fetch('section_news.php?category=صحة&full=1')
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('health-news-section').innerHTML = renderHealthNewsSection(data);
                    });
            }
            window.addEventListener('DOMContentLoaded', loadHealthNewsSection);
        </script>

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
                        <span class="bg-dark rounded-circle d-inline-block"
                            style="width: 20px; height: 20px;"></span>
                        <span class="bg-dark rounded-circle d-inline-block"
                            style="width: 20px; height: 20px;"></span>
                        <span class="bg-dark rounded-circle d-inline-block"
                            style="width: 20px; height: 20px;"></span>
                        <span class="bg-dark rounded-circle d-inline-block"
                            style="width: 20px; height: 20px;"></span>
                        <span class="bg-dark rounded-circle d-inline-block"
                            style="width: 20px; height: 20px;"></span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="JS/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>