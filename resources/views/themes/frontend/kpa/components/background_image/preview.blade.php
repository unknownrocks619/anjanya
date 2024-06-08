@php
    if( ! isset ($imageOne) ) {

        $imageOne = asset('frontend/kpa/assets/images/banner/banner-14.png');
    }

    if ( ! isset ($imageTwo) ) {

        $imageTwo = asset('frontend/kpa/assets/images/banner/sm-1.png');
    }

    if ( ! isset ($imageThree) ) {

        $imageThree = asset('frontend/kpa/assets/images/banner/sm-2.png');
    }
@endphp
@extends('themes.frontend.kpa.layout.preview-layout')
@section('main')
<div id="commonComponentBuilder">
    <input type="hidden" name="_component_name" value="background_image" class="component_field  d-none">
    <input type="hidden" name="_action" value="{{$_action}}" class="component_field d-none">
    <!-- banner ten area start -->
    
    <div class="banner-tena-area banner-bg-10 bg_image rts-section-gap">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6 order-lg-1 order-md-2 order-sm-2 order-2">
                    <!-- banner inner-content ten area -->
                    <div class="banner-ten-inner-content">
                            @isset($subtitle)<span> {!! $subtitle !!} </span>@else<span>Building Business From Scratch</span>@endisset
                        <div name='heading' class="tiny-mce component_field">
                            @isset($title)<h1> {!! $title !!}</h1> @else
                                <h1 contenteditable="true" class="updateEditable" name='heading' >Unleashing Potential,
                                    <span>Redefining Success</span>
                                </h1>    
                            @endisset
                        </div>
    
                        <div  name="description" contenteditable="true"  style="font-size:var(--font-size-b2);line-height: var(--line-height-b2);color:var(--color-body);margin:0 0 40px;">
                            @isset($description)
                            {!! $description !!}
                            @else
                            We believe that every business, no matter the size or industry, deserves to thrive in today's dynamic economic landscape.
                            @endisset
                        </div>
    
                        @isset($button)
                            <a href="{{$button['link']}}" class="rts-btn btn-primary-2">{{$button['label']}}</a>
                        @endisset
                    </div>
                    <!-- banner inner-content ten area end -->
                </div>
                <div class="col-lg-6 order-lg-2 order-md-1 order-sm-1 order-1">
                    <div class="thumbnail-img-10 pt--100">                    
                        <img src="{{$imageOne}}" alt="banner">
                        <img class="small-img" src="{{$imageTwo}}" alt="small-image">
                        <img class="small-img-2" src="{{$imageThree}}" alt="small-image">
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <!-- banner ten area end -->
    @endsection
</div>
