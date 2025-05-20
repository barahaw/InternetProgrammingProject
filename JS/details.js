let currentNewsCategory = null;
let currentNewsId = null;
const newsBody = document.getElementById("news-body");
const increaseFontBtn = document.getElementById("increase-font");
const decreaseFontBtn = document.getElementById("decrease-font");
let currentFontSize = 16;
const fontSizeStep = 2;
const minFontSize = 10;
const maxFontSize = 30;
if (newsBody && increaseFontBtn && decreaseFontBtn) {
  newsBody.style.fontSize = currentFontSize + "px";
  increaseFontBtn.addEventListener("click", () => {
    if (currentFontSize < maxFontSize) {
      currentFontSize += fontSizeStep;
      newsBody.style.fontSize = currentFontSize + "px";
    }
  });
  decreaseFontBtn.addEventListener("click", () => {
    if (currentFontSize > minFontSize) {
      currentFontSize -= fontSizeStep;
      newsBody.style.fontSize = currentFontSize + "px";
    }
  });
}
function renderMostReadSidebar(data) {
  let listHtml = data.list
    .map(
      (item, idx) => `
        <li class="py-2 border-bottom">
            <strong class="text-muted">${idx + 1}.</strong>
            <a href="details.php?id=${
              item.id
            }" class="text-decoration-none text-dark">${item.title}</a>
        </li>
    `
    )
    .join("");
  let moreNewsHtml = "";
  if (data.moreNews && data.moreNews.length) {
    moreNewsHtml = `
            <div class="mt-4">
                <h6 class="fw-bold border-bottom pb-2 mb-2 text-primary">المزيد من الأخبار</h6>
                <div class="row g-2">
                    ${data.moreNews
                      .slice(0, 3)
                      .map(
                        (news) => `
                        <div class="col-12 mb-2">
                            <div class="card border-0 flex-row align-items-center">
                                <a href="details.php?id=${
                                  news.id
                                }"><img src="assets/${
                          news.image || "more1.png"
                        }" class="card-img-top me-2" alt="News Image" style="width:60px;height:60px;object-fit:cover;"></a>
                                <div class="card-body p-2">
                                    <span class="text-secondary small">${
                                      news.category || ""
                                    }</span>
                                    <h6 class="card-title mb-1" style="font-size:1rem;">
                                        <a href="details.php?id=${
                                          news.id
                                        }" class="text-decoration-none text-dark">${
                          news.title
                        }</a>
                                    </h6>
                                    <p class="card-text text-secondary small mb-0">${
                                      news.excerpt || ""
                                    }</p>
                                </div>
                            </div>
                        </div>
                    `
                      )
                      .join("")}
                </div>
            </div>
        `;
  }
  return `<ul class="list-unstyled">${listHtml}</ul>${moreNewsHtml}`;
}
fetch("most_read.php")
  .then((res) => res.json())
  .then((data) => {
    const sidebar = document.getElementById("most-read-list");
    if (sidebar) {
      sidebar.innerHTML = renderMostReadSidebar(data);
    }
  });
function renderSidebarNews(data, category = null) {
  let normalizedCategory = category ? category.trim().toLowerCase() : null;
  let filtered = normalizedCategory
    ? data.filter(
        (item) =>
          (item.category || "").trim().toLowerCase() === normalizedCategory
      )
    : data;
  return (
    filtered
      .slice(0, 3)
      .map(
        (item) => `
        <li class="py-2 border-bottom">
            <i class="bi bi-pentagon-fill" style="color:#8F87F1; font-size: 10px;"></i>
            <a href="details.php?id=${item.id}" class="text-decoration-none text-dark">${item.title}</a>
        </li>
    `
      )
      .join("") ||
    '<li class="text-muted">لا يوجد أخبار أخرى في نفس القسم.</li>'
  );
}
fetch("random_news.php")
  .then((res) => res.json())
  .then((data) => {
    const list = document.getElementById("sidebar-news-list");
    if (list) list.innerHTML = renderSidebarNews(data, currentNewsCategory);
  });
