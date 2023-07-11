<div class="left-aside" id="left-aside">
    <?php
    $chapters->loadCount('totalCompleted');
    ?>
    <div class="list">
        <span class="iconify" data-icon="material-symbols:menu-book"></span> Lesson List
        <div class="cl-btn lms-action-toggle" onclick="clClose()"><span class="iconify" data-icon="ic:round-close"></span>
        </div>
    </div>
    @foreach ($chapters as $chapter)
        <div class="counter">
            <div class="name">{{ $chapter->chapter_name }}</div>
            <div class="count">{{ $chapter->total_completed_count }}/{{ $chapter->lessions()->count() }}</div>
        </div>
        @if ($chapter->lessions()->count())
            <ul>
                @foreach ($chapter->lessions as $lessions)
                    <li>
                        <a href="{{ route('frontend.courses.course_switch', ['course_slug' => $course->slug, 'lession' => $lessions, 'chapter' => $chapter, 'course' => $course]) }}"
                            class="lms-link lms-lession-navigation @if ($lessions->getKey() == $lession->getKey()) active @endif">
                            <div class="learn">
                                <span class="iconify" data-icon="mdi:file-document-outline"></span>
                                {{ $lessions->lession_name }}
                            </div>
                            <div class="dot"></div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    @endforeach
</div>
