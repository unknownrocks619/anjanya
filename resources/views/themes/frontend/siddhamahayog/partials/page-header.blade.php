<div class="row">
    <div  class="col-md-12">
        <div class="edu-breadcrumb-area breadcrumb-style-1 ptb--60 ptb_md--40 ptb_sm--40 bg-image" style="background-image: url({{$bannerImage ?? '/images/breadcrumb-bg.jpg'}})">
            <div class="container eduvibe-animated-shape">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-inner text-start">
                            <div class="page-title">
                                <h3 class="title">{{$title}}</h3>
                            </div>
                            <nav class="edu-breadcrumb-nav">
                                <ol class="edu-breadcrumb d-flex justify-content-start liststyle">
                                    @if (! isset ($breadCrumb) )
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="separator"><i class="ri-arrow-drop-right-line"></i></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                                    @elseif (is_array($breadCrumb) )
                                        @foreach( $breadCrumb as $bread_navigation)

                                            <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }} ">
                                                <a href="{{$bread_navigation['link']}}">
                                                    {{$bread_navigation['label']}}
                                                </a>
                                            </li>

                                            @if ( ! $loop->last)
                                                <li class="separator"><i class="ri-arrow-drop-right-line"></i></li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>