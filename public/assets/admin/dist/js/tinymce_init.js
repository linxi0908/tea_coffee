import tinymce from 'tinymce';

document.addEventListener("DOMContentLoaded", function () {
    tinymce.init({
        selector: "#custom-text",
        toolbar: "bold italic forecolor",
        plugins: "advlist autolink lists link image charmap print preview anchor",
        height: 300,
        menubar: false,
        setup: function (editor) {
            editor.on('change', function () {
                editor.save(); // Lưu nội dung thay đổi vào trường dữ liệu textarea
            });
        }
    });
});

