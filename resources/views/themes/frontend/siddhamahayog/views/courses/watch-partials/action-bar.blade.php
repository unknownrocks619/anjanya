<div class="top-bar">
    <div class="goto">
        <a href="{{ route('frontend.users.dashboard') }}">Go to Course Home <span class="iconify"
                data-icon="material-symbols:home"></span></a>
    </div>
    <div class="lesson-count">{{ $lession->getChapter->chapter_name }}</div>
    <div>
        <a href="javascript:void(0)" class="right-btn complete-lession-marker" data-method="post"
            data-action="{{ route('frontend.courses.complete', ['lession' => $lession, 'chapter' => $lession->getChapter]) }}">Complete
            Lesson</a>
    </div>
    <div class="lms-toggle lms-action-toggle">
        <span class="iconify" data-icon="ic:outline-keyboard-arrow-left"></span>
    </div>
</div>
