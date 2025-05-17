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
                    <li class="nav-item"><a class="nav-link" href="#political">سياسة</a></li>
                    <li class="nav-item"><a class="nav-link" href="#economic">اقتصاد</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">صحة</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">رياضة</a></li>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentNewsCategory = null;
        let currentNewsId = null;
        const newsBody = document.getElementById('news-body');
        const increaseFontBtn = document.getElementById('increase-font');
        const decreaseFontBtn = document.getElementById('decrease-font');
        let currentFontSize = 16;
        const fontSizeStep = 2;
        const minFontSize = 10;
        const maxFontSize = 30;
        if (newsBody && increaseFontBtn && decreaseFontBtn) {
            newsBody.style.fontSize = currentFontSize + 'px';
            increaseFontBtn.addEventListener('click', () => {
                if (currentFontSize < maxFontSize) {
                    currentFontSize += fontSizeStep;
                    newsBody.style.fontSize = currentFontSize + 'px';
                }
            });
            decreaseFontBtn.addEventListener('click', () => {
                if (currentFontSize > minFontSize) {
                    currentFontSize -= fontSizeStep;
                    newsBody.style.fontSize = currentFontSize + 'px';
                }
            });
        }
        function renderMostReadSidebar(data) {
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
                        <h6 class="fw-bold border-bottom pb-2 mb-2 text-primary">المزيد من الأخبار</h6>
                        <div class="row g-2">
                            ${data.moreNews.map(news => `
                                <div class="col-12 mb-2">
                                    <div class="card border-0 flex-row align-items-center">
                                        <a href="details.php?id=${news.id}"><img src="assets/${news.image || 'more1.png'}" class="card-img-top me-2" alt="News Image" style="width:60px;height:60px;object-fit:cover;"></a>
                                        <div class="card-body p-2">
                                            <span class="text-secondary small">${news.category || ''}</span>
                                            <h6 class="card-title mb-1" style="font-size:1rem;">
                                                <a href="details.php?id=${news.id}" class="text-decoration-none text-dark">${news.title}</a>
                                            </h6>
                                            <p class="card-text text-secondary small mb-0">${news.excerpt || ''}</p>
                                        </div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `;
            }
            return `<ul class="list-unstyled">${listHtml}</ul>${moreNewsHtml}`;
        }
        fetch('most_read.php')
            .then(res => res.json())
            .then(data => {
                const sidebar = document.getElementById('most-read-list');
                if (sidebar) {
                    sidebar.innerHTML = renderMostReadSidebar(data);
                }
            });
        function renderSidebarNews(data) {
            return data.slice(0,3).map(item => `
                <li class="py-2 border-bottom">
                    <i class="bi bi-pentagon-fill" style="color:#8F87F1; font-size: 10px;"></i>
                    <a href="details.php?id=${item.id}" class="text-decoration-none text-dark">${item.title}</a>
                </li>
            `).join('');
        }
        fetch('random_news.php')
            .then(res => res.json())
            .then(data => {
                const list = document.getElementById('sidebar-news-list');
        if (list) list.innerHTML = renderSidebarNews(data);
            });
        function loadDynamicAd() {
            fetch('get_random_ad.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(ad_data => {
                    const adContainer = document.getElementById('dynamic-ad-container');
                    if (adContainer) {
                        if (ad_data && ad_data.image) {
                            adContainer.innerHTML = `<img src="${ad_data.image}" alt="${ad_data.ad_text || 'Advertisement'}" class="img-fluid" width="250">`;
                        } else {
                            console.log('No ad data received or ad has no image.');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error fetching dynamic ad:', error);
                    const adContainer = document.getElementById('dynamic-ad-container');
                    if (adContainer) {
                        adContainer.innerHTML = '<img src="assets/ad.png" alt="advertise" class="img-fluid" width="250">';
                    }
                });
        }
        function renderAlsoRead(data) {
            if (!Array.isArray(data)) return '';
            return data.slice(0, 3).map(item => `
                <li class="py-2 border-bottom d-flex align-items-center">
                    <a href="details.php?id=${item.id}" class="text-decoration-none text-dark">
                        ${item.title}
                    </a>
                </li>
            `).join('');
        }
        function renderRelatedTopics(data) {
            return data.map(item => `
                <div class="col-12">
                    <div class="d-flex align-items-center py-2">
                        <img src="assets/${item.image || 'd1.png'}" width="80" height="80" class="me-2">
                        <div class="d-flex flex-column me-2">
                            <span class="fw-medium text-muted ">${item.category || ''}</span>
                            <a href="details.php?id=${item.id}" class="text-decoration-none text-dark fw-semibold fs-6 mt-1">
                                ${item.title}
                            </a>
                        </div>
                    </div>
                </div>
            `).join('');
        }
        function renderMainNews(news) {
            if (news.error) {
                document.getElementById('news-title').textContent = 'الخبر غير موجود أو حدث خطأ.';
                document.getElementById('news-category').textContent = '';
                document.getElementById('news-date').textContent = '';
                document.getElementById('news-image').style.display = 'none';
                document.getElementById('news-image-caption').textContent = '';
                document.getElementById('news-body').innerHTML = '';
                if (typeof updateMoreFromCategoryHeading === 'function') {
                    updateMoreFromCategoryHeading(null);
                }
                const relatedTopics = document.getElementById('related-topics-list');
                if (relatedTopics) relatedTopics.innerHTML = '';
                const alsoReadList = document.getElementById('related-news-list');
                if (alsoReadList) alsoReadList.innerHTML = '';
                return;
            }
            currentNewsCategory = news.category;
            currentNewsId = news.id;
            document.getElementById('news-category').textContent = news.category || '';
            document.getElementById('news-title').textContent = news.title || '';
            document.getElementById('news-date').textContent = news.date_posted ? new Date(news.date_posted).toLocaleDateString('ar-EG', { year: 'numeric', month: 'long', day: 'numeric' }) : '';
            if (news.image) {
                var img = document.getElementById('news-image');
                img.src = 'assets/' + news.image;
                img.style.display = '';
            } else {
                document.getElementById('news-image').style.display = 'none';
            }
            let caption = (news.image_caption && news.image_caption.trim() !== '')
                ? news.image_caption
                : (news.body ? news.body.split(/\s+/).slice(0, 10).join(' ') + (news.body.split(/\s+/).length > 10 ? '...' : '') : '');
            document.getElementById('news-image-caption').textContent = caption;
            document.getElementById('news-body').innerHTML = `<p class="text-muted">${news.body || ''}</p>`;
            if (typeof updateMoreFromCategoryHeading === 'function') {
                updateMoreFromCategoryHeading(news.category);
            }
            if (currentNewsCategory) {
                fetch(`related_news.php?category=${encodeURIComponent(currentNewsCategory)}&exclude=${currentNewsId}`)
                    .then(res => res.json())
                    .then(data => {
                        const relatedTopics = document.getElementById('related-topics-list');
                        if (relatedTopics) relatedTopics.innerHTML = renderRelatedTopics(data);
                        const alsoReadList = document.getElementById('related-news-list');
                        if (alsoReadList) {
                            alsoReadList.innerHTML = renderAlsoRead(data);
                        }
                    })
                    .catch(error => {
                        const relatedTopics = document.getElementById('related-topics-list');
                        if (relatedTopics) relatedTopics.innerHTML = '<div class="col-12 text-muted">تعذر تحميل الموضوعات ذات الصلة.</div>';
                        const alsoReadList = document.getElementById('related-news-list');
                        if (alsoReadList) alsoReadList.innerHTML = '<li class="text-muted">تعذر تحميل الأخبار ذات الصلة.</li>';
                    });
            } else {
                const relatedTopics = document.getElementById('related-topics-list');
                if (relatedTopics) relatedTopics.innerHTML = '';
                const alsoReadList = document.getElementById('related-news-list');
                if (alsoReadList) alsoReadList.innerHTML = '';
            }
        }
        const urlParams = new URLSearchParams(window.location.search);
        const newsId = urlParams.get('id');
        if (newsId) {
            fetch('details_api.php?id=' + newsId)
                .then(res => res.json())
                .then(news => renderMainNews(news))
                .catch(() => {
                    document.getElementById('news-title').textContent = 'تعذر تحميل الخبر من قاعدة البيانات.';
                });
        }
        function fetchAndDisplayAd() {
            const adPlaceholder = document.getElementById('dynamic-ad-placeholder');
            if (!adPlaceholder) {
                return;
            }
            fetch('get_random_ad.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data && data.image) {
                        adPlaceholder.innerHTML = `<img src="${data.image}" alt="${data.ad_text || 'Advertisement'}" class="img-fluid" width="250">`;
                    }
                })
                .catch(error => {
                });
        }
        document.addEventListener('DOMContentLoaded', fetchAndDisplayAd);
        function loadComments(newsId) {
            fetch('comments.php?news_id=' + newsId)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('comments-list').innerHTML = html;
                });
        }
        function setupCommentForm(newsId) {
            document.getElementById('comment-news-id').value = newsId;
            document.getElementById('comment-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch('add_comment.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.text())
                .then(result => {
                    const msg = document.getElementById('comment-message');
                    if (result.trim() === 'success') {
                        msg.textContent = 'تم إضافة التعليق بنجاح.';
                        msg.className = 'alert alert-success mt-2';
                        this.reset();
                        loadComments(newsId);
                    } else {
                        msg.textContent = 'حدث خطأ أثناء إضافة التعليق.';
                        msg.className = 'alert alert-danger mt-2';
                    }
                });
            }, { once: true });
        }
        function afterNewsLoaded(news) {
            if (news && news.id) {
                loadComments(news.id);
                setupCommentForm(news.id);
            }
        }
        const origRenderMainNews = renderMainNews;
        renderMainNews = function(news) {
            origRenderMainNews(news);
            afterNewsLoaded(news);
        }
    </script>
</body>

</html>