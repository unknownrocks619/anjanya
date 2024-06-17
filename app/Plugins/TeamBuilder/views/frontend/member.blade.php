@php
    $featuredImage = $menu->getImage()->where('type','banner_image')->latest()->first();

if ( ! $featuredImage ) {
    $featuredImage = $menu->getImage()->where('type','background')->latest()->first();
}
if ( $featuredImage) {
    $featuredImage = App\Classes\Helpers\Image::getImageAsSize($featuredImage->image->filepath,'m');
}else {
    $featuredImage = asset('images/breadcrumb-banner.jpeg');

}
$post = new App\Models\Post;
$post->title = $menu->menu_name
@endphp
@extends($user_theme->frontend_layout($extends))
@section("page_title"){{$menu->menu_name}}@endsection

@section('main')
    {!! $user_theme->partials('post.cover',['post' => $post]) !!}
    <!-- rts blog mlist area -->

        <!-- rts team two area -->
        <div class="rts-team-area style-3 rts-section-gap" style="padding-bottom: 90px;">
            <div class="container">
                @if($teams->where('default_group',true)->first())
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                {{$teams->where('default_group',true)->first()->name}}
                            </h4>
                        </div>
                        <div class="card-body">
                            @include("TeamBuilder::frontend.partials.active",['team' => $teams->where('default_group',true)->first()])
                        </div>
                    </div>
                @endif
                
                @foreach ($teams->where('default_group',false) as $team)
                    <button class="rts-btn btn-primary text-white my-2"
                            data-bs-target='#member_{{$team->getKey()}}'
                            data-bs-toggle='collapse'
                             aria-expanded="false" aria-controls="member_{{$team->getKey()}}"
                            >{{$team->name}}</button>
                    @if ($team->members->count())
                        <div class="row border my-4 collapse" id='member_{{$team->getKey()}}'>
                            @foreach($team->members as $member )
                                @include('TeamBuilder::frontend.partials.member-col',['member' => $member])
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <!-- rts team two area End -->
    
    
@endsection;