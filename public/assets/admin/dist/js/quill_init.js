import Quill from 'quill';

const editor = new Quill('#editor', {
    theme: 'snow',
    modules: {
        toolbar: [
            ['bold', 'italic', 'color']
        ]
    }
});

const form = document.querySelector('form');
form.onsubmit = function () {
    const content = document.querySelector('.ql-editor').innerHTML;
    document.getElementById('custom-text').value = content;
};
