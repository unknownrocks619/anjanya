@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;

    $records = [];
    if ($componentValue['content_type'] == 'category') {
        $records = App\Models\Category::getPosts($componentValue['categories']);

    } elseif ($componentValue['content_type'] == 'post') {

        $post = $componentValue['post'];
        $postQuery = \App\Models\Post::where('status','active')->with(['getImage' => function($query) {
            return $query->with('image');
        }]);

        if (! $post['latest'] ) {
            $records = $postQuery->whereIn('id',$post['ids'])->get();
        } else {
            $records = $postQuery->orderBy('id','DESC')->limit(6)->get();
        }

    } elseif($componentValue['content_type'] == 'page' ) {

        $page = $componentValue['page'];
        $pageQuery = \App\Models\Page::where('active',true)->with(['getImage' => function($query) {
            return $query->with('image');
        }]);

        if (! $page['latest'] ) {
            $records = $pageQuery->whereIn('id',$page['ids'])->get();
        } else {
            $records = $pageQuery->orderBy('id','DESC')->limit(6)->get();
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
<div class="edu-course-area eduvibe-home-two-course course-three-wrapper edu-section-gap bg-color-white">
    <div class="container eduvibe-animated-shape">
        <div class="row g-5 align-items-center mb--30">
            <div class="col-lg-6">
                <div class="section-title text-start" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <span class="pre-title">{{$componentValue['subtitle']}}</span>
                    <h3 class="title">{{$componentValue['title']}}</h3>
                </div>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-12">
                <div class="grid-metro3 mesonry-list">
                    <div class="resizer"></div>
                    @foreach ($records as $record)

                        @include('themes.frontend.siddhamahayog.components.content.type.'.$componentValue['content_type'].'-'.$componentValue['layout_type'],['record' => $record])

                    @endforeach
                </div>
            </div>
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
