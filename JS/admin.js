function editAd(id, text, currentImageUrl) {
  document.getElementById("ad_id_field").value = id;
  document.getElementById("ad_text_field").value = text;
  const previewDiv = document.getElementById("current_ad_image_preview");
  const fileInput = document.getElementById("ad_image_file_field");
  fileInput.value = "";
  if (currentImageUrl) {
    previewDiv.innerHTML =
      '<p class="mb-1">الصورة الحالية:</p><img src="' +
      currentImageUrl +
      "?t=" +
      new Date().getTime() +
      '" alt="Ad Image" style="max-width: 100px; max-height: 100px; display: block; margin-bottom: 5px; border:1px solid #ddd;"> <small>' +
      currentImageUrl.split("/").pop() +
      "</small>";
  } else {
    previewDiv.innerHTML = "<p>لا توجد صورة حالية.</p>";
  }
  window.location.hash = "#ads-management";
  document.getElementById("ad_text_field").focus();
}

function clearAdForm() {
  document.getElementById("ad_id_field").value = "0";
  document.getElementById("ad_text_field").value = "";
  document.getElementById("ad_image_file_field").value = "";
  document.getElementById("current_ad_image_preview").innerHTML = "";
  document.getElementById("ad_text_field").focus();
}

if (window.location.hash === "#ads-management") {
  const el = document.getElementById("ads-management");
  if (el) {
    el.scrollIntoView({ behavior: "smooth" });
  }
}
