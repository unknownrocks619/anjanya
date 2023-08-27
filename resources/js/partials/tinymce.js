$(function () {
    if ($('.tiny-mce').length) {
        window.setupTinyMce();
    }
})

window.setupTinyMce = function () {
    tinymce.init({
        selector: 'textarea.tiny-mce',
        plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
        toolbar: 'undo redo | blocks | bold italic backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | removeformat | mediaembed ',
        imagetools_cors_hosts: ['picsum.photos'],
    })
}


window.setupTinyMceAll = function () {
    tinymce.init({
        selector: '.tiny-mce',
        inline : true,
        plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
        toolbar: 'undo redo | blocks | bold italic backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | removeformat | mediaembed ',
        imagetools_cors_hosts: ['picsum.photos'],
    })
}
