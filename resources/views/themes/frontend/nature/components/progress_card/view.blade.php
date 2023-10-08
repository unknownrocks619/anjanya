@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $countTotalItems = count($componentValue);
    $column = ($countTotalItems %  2 == 0) ? 12 / $countTotalItems :  (12 / ($countTotalItems+ 1));
@endphp
<div class="progress-section">
    <div class="container">
        <div class="row">
            @foreach ($componentValue as $values)
            <div class="col-md-{{$column}}">
                <div class="process-count-item secondary-bg" style="background-color:{{$values['background_colour']}}">
                           <span class="process-number" style="color:{{$values['number_colour']}}">
                              {{$loop->iteration}}.
                           </span>
                    <div class="process-content">
                        <h4>{{$values['title']}}</h4>
                        {!! $values['description'] !!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
