$(function () {
    if ($('.tiny-mce').length) {
        window.setupTinyMce();
    }
})


    window.setupTinyMce = function () {
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ],
            // ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
        // tinymce.init({
        //     selector: 'textarea',
        //     plugins: ' anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount,accordion,fullscreen,quickbars,advlist',
        //     toolbar: 'undo redo fullscreen| blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight  | numlist bullist indent outdent | emoticons charmap | removeformat accordion',
        //     fullscreen_native : true,
        // });
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

