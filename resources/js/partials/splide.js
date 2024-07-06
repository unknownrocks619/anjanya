import Splide from '@splidejs/splide';
import '@splidejs/splide/css/skyblue';

$(function(){
    if( $('.splide').length ) {

        $.each($('.splide'), function (index,elm) {
            if ($(elm).hasClass('no-component') ) {
                return;
            }
            let splide = new Splide($(elm)[0],JSON.parse($(elm).attr('data-config')));
            splide.mount();
        })
    }
})