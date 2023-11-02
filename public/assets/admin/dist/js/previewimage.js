function previewImages(event, previewId) {
    var preview = document.getElementById(previewId);
    preview.innerHTML = '';

    var files = event.target.files;
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.onload = function (e) {
            var image = document.createElement('img');
            image.src = e.target.result;
            image.style.maxWidth = '200px';
            image.style.margin = '10px';
            preview.appendChild(image);
        };

        reader.readAsDataURL(file);
    }
}
