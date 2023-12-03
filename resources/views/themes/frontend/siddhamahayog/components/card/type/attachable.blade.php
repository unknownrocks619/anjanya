@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="service-item-inner">
    <div class="container">
        @php
            $data = $componentValue['data'];
        @endphp
        @foreach ($data as $rowKey => $row)
        <div class="row">
            @foreach ($row as $column_key => $column_value)
            <div class="col-sm-6 col-md-{{$componentValue['column']}}">
                <div class="service-item">
                    @if($column_value['image'])
                    <figure class="service-icon">
                        <img src="{{$column_value['image']}}" alt="{{$column_value['title']}}" loading="lazy">
                    </figure>
                    @endif
                    <div class="service-content">
                        <h4>{{$column_value['title']}}</h4>
                        {!! $column_value['description'] !!}
                        <br />
                        @if($column_value['button'])
                            <a href="{{$column_value['button']}}" class="button-round-primary">Read More</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</div>
