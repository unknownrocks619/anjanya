import Splide from '@splidejs/splide';
import '@splidejs/splide/css/skyblue';

$(function(){
    if( $('.splide').length ) {
        console.log('gg');
        $.each($('.splide'), function (index,elm) {
            if ($(elm).hasClass('no-component') ) {
                return;
            }
            let splide = new Splide($(elm)[0],{perPage : 1});
            splide.mount();
        })
    }
})
