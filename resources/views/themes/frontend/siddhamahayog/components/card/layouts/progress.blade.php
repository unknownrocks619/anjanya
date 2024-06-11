@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;

    $styleKey = 'background-image';
    $styleValue = 'url('.$componentValue['background_image'].')';

    if ($componentValue['background_type'] == 'colour') {
        $styleKey = 'background';
        $styleValue = $componentValue['background_colour'];
    }

    $progressTypeArrow = $componentValue['card_layout_progress'] ?? 'up';

    $glittersBackground = null;
    $featuredBackgroundGlitter = null;
    $imageButtonSide = null;
    $frontImage = null;

    if ( $componentValue['glitter_background'] ) {
        $glittersBackground = \App\Models\GalleryAlbums::where('id',$componentValue['glitter_background'])
                                                        ->where('active',true)
                                                        ->with(['items' => function($query) {
                                                            $query->with(['getImage' => function($query) {
                                                                $query->with('image');
                                                            }])
                                                            ->limit('3');
                                                        }])
                                                        ->first();
    }

    $loopCounter=1;

@endphp
<div class="eduvibe-home-five-progress edu-service-area edu-section-gap bg-image" style="{{$styleKey}} : {{$styleValue}} !important">
    <!-- Start Service Area  -->
    <div class="container eduvibe-animated-shape">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <span class="pre-title">{{$componentValue['subtitle']}}</span>
                    <h3 class="title">{{$componentValue['heading']}}</h3>
                </div>
            </div>
        </div>
        @foreach ($componentValue['data'] as $rowData)
        <div class="row g-5 mt--20">
            @foreach ($rowData as $columnData)
                <!-- Start Service Grid  -->
                <div class="service-card-single col-lg-4 col-md-{{$componentValue['column']}} col-sm-12" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <div class="service-card service-card-7
                        @if($progressTypeArrow == 'up') shape-bg-1
                        @elseif($progressTypeArrow == 'down') shape-bg-2
                        @else
                            @if(($loopCounter % 2) == 0 )
                                shape-bg-1
                            @else
                                shape-bg-2
                            @endif
                        @endif">

                        @php($loopCounter++)

                        <div class="inner">
                            <div class="icon">
                                <a href="#">
                                    <img src="{{$columnData['image']}}" />
                                </a>
                            </div>
                            <div class="content">
                                <h6 class="title"><a href="#">{{$columnData['title']}}</a></h6>
                                <div class="description">{!! $columnData['description'] !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Service Grid  -->
            @endforeach
        </div>
        @endforeach

        <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
            @if($glittersBackground)

                @php($count=1)

                @foreach ($glittersBackground->items ?? [] as $items)

                    @continue($items->featured_background)
                    @continue($items->featured_button)

                    @if($count >= 4)
                        @php ($count = 1)
                    @endif

                    <div class="shape-image shape-image-{{$count}}">
                        <img src="{{\App\Classes\Helpers\Image::getImageAsSize($items->getImage()->first()?->image->filepath,'s')}}" alt="Shape Thumb" />
                    </div>

                    @php($count++)

                @endforeach

            @endif
        </div>

    </div>
    <!-- End Service Area  -->
</div>
