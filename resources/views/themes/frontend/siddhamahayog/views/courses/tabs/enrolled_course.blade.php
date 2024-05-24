<div class="tab-pane fade @if ($tab_key == $current_tab) show active @endif" id="nav-{{ $tab_key }}"
    role="tabpanel" aria-labelledby="nav-{{ $tab_key }}-tab" tabindex="0">
    <div class="course-section">
        <div class="course-grid">
            @foreach ($$tab_key as $ecourse)
                @php
                    $course = $ecourse->getCourse;
                    $histories = $ecourse->getHistory;
                @endphp
                @include('frontend.courses.tabs.profile-lister', [
                    'course' => $course,
                    'histories' => $histories,
                ])
            @endforeach
        </div>
    </div>
</div>
