{{-- @dd($extends) --}}
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
        <div class="container">
            @if($bannerImage)
                <div class="row g-5">
                    <div class="col-lg-12">
                        <div class="main-image thumbnail">
                            <img class="radius-small" src="{{\App\Classes\Helpers\Image::getImageAsSize($bannerImage,'xl')}}" alt="Banner Images">
                        </div>
                    </div>
                </div>
            @endif

            <div class="row g-5">
                <div class="col-xl-8 col-lg-7">
                    <div class="course-details-content">

                        <h3 class="title mb-0">{{$course->course_name}}</h3>
                        <p class="mb-4 pb-4">{{$course->tagline}}</p>

                        <ul class="edu-course-tab nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">सारांश</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab" aria-controls="curriculum" aria-selected="false">पाठ्यक्रम</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                <div class="course-tab-content">
                                    <h5>पाठ्यक्रम विवरण</h5>
                                    {!! $course->course_full_description !!}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                                <div class="course-tab-content">
                                    <div class="edu-accordion-02" id="accordionExample1">
                                        @foreach ($course->chapters as $chapter)
                                            <div class="edu-accordion-item">
                                                <div class="edu-accordion-header" id="headingOne">
                                                    <button class="edu-accordion-button d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#chapter_container_{{$chapter->getKey()}}" aria-expanded="true" aria-controls="collapseOne">
                                                        <span>
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

                            <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                                <div class="course-tab-content">
                                    <div class="course-author-wrapper">
                                        <div class="thumbnail">
                                            <img src="assets/images/instructor/course-details/instructor-2.jpg" alt="Author Images">
                                        </div>
                                        <div class="author-content">
                                            <h6 class="title">
                                                <a href="instructor-profile.html">Leone Xaviona</a>
                                            </h6>
                                            <span class="subtitle">Digital Marketer</span>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley...</p>
                                            <ul class="social-share border-style">
                                                <li><a href="#"><i class="icon-Fb"></i></a></li>
                                                <li><a href="#"><i class="icon-linkedin"></i></a></li>
                                                <li><a href="#"><i class="icon-Pinterest"></i></a></li>
                                                <li><a href="#"><i class="icon-Twitter"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                <div class="course-tab-content">
                                    <div class="row row--30">
                                        <div class="col-lg-4">
                                            <div class="rating-box">
                                                <div class="rating-number">5.0</div>
                                                <div class="rating">
                                                    <i class="icon-Star"></i>
                                                    <i class="icon-Star"></i>
                                                    <i class="icon-Star"></i>
                                                    <i class="icon-Star"></i>
                                                    <i class="icon-Star"></i>
                                                </div>
                                                <span>(25 Review)</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="review-wrapper">

                                                <div class="single-progress-bar">
                                                    <div class="rating-text">
                                                        5 <i class="icon-Star"></i>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="rating-value">1</span>
                                                </div>

                                                <div class="single-progress-bar">
                                                    <div class="rating-text">
                                                        4 <i class="icon-Star"></i>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="rating-value">0</span>
                                                </div>

                                                <div class="single-progress-bar">
                                                    <div class="rating-text">
                                                        3 <i class="icon-Star"></i>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="rating-value">0</span>
                                                </div>

                                                <div class="single-progress-bar">
                                                    <div class="rating-text">
                                                        2 <i class="icon-Star"></i>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="rating-value">0</span>
                                                </div>

                                                <div class="single-progress-bar">
                                                    <div class="rating-text">
                                                        1 <i class="icon-Star"></i>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="rating-value">0</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-wrapper pt--40">
                                        <div class="section-title">
                                            <h5 class="mb--25">Reviews</h5>
                                        </div>
                                        <div class="edu-comment">
                                            <div class="thumbnail">
                                                <img src="assets/images/course/student-review/student-1.png" alt="Comment Images">
                                            </div>
                                            <div class="comment-content">
                                                <div class="comment-top">
                                                    <h6 class="title">Elen Saspita</h6>
                                                    <div class="rating">
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                    </div>
                                                </div>
                                                <span class="subtitle">“ Outstanding Course ”</span>
                                                <p>As Thomas pointed out, Chegg’s survey appears more like a scorecard that details obstacles and challenges that the current university undergraduate student population is going through in their universities and countries.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xl-4 col-lg-5">
                    <div class="eduvibe-sidebar course-details-sidebar">
                        <div class="inner">
                            <div class="eduvibe-widget">
                                <div class="video-area">
                                    <div class="thumbnail video-popup-wrapper">
                                        @if($courseThumbnail)
                                            <img class="radius-small w-100" src="{{ \App\Classes\Helpers\Image::getImageAsSize($courseThumbnail,'m')}}" alt="Course Images">

                                            <a href="https://www.youtube.com/watch?v={{$course->intro_video->video->id}}" class="video-play-btn position-to-top video-popup-activation">
                                                <span class="play-icon course-details-video-popup"></span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
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

            <div class="row">
                <div class="col-md-12" style="font-size: 22px !important">
                    @include('frontend.components.lister', ['model' => $course])

                </div>
            </div>
        </div>

    </div>

@endsection
