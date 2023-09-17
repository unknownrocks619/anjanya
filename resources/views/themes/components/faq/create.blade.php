<input type="hidden" name="_component_name" value="faq" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">

<div class="lc-block mb-5 original-faq-block d-none">
    <div editable="rich">
        <h4 class="h4">Duis aute irure dolor in?</h4>
        <div class="faq_description" name="">Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </div>
        <button class="btn btn-danger" onclick="removeFaq(this)" type="button">
            <i class="fa fa-trash"></i>
            Remove Faq
        </button>
    </div>
</div>

<div class="row align-items-center">
    <div class="col-md-12">
        <div class="lc-block text-center">
            <div editable="rich">
                <h2 name="title" class="component_field fw-bold tiny-mce text-dark">FAQ</h2>
            </div>
        </div>
        <div class="lc-block text-center">
            <div editable="rich" name="intro" class="tiny-mce component_field">
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu<br>fugiat nulla pariatur excepteur sint occaecat.&nbsp;<br>Static Faq<br>
            </div>
        </div>
    </div>
</div>


<div class="row mt-4">
    <div class="col-md-6 left-wrapper">
        <div class="lc-block mb-5">
            <div editable="rich">
                <h4 class="h4 component_field tiny-mce" name="faq_left_title[]">Excepteur sint occaecat cupidatat non? </h4>
                <div class="tiny-mce component_field" name="faq_left_description[]"> Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </div>
                <button class="btn btn-danger" onclick="removeFaq(this)" type="button">
                    <i class="fa fa-trash"></i>
                    Remove Faq
                </button>
            </div>
        </div>
        <button type="button" class="btn btn-secondary add_faq_points w-100">
            <i class="fa fa-plus"></i> Add More Point
        </button>
    </div>
    <div class="col-md-6 right-wrapper">
        <div class="lc-block mb-5">
            <div editable="rich">
                <h4 class="h4 component_field tiny-mce" name="faq_right_title[]">Duis aute irure dolor in?</h4>
                <div class="component_field tiny-mce" name="faq_right_description[]">Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </div>
                <button class="btn btn-danger" onclick="removeFaq(this)" type="button">
                    <i class="fa fa-trash"></i>
                    Remove Faq
                </button>
            </div>
        </div>
        <button type="button" class="btn btn-secondary add_faq_points w-100">
            <i class="fa fa-plus"></i> Add More Point
        </button>
    </div>
</div>


<script>
    $(document).on('click','button.add_faq_points', function(event) {
       let _faqContent = $('div.original-faq-block').clone();
       $(_faqContent).removeClass('original-faq-block');
       let _direction = '_left_';
       if($(this).closest('div').hasClass('right-wrapper'))  {
           _direction = '_right_';
       }
       $(_faqContent).find('h4')
           .addClass('component_field')
           .addClass('tiny-mce')
           .attr('name','faq'+_direction+'title[]');
       $(_faqContent).find('div.faq_description')
           .addClass('component_field')
           .addClass('tiny-mce')
           .attr('name','faq'+_direction+'description[]');

       $(this).before(_faqContent);
       $(_faqContent).removeClass('d-none')
    });


    function removeFaq(elm) {
        $(elm).closest('div.lc-block').remove();
    }
    window.setupTinyMceAll();
</script>
