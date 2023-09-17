<!-- Icon Block -->
@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="row mt-2">
    @foreach ($componentValue['items'] as $bullet_column)
    <div class="col-md-{{$componentValue['total_column']}}">
        <h6>{{$bullet_column['title']}}</h6>
        <ul class="list-unstyled page-list mb-30">
            <li>
                <div class="page-list-icon"> <span class="ti-check"></span> </div>
                <div class="page-list-text">
                    <p>Check-in from 9:00 AM - anytime</p>
                </div>
            </li>
            <li>
                <div class="page-list-icon"> <span class="ti-check"></span> </div>
                <div class="page-list-text">
                    <p>Early check-in subject to availability</p>
                </div>
            </li>
        </ul>
    </div>
    @endforeach
</div>
