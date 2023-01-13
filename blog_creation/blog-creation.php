<?php

use Model\Blog;
use Model\Picture;

require_once('../model/Blog.php');
require_once('../model/Picture.php');

if (isset($_COOKIE['user'])) {
    $userId = $_COOKIE['user'];
} else {
    http_response_code(404);
    include('../error_page/my_404.php');
    die();
}

require "../components/head.php";
require "../components/header.php";
?>

<link href="https://cdn.jsdelivr.net/npm/froala-editor@3.1.1/css/froala_editor.pkgd.min.css"
      rel="stylesheet" type="text/css"/>
<script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/froala-editor@3.1.1/js/froala_editor.pkgd.min.js"></script>

<div class="editor-wrapper">
  <div id="editor"></div>
</div>

<form id="submit-form" method="POST" action="<?php echo $GLOBALS['dir'] ?>/model/create_blog.php">
  <label for="title">Title:</label>
  <input type="text" id="title" name="title" required>
  <label for="categories">Categories:</label>
  <input type="text" id="categories" name="categories" required>
  <label for="image">Image:</label>
  <input type="file" id="image" name="image">
  <textarea id="imageData" name="imageData" style="display: none;"></textarea>
  <textarea id="fileName" name="fileName" style="display: none;"></textarea>
  <textarea id="html-content" name="html-content" style="display:none;"></textarea>
  <button type="submit" id="submit-button">Submit</button>
</form>

</body>
</html>


<script>
  // Get the Froala editor instance
  const editor = new FroalaEditor('#editor', {
    heightMin: 400,
    heightMax: 500,
    width: '100%'
  });

  document.getElementById('image').addEventListener("change", function () {
    let fileInput = document.getElementById('image');
    let file = fileInput.files[0];

    let fileName = document.getElementById('fileName');
    fileName.value = file.name;

    console.log(fileName.value);

    let reader = new FileReader();
    reader.readAsDataURL(file);

    reader.onloadend = function () {
      if (reader.readyState === FileReader.DONE) {
        let imageBase64 = reader.result;
        if (imageBase64) {
          console.log("LOADED IMAGE")
          let index = imageBase64.indexOf(',');
          let decodedString = imageBase64.slice(index + 1);
          console.log(decodedString);

          let imageData = document.getElementById('imageData');
          imageData.value = decodedString;
        } else {
          alert("There was an error reading the image. Please try again.");
        }
      }
    }
  });

  const form = document.getElementById('submit-form');

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    // Check if image has been uploaded
    const imageData = document.getElementById('imageData').value;
    if (imageData === '') {
      alert("Upload image!");
    } else {
      console.log("SUBMITTED");
      document.getElementById('html-content').value = editor.html.get();
      const htmlData = document.getElementById('html-content').value;

      if (htmlData === '') {
        alert("Enter text in editor!");
      } else {
        form.submit();
      }
    }
  });
</script>

