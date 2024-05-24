@if($chapter->lessions()->count())
<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
    <div class="edu-accordion-body">
        <ul>
            @foreach ($chapter->lessions as $lession)
            <li>
                <div class="text"><i class="icon-draft-line"></i> {{$lession->lession_name}}</div>
                <div class="icon"><i class="icon-lock-password-line"></i></div>
            </li>
            @endforeach
            <li>
                <div class="text"><i class="icon-draft-line"></i> Course Overview</div>
                <div class="icon"><i class="icon-lock-password-line"></i></div>
            </li>
            <li>
                <div class="text"><i class="icon-draft-line"></i> Local Development Environment Tools</div>
                <div class="icon"><i class="icon-lock-password-line"></i></div>
            </li>
            <li>
                <div class="text"><i class="icon-draft-line"></i> Course Excercise</div>
                <div class="icon"><i class="icon-lock-password-line"></i></div>
            </li>
            <li>
                <div class="text"><i class="icon-draft-line"></i> Embedding PHP in HTML</div>
                <div class="icon"><i class="icon-lock-password-line"></i></div>
            </li>
            <li>
                <div class="text"><i class="icon-draft-line"></i> Using Dynamic Data</div>
                <div class="icon"><i class="icon-lock-password-line"></i></div>
            </li>
        </ul>
    </div>
</div>
@endif
