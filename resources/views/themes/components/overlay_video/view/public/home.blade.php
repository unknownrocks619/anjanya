<div class="row">
    <div class="col-md-12 p-0" style="position: relative;min-height:100vh;">
        <div class="row" style="position:absolute;bottom:20%;z-index:222">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="row mt-5">
                    <div class="col-md-12 text-center text-white">
                        <img src="https://upschool.co/wp-content/uploads/2022/03/Upschool-Kindbox-Launch-Presentation-9.png"
                            class="img-fluid w-25" />
                        <h1>
                            {!! $values->title !!}
                        </h1>
                    </div>
                    <div class="col-md-12 mt-3 text-center px-5 text-white d-flex justify-content-center ">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-7">

                                {!! htmlspecialchars_decode($values->description) !!}
                            </div>
                        </div>
                    </div>
                    @if (isset($values->buttons))
                        <div class="col-md-12 d-flex justify-content-center text-center">
                            @foreach ($values->buttons as $button)
                                <a href="{{ $button->link }}" class="btn btn-primary px-3 text-white">
                                    {{ $button->label }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12"
            style="
        position: absolute;
        min-height: 100%;
        width: 100%;
        background: {{ $values->overlay_color }};
        opacity: 0.64;
        z-index: 0;
    ">
        </div>
        <div
            style=" position:relative;
        width: 100%;
        height: 100%;
        opacity: 0.20;
        -moz-opacity: 20%;
        -webkit-opacity: 20%;
        z-index: 2;">
            @if ($values->video_source == 'vimeo')
                <?php
                $videoSource = \App\Classes\Helpers\Video::vimeo($values->video_url);
                ?>
                {!! \App\Classes\Helpers\Video::renderBackgroundVimeo($videoSource['id']) !!}
            @endif
        </div>
    </div>
</div>
