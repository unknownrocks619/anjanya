{{-- @dd($extends)--}}
@extends($user_theme->frontend_layout($extends))
{{-- @extends('', ['bodyAttribute' => ['class' => 'bg-white'], 'isLanding' => true, 'isFooter' => true]) --}}

@push('title')
    | {{ $course->course_name }}
@endpush

@section('main')
    <?php
    // let's get banner image,
    $bannerImage = '';
    $courseThumbnail = '';
    $checkImage = $course->getImage;
    if ($checkImage) {
        $bannerImage = $course
            ->getImage()
            ->where('type', 'banner')
            ->latest()
            ->first();
        $bannerImage = $bannerImage?->image->filepath;

        $courseThumbnail = $course
            ->getImage()
            ->where('type', 'course_thumbnail')
            ->latest()
            ->first();
        $courseThumbnail = $courseThumbnail?->image->filepath;
    }
    ?>
    {!! $user_theme->partials('page-header',['bannerImage' => null,'title' => $course->course_name,'glitter_background' => null]) !!}
    <div class="edu-course-details-area edu-section-gap bg-color-white">
        <div class="container-lg container-md container-fluid">
            @if($bannerImage)
                <div class="row g-5 mb-5">
                    <div class="col-lg-12">
                        <div class="main-image thumbnail">
                            <img class="radius-small" src="{{\App\Classes\Helpers\Image::getImageAsSize($bannerImage,'xl')}}" alt="Banner Images">
                        </div>
                    </div>
                </div>
            @endif

            <div class="row g-5 course-container" style="position:relative;">
                <div class="col-xl-8 col-lg-7">
                    <div class="course-details-content">
                        <h3 class="title mb-0">{{$course->course_name}}</h3>
                        @if($course->tagline)
                            <p class="mb-2 pb-2">{{$course->tagline}}</p>
                        @endif
                        <div class="row div col-md-12">
                            <div class="card">
                                <div class="card-body border" style="font-size: 14pt !important;">
                                    {!! $course->course_full_description !!}
                                </div>
                            </div>
                        </div>
                        <div class="row my-2 mt-4">
                            <div class="col-md-12">
                                <div class="card border">
                                    <div class="card-header  bg-danger text-white"  style="cursor: pointer">
                                        <h4 class="card-title">पाठ्यक्रम</h4>
                                    </div>
                                    <div class="card-body p-0 pb-2">
                                        <div class="edu-accordion-02" id="accordionExample1">
                                            @foreach ($course->chapters as $chapter)
                                                <div class="edu-accordion-item border mt-2">
                                                    <div class="edu-accordion-header" id="headingOne">
                                                        <button class="edu-accordion-button d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#chapter_container_{{$chapter->getKey()}}" aria-expanded="true" aria-controls="collapseOne">
                                                    <span class="text-primary" style="color: #f4431f !important;">
                                                    {{$chapter->chapter_name}}
                                                    </span>

                                                            <span class="me-3 pe-3 text-muted">
                                                        जम्मा पाठ संख्या: ({{$chapter->total_lesson ?? $chapter->lessions()->count()}})
                                                    </span>
                                                        </button>
                                                    </div>
                                                    @include('themes.frontend.siddhamahayog.views.courses.partials.lessions',['chapter' => $chapter])
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-5 d-none d-lg-block d-md-block">
                    <div class="eduvibe-sidebar course-details-sidebar">
                        <div class="inner">
                            <div class="eduvibe-widget">
                                @if($courseThumbnail)
                                    <div class="video-area">
                                        <div class="thumbnail video-popup-wrapper">
                                            <img class="radius-small w-100" src="{{ \App\Classes\Helpers\Image::getImageAsSize($courseThumbnail,'m')}}" alt="Course Images">

                                            <a href="https://www.youtube.com/watch?v={{$course->intro_video->video->id}}" class="video-play-btn position-to-top video-popup-activation">
                                                <span class="play-icon course-details-video-popup"></span>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                <div class="eduvibe-widget-details mt--35">
                                    <div class="widget-content">
                                        <ul>
                                            <li><span><i class="icon-draft-line"></i> शिक्षण स्थल</span><span> {{$course->course_type}}</span></li>

                                            <li><span><i class="icon-draft-line"></i> लेक्चरहरू</span><span>{{$coure->total_lecture ?? $course->chapters->count()}}</span></li>

                                            <li><span><i class="icon-translate"></i> भाषा</span><span>{{$course->language}}</span></li>

                                            <li><span><i class="icon-award-line"></i> प्रमाणपत्र</span><span>{{$course->certification}}</span></li>


                                            <li><span><i class="icon-calendar-2-line"></i> अवधि</span><span> {{$course->duration}}</span></li>

                                        </ul>

                                        <div class="read-more-btn mt--15">
                                            <a class="edu-btn w-100 text-center" href="{{route('frontend.courses.enroll.enroll',['course' => $course,'course_slug' => $course->slug])}}">फाराम भर्नुहाेस</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row component-wrapper">
                <div class="col-md-12" style="font-size: 22px !important">
                    @include('frontend.components.lister', ['model' => $course])

                </div>
            </div>

        </div>
    </div>
@endsection

@push('addition_footer')
    <div class="border d-block d-md-none d-lg-none container-fluid" style="position:fixed;bottom: 0px ;background:#fff;z-index:9999999;min-height:75px;box-shadow:0px -3px 5px #9c9c9c">
        <div class="d-flex justify-content-between align-items-center mt-4">
            <h5 class="mt-4">
                {{$course->course_name}}
            </h5>
            <a class="edu-btn" style="line-height: 35px;height:40px;" href="{{route('frontend.courses.enroll.enroll',['course' => $course,'course_slug' => $course->slug])}}">
                फाराम भर्नुहाेस
            </a>

        </div>
    </div>
@endpush
@push('page_setting')
    <style type="text/css">
        .course-details-content p span {
            font-size: 14pt !important;
        }
    </style>
@endpush
@push('page_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sticky-sidebar/3.3.1/sticky-sidebar.min.js" integrity="sha512-iVhJqV0j477IrAkkzsn/tVJWXYsEqAj4PSS7AG+z1F7eD6uLKQxYBg09x13viaJ1Z5yYhlpyx0zLAUUErdHM6A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(()=>{

            var sidebar = new StickySidebar('.eduvibe-widget', {
                containerSelector: '.course-container',
                innerWrapperSelector: '.sidebar__inner',
                topSpacing: 20,
                bottomSpacing: 20
            });
        })
    </script>
@endpush
