@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class=" container px-2 py-2 text-dark">
    <div class="component-container">

        <div class="row mt-2 ">
            @if($componentValue['heading'])
                <div class="col-md-12 text-center">

                    <div class="section-header">
                        <div class="lc-block text-start">
                            @if($componentValue['subtitle'])
                                <span editable="inline"
                                      class="small mt-4 d-block">{{$componentValue['subtitle']}}</span>
                            @endif
                            <h2 editable="inline" class="display-2 mb-0 section-title"><b>{{$componentValue['heading']}}</b></h2>
                                <img src="{{asset('images/wave.svg')}}" class="wave" alt="wave" />

                        </div><!-- /lc-block --></div>
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
                                <div class="p-lg-5 p-4 shadow">
                                    <div class="lc-block mb-4">
                                        <img alt="" class="img-fluid" src="{{$column_value['image']}}" style="height:10vh">
                                        <h4 class="my-3">{{$column_value['title']}}</h4>
                                        <div>{!! $column_value['description'] !!}</div>
                                    </div><!-- /lc-block -->
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
