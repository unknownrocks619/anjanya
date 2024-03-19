@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;

    $records = [];
    if ($componentValue['content_type'] == 'category') {
        $records = App\Models\Category::getPosts($componentValue['categories'],4);
    } elseif ($componentValue['content_type'] == 'post') {

    } elseif($componentValue['content_type'] == 'page' ) {

        dd($componentValue);
        /** @var array $page */

        $pageQuery = \App\Models\Page::where('active',true)->with(['getImage' => function($query) {
            return $query->with('image');
        }]);

        if (! $page['latest'] ) {
            $pages = $pageQuery->whereIn('id',$page['ids'])->get();
        } else {
            $pages = $pageQuery->orderBy('id','DESC')->limit(6)->get();
        }

    }

    $glittersBackground = null;
    $featuredBackgroundGlitter = null;
    $imageButtonSide = null;

    if ( $componentValue['glitter'] ) {
        $glittersBackground = \App\Models\GalleryAlbums::where('id',$componentValue['glitter'])
                                                        ->where('active',true)
                                                        ->with(['items' => function($query) {
                                                            $query->with(['getImage' => function($query) {
                                                                $query->with('image');
                                                            }])
                                                            ->limit('3');
                                                        }])
                                                        ->first();
        $featuredBackgroundGlitter = $glittersBackground?->items()->where('featured_background',true)->first();
        $imageButtonSide = $glittersBackground?->items()->where('featured_button',true)->first();
    }

@endphp
<!-- Start Service Area  -->
<div class="home-one-cat edu-service-area service-wrapper-1 edu-section-gap bg-image">
    <div class="container eduvibe-animated-shape">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <span class="pre-title">{{$componentValue['subtitle']}}</span>
                    <h3 class="title">{{$componentValue['title']}}</h3>
                </div>
            </div>
        </div>
        <div class="row g-5 mt--25">

            @foreach ($records as $record)
                @include('themes.frontend.siddhamahayog.components.content.type.'.$componentValue['content_type'].'-'.$componentValue['layout_type'],['record' => $record])
            @endforeach
        </div>
        <!-- Attached Component -->
        <div class="row g-5">
            <div class="col-md-12">
                <!-- Attach other component -->
                @if($componentValue['connector_component'])
                    @php
                        $attachedComponent = \App\Models\WebComponents::with('getComponents')->whereIn('id',$componentValue['connector_component'])->get();
                    @endphp
                    @foreach ($attachedComponent as $components)

                        @foreach ($components?->getComponents ?? [] as $component)
                            @php
                                $componentService = new \App\Classes\Components\Component($component->component_type);
                            @endphp
                            {!! $componentService->previewBuilder(['_loadComponentBuilder' => $component,'attachable' => true]) !!}
                        @endforeach

                    @endforeach
                @endif
            </div>
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
</div>
<!-- End Service Area  -->
