$(function () {
    if ($('.tiny-mce').length) {
        window.setupTinyMce();
    }
})


    window.setupTinyMce = function () {
        tinymce.init({
            selector: 'textarea',
            plugins: ' anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount,accordion,fullscreen,quickbars,advlist',
            toolbar: 'undo redo fullscreen| blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight  | numlist bullist indent outdent | emoticons charmap | removeformat accordion',
            fullscreen_native : true,
        });
    }

window.setupTinyMceAll = function () {
    tinymce.init({
        selector: '.tiny-mce',
        inline : true,
        // plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
        toolbar: 'undo redo | blocks | bold italic backcolor textcolor | table media image | numlist bullist ',
        imagetools_cors_hosts: ['picsum.photos'],
    })
}

