@if($chapter->lessions()->count())
<div id="chapter_container_{{$chapter->getKey()}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
    <div class="edu-accordion-body">
        <div class="my-2 description">
            {!! $chapter->short_description !!}
        </div>
        <ul>
{{--            @foreach ($chapter->lessions as $lession)--}}
{{--            <li>--}}
{{--                <div class="text"><i class="icon-draft-line"></i> {{$lession->lession_name}}</div>--}}
{{--                <div class="icon"><i class="icon-lock-password-line"></i></div>--}}
{{--            </li>--}}
{{--            @endforeach--}}
        </ul>
    </div>
</div>
@endif
