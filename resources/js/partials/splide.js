import Splide from '@splidejs/splide';
import '@splidejs/splide/css/skyblue';

$(function(){
    if( $('.splide').length ) {
        let _width = window.innerWidth;
        let _ratioImage = _width / 2.40;
        let _imageRatio = false;
        $.each($('.splide'), function (index,elm) {


            if ($(elm).hasClass('no-component') ) {
                return;
            }
            let splide = new Splide($(elm)[0],{perPage : 1});
            splide.mount();
            
            $.each($(elm).find('.splide__slide'), function (index,imageElement) {
                if ( _imageRatio === false) {
                    _ratioImage = $(imageElement).find('img').height();
                    _imageRatio = true;
                }

                $(imageElement).find('img').css('maxHeight' ,+_ratioImage +'px ');
                $(imageElement).find('img').css('minHeight' ,+_ratioImage +'px ');
            });

        })

    }
})
