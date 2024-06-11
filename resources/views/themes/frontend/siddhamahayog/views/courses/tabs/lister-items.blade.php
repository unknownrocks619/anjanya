<div class="col-md-4 mb-4">
    <div class="ex-card">
        <div class="ex-img">
            @php
                $image = $course
                    ->getImage()
                    ->where('type', 'course_thumbnail')
                    ->latest()
                    ->first();

            @endphp
            <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($image?->image->filepath, 'm') }}" class="w-100"
                alt="">
        </div>
        <div class="ex-content">
            <h4>{{ $course->course_name }}</h4>
            <p>
                {!! $course->course_intro_text !!}
            </p>
            <a href="/course/{{ $course->slug }}" class="ex-btn">See More</a>
        </div>
    </div>
</div>
