@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<section class="about-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-about-left about-image-wrap d-flex flex-wrap">
                    <div class="home-about-image left-image">
                        <img src="{{$componentValue['first_image']}}" alt="">
                    </div>
                    <div class="home-about-image right-image">
                        <img src="{{$componentValue['second_image']}}" alt="">
                    </div>
                    <div class="home-about-image bottom-image">
                        <img src="{{$componentValue['third_image']}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
    <div class="section-about-right">
        <div class="section-about-content">
            <div class="section-head">
                <div class="back-title">{{$componentValue['subtitle']}}</div>
                <h2 class="section-title">
                    @php
                        $title = $componentValue['heading'];
                        $explode_title = explode(' ', $title);
                        $last_string = $explode_title[count($explode_title)-1];
                        $final_concat = '<span class="primary-color">' . $last_string .'
                                        <svg class="title-shape" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                                        <path d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9"></path>
                                        </svg>
                                    </span>
                                    ';
                        $final_title = str_replace($last_string,$final_concat,$title);
                    @endphp
                    {!! $final_title !!}
                </h2>
                <div class="section-disc">
                    {!! $componentValue['description'] !!}
                </div>
            </div>
            <div class="about-list">
                <ul>
                    <li>Praesentium voluptatum dolores, vulputate.</li>
                    <li>Cillum nullam rem volutpat earum.</li>
                    <li>Odio doloribus lacus quaerat assumenda.</li>
                    <li>Natoque, cubilia eos ipsa, vehicula.</li>
                    <li>Cillum nullam rem volutpat earum.</li>
                </ul>

            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</section>
