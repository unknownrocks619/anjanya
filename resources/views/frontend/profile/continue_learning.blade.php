@if ($content && count($content))
    <div class="course-section">
        <h3>{{ __('web/dashboard.continue_learning') }}</h3>

        <div class="course-grid">
            @foreach ($content as $courseContent)
                <div class="course-card">
                    <div class="img">
                        @if ($courseContent->getCourse->getImage->count())
                            @php
                                $image = $courseContent->getCourse
                                    ->getImage()
                                    ->latest()
                                    ->first();
                                
                                $progressPercentage = $courseContent->getHistory->count();
                                
                                if ($progressPercentage) {
                                    $progressPercentage = ($progressPercentage / $courseContent->getCourse->lessions_count) * 100;
                                }
                            @endphp
                            <img src='{{ \App\Classes\Helpers\Image::getImageAsSize($image->image->filepath, 's') }}' />
                        @else
                            <img src="assets/images/feature1.png" alt="">
                        @endif
                    </div>
                    <div class="course-name">
                        {{ $courseContent->getCourse->course_name }}
                    </div>
                    <div class="course-bar">
                        <div class="bar-count">
                            {{ $courseContent->getHistory->count() }}/{{ $courseContent->getCourse->lessions_count }}
                            Lessons</div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%"
                                aria-valuenow="{{ $courseContent->getHistory->count() }}" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div>
                        <a href="/course/{{ $courseContent->getCourse->slug }}/watch" class="course-btn">Continue
                            Learning</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
