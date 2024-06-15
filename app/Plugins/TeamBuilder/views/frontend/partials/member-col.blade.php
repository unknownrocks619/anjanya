@php
    $image = \App\Classes\Helpers\SystemSetting::logo();
    if ($member->getImage()->count() ) {
        $imageRelation = $member->getImage()->first();

        if ($imageRelation->image) {
            $image =    App\Classes\Helpers\Image::getImageAsSize($imageRelation->image->filepath,'m');
        }
    }
@endphp
<div class="col-lg-3 col-md-6 col-sm-12 col-12">
    <div class="team-inner-two inner">
        <div class="thumbnail">
            <a href="#">
                <img src="{{$image}}" alt="{{$member->name}}" style="max-height: 300px; max-width:300px;overflow:hidden">
            </a>
            @if($member->facebook && $member->instagram)
                <div class="social">
                    @if($member->facebook)
                        <a href="{{$member->facebook}}"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if($member->youtube)
                        <a href="{{$member->youtube}}"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if($member->instagram)
                        <a href="{{$member->instagram}}"><i class="fab fa-instagram"></i></a>
                    @endif
                </div>
            @endif
        </div>
        <!-- Acquaintance area -->
        <div class="inner-content">
            <div class="header">
                <h5 class="title">{{$member->name}}</h5>
                <span>{{$member->position}}</span>
            </div>
        </div>
        <!-- Acquaintance area -->
    </div>
</div>
