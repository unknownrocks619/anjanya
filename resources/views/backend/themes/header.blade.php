@extends('themes.admin.master')
@push('page_title')
    Header
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        Select Default Header
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <form action="{{route('admin.themes.header.list')}}" class="ajax-form" method="post">
            <div class="row">
                @foreach ($configurations as $configuration)
                    <div class="card">
                            <div class="card-body">
                                <div class="col-md-12 d-flex">

                                    <h4>
                                        {{$configuration['name']}}
                                    </h4>
                                    <img class="w-75"
                                         src="{{asset('frontend/'.$configuration['themename'].'/header/'.$configuration['namespace'].'/'.$configuration['screenshot'])}}"
                                         style="max-height:175px;"/>
                                    <div class="form-check radio radio-warning">
                                        <input
                                            @if($setting?->additional_text['name'] == $configuration['namespace']) checked
                                            @endif  class="form-check-input" id="defaultHeader_{{str($configuration['namespace'])->slug('_')}}" type="radio"
                                            name="header" value="{{$configuration['namespace']}}"
                                            data-bs-original-title="" title="">
                                        <label class="form-check-label" for="defaultHeader_{{str($configuration['namespace'])->slug('_')}}"> Make Default</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12 text-end">
                    <button class="btn btn-primary">
                        Save Setting
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