function fetchAndDisplayAd() {
  const adPlaceholder = document.getElementById("dynamic-ad-placeholder");
  if (!adPlaceholder) {
    return;
  }
  fetch("get_random_ad.php")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok: " + response.statusText);
      }
      return response.json();
    })
    .then((data) => {
      if (data && data.image) {
        let adHtml = `<img src="${data.image}" alt="${
          data.ad_text || "Advertisement"
        }" class="img-fluid" width="250">`;
        if (data.ad_text) {
          adHtml += `<div class="mt-2 text-secondary small text-center">${data.ad_text}</div>`;
        }
        adPlaceholder.innerHTML = adHtml;
      } else {
        adPlaceholder.innerHTML =
          '<img src="assets/ad.png" alt="advertise" class="img-fluid" width="250">';
      }
    })
    .catch((error) => {
      adPlaceholder.innerHTML =
        '<img src="assets/ad.png" alt="advertise" class="img-fluid" width="250">';
    });
}
document.addEventListener("DOMContentLoaded", fetchAndDisplayAd);
function renderAlsoRead(data) {
  if (!Array.isArray(data)) return "";
  return data
    .slice(0, 3)
    .map(
      (item) => `
        <li class="py-2 border-bottom d-flex align-items-center">
            <a href="details.php?id=${item.id}" class="text-decoration-none text-dark">
                ${item.title}
            </a>
        </li>
    `
    )
    .join("");
}
function renderRelatedTopics(data, category = null) {
  let normalizedCategory = category ? category.trim().toLowerCase() : null;
  let filtered = normalizedCategory
    ? data.filter(
        (item) =>
          (item.category || "").trim().toLowerCase() === normalizedCategory
      )
    : data;
  return filtered.length > 0
    ? filtered
        .map(
          (item) => `
            <div class="col-12">
                <div class="d-flex align-items-center py-2">
                    <img src="assets/${
                      item.image || "d1.png"
                    }" width="80" height="80" class="me-2">
                    <div class="d-flex flex-column me-2">
                        <span class="fw-medium text-muted ">${
                          item.category || ""
                        }</span>
                        <a href="details.php?id=${
                          item.id
                        }" class="text-decoration-none text-dark fw-semibold fs-6 mt-1">
                            ${item.title}
                        </a>
                    </div>
                </div>
            </div>
        `
        )
        .join("")
    : '<div class="col-12 text-muted">لا يوجد أخبار أخرى في نفس القسم.</div>';
}
function renderMainNews(news) {
  if (news.error) {
    document.getElementById("news-title").textContent =
      "الخبر غير موجود أو حدث خطأ.";
    document.getElementById("news-category").textContent = "";
    document.getElementById("news-date").textContent = "";
    document.getElementById("news-image").style.display = "none";
    document.getElementById("news-image-caption").textContent = "";
    document.getElementById("news-body").innerHTML = "";
    if (typeof updateMoreFromCategoryHeading === "function") {
      updateMoreFromCategoryHeading(null);
    }
    const relatedTopics = document.getElementById("related-topics-list");
    if (relatedTopics) relatedTopics.innerHTML = "";
    const alsoReadList = document.getElementById("related-news-list");
    if (alsoReadList) alsoReadList.innerHTML = "";
    return;
  }
  currentNewsCategory = news.category;
  currentNewsId = news.id;
  document.getElementById("news-category").textContent = news.category || "";
  document.getElementById("news-title").textContent = news.title || "";
  document.getElementById("news-date").textContent = news.date_posted
    ? new Date(news.date_posted).toLocaleDateString("ar-EG", {
        year: "numeric",
        month: "long",
        day: "numeric",
      })
    : "";
  if (news.image) {
    var img = document.getElementById("news-image");
    img.src = "assets/" + news.image;
    img.style.display = "";
  } else {
    document.getElementById("news-image").style.display = "none";
  }
  let caption =
    news.image_caption && news.image_caption.trim() !== ""
      ? news.image_caption
      : news.body
      ? news.body.split(/\s+/).slice(0, 10).join(" ") +
        (news.body.split(/\s+/).length > 10 ? "..." : "")
      : "";
  document.getElementById("news-image-caption").textContent = caption;
  document.getElementById("news-body").innerHTML = `<p class="text-muted">${
    news.body || ""
  }</p>`;
  if (typeof updateMoreFromCategoryHeading === "function") {
    updateMoreFromCategoryHeading(news.category);
  }
  if (currentNewsCategory) {
    fetch(
      `related_news.php?category=${encodeURIComponent(
        currentNewsCategory
      )}&exclude=${currentNewsId}`
    )
      .then((res) => res.json())
      .then((data) => {
        const relatedTopics = document.getElementById("related-topics-list");
        if (relatedTopics)
          relatedTopics.innerHTML = renderRelatedTopics(
            data,
            currentNewsCategory
          );
        const alsoReadList = document.getElementById("related-news-list");
        if (alsoReadList) {
          alsoReadList.innerHTML = renderAlsoRead(data);
        }
      })
      .catch((error) => {
        const relatedTopics = document.getElementById("related-topics-list");
        if (relatedTopics)
          relatedTopics.innerHTML =
            '<div class="col-12 text-muted">تعذر تحميل الموضوعات ذات الصلة.</div>';
        const alsoReadList = document.getElementById("related-news-list");
        if (alsoReadList)
          alsoReadList.innerHTML =
            '<li class="text-muted">تعذر تحميل الأخبار ذات الصلة.</li>';
      });
  } else {
    const relatedTopics = document.getElementById("related-topics-list");
    if (relatedTopics) relatedTopics.innerHTML = "";
    const alsoReadList = document.getElementById("related-news-list");
    if (alsoReadList) alsoReadList.innerHTML = "";
  }
}
const urlParams = new URLSearchParams(window.location.search);
const newsId = urlParams.get("id");
if (newsId) {
  fetch("details_api.php?id=" + newsId)
    .then((res) => res.json())
    .then((news) => renderMainNews(news))
    .catch(() => {
      document.getElementById("news-title").textContent =
        "تعذر تحميل الخبر من قاعدة البيانات.";
    });
}
function loadComments(newsId) {
  fetch("comments.php?news_id=" + newsId)
    .then((res) => res.text())
    .then((html) => {
      document.getElementById("comments-list").innerHTML = html;
    });
}
function setupCommentForm(newsId) {
  document.getElementById("comment-news-id").value = newsId;
  document.getElementById("comment-form").addEventListener(
    "submit",
    function (e) {
      e.preventDefault();
      const formData = new FormData(this);
      fetch("add_comment.php", {
        method: "POST",
        body: formData,
      })
        .then((res) => res.text())
        .then((result) => {
          const msg = document.getElementById("comment-message");
          if (result.trim() === "success") {
            msg.textContent = "تم إضافة التعليق بنجاح.";
            msg.className = "alert alert-success mt-2";
            this.reset();
            loadComments(newsId);
          } else {
            msg.textContent = "حدث خطأ أثناء إضافة التعليق.";
            msg.className = "alert alert-danger mt-2";
          }
        });
    },
    { once: true }
  );
}
function afterNewsLoaded(news) {
  if (news && news.id) {
    loadComments(news.id);
    setupCommentForm(news.id);
  }
}
const origRenderMainNews = renderMainNews;
renderMainNews = function (news) {
  origRenderMainNews(news);
  afterNewsLoaded(news);
};
