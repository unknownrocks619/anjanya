import Splide from '@splidejs/splide';
import '@splidejs/splide/css/skyblue';

$(function(){
    if( $('.splide').length ) {

        $.each($('.splide'), function (index,elm) {
            console.log(JSON.parse($(elm).attr('data-config')))
            let splide = new Splide($(elm)[0],JSON.parse($(elm).attr('data-config')));
            splide.mount();
        })
    }
})