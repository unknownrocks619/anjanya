@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="px-2 py-2 my-3 text-dark">
    <div class="component-container">

        <div class="row mt-2 bg-white">
            @if($componentValue['heading'])
                <div class="section-header">
                    <h3 class="section-title">{{$componentValue['heading']}}</h3>
                    <img src="{{asset('images/wave.svg')}}" class="wave" alt="wave" />
                </div>
            @endif
            @php
                $data = $componentValue['data'];
            @endphp
            <div class="col-md-12">
                @foreach ($data as $rowKey => $row)
                    <div class="row mt-2">
                        @foreach ($row as $column_key => $column_value)
                            <div class="col-md-{{$componentValue['column']}} my-1">
                                <div class="contact-item bordered rounded d-flex align-items-center">
                                    <img src="{{$column_value['image']}}" style="max-width:100px; max-height:100px;" class="img-thumbnail img-fluid border-0 px-0 mx-0">
                                    <div class="details">
                                        <h2 class="mb-0 mt-0">{{$column_value['title']}}</h2>
                                        <div class="mb-0">
                                            {!! $column_value['description'] !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
