<div class="course-card">
    <div class="img">
        @if ($course->getImage->count())
            @php
                $image = $course
                    ->getImage()
                    ->latest()
                    ->first();
                $progressPercentage = $histories->count();
                
                if ($progressPercentage) {
                    $progressPercentage = ($progressPercentage / $course->lessions_count) * 100;
                }
            @endphp
            <img src='{{ \App\Classes\Helpers\Image::getImageAsSize($image->image->filepath, 's') }}' />
        @else
            <img src="assets/images/feature1.png" alt="">
        @endif
    </div>
    <div class="course-name">
        {{ $course->course_name }}
    </div>
    <div class="course-bar">
        <div class="bar-count">{{ $histories->count() }}/{{ $course->lessions_count }} Lessons</div>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%"
                aria-valuenow="{{ $histories->count() }}" aria-valuemin="0"
                aria-valuemax="{{ $course->lessions_count }}"></div>
        </div>
    </div>
    <div>
        <a href="javascript:void(0)" class="course-btn">Continue Learning</a>
    </div>
</div>
