@php
    /** @var string $title */
    /** @var string $backgroundText */
    /** @var string $underlineText */
    /** @var string $description */
@endphp
<div class="section-head">
    <div class="back-title">{{$backgroundText}}</div>
    <h2 class="section-title banner-title">
        @php
            $title  = str($title);
            if (isset($underlineText) && $title->contains($underlineText)) {

                $title = $title->replace($underlineText,'<span class="primary-color">'. $underlineText.'                                 <svg class="title-shape" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                <path d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9"></path>
             </svg></span>');
            }
        @endphp
        {!! $title !!}
    </h2>
    @if(isset($description))
        <div class="section-disc">
            {!! $description !!}
        </div>
    @endif
</div>
