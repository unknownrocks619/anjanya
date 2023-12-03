<!-- End Search Popup  -->
<div class="edu-breadcrumb-area breadcrumb-style-1 ptb--60 ptb_md--40 ptb_sm--40 bg-image" style="background-image: url({{$bannerImage ?? '/images/breadcrumb-bg.jpg'}})">
    <div class="container eduvibe-animated-shape">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner text-start">
                    <div class="page-title">
                        <h3 class="title">{{$title}}</h3>
                    </div>
                    <nav class="edu-breadcrumb-nav">
                        <ol class="edu-breadcrumb d-flex justify-content-start liststyle">
                            @if (! isset ($breadCrumb) )
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="separator"><i class="ri-arrow-drop-right-line"></i></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                            @elseif (is_array($breadCrumb) )
                                @foreach( $breadCrumb as $bread_navigation)

                                    <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }} ">
                                        <a href="{{$bread_navigation['link']}}">
                                            {{$bread_navigation['label']}}
                                        </a>
                                    </li>

                                    @if ( ! $loop->last)
                                        <li class="separator"><i class="ri-arrow-drop-right-line"></i></li>
                                    @endif
                                @endforeach
                            @endif
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if(isset($glittersBackground) && $glittersBackground->items->count())
            <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
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
            </div>
        @else
            <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
                <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
                    <div class="shape-image shape-image-1">
                        <img src="{{asset ('images/shape-bg/shape-11-07.png')}}" alt="Shape Thumb" />
                    </div>
                    <div class="shape-image shape-image-2">
                        <img src="{{asset ('images/shape-bg/shape-01-02.png')}}" alt="Shape Thumb" />
                    </div>
                    <div class="shape-image shape-image-3">
                        <img src="{{asset ('images/shape-bg/shape-03.png')}}" alt="Shape Thumb" />
                    </div>
                    <div class="shape-image shape-image-4">
                        <img src="{{asset ('images/shape-bg/shape-13-12.png')}}" alt="Shape Thumb" />
                    </div>
                    <div class="shape-image shape-image-5">
                        <img src="{{asset ('images/shape-bg/shape-36.png')}}" alt="Shape Thumb" />
                    </div>
                    <div class="shape-image shape-image-6">
                        <img src="{{asset ('images/shape-bg/shape-05-07.png')}}" alt="Shape Thumb" />
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
