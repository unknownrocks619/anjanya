@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp

<section class="blog-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                {!! $user_theme->widget('title',[
                                            'title'=>$componentValue['title'],
                                            'underlineText' => $componentValue['underline_text'],
                                            'backgroundText'    => $componentValue['background_text'],
                                            'description'   => $componentValue['description']
                                        ]) !!}
            </div>
        </div>
        <div class="blog-inner">
            @include('themes.frontend.nature.components.content.type.'.$componentValue['content_type'],['componentValue' => $componentValue,$componentValue['content_type'] => $componentValue[$componentValue['content_type']]])
        </div>
    </div>
</section>
