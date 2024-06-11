
$(()=>{
    ClassicEditor.create(document.querySelectorAll('.tiny-mce'))
                .catch(error => {
                    console.error('error on ', error);
                })
})