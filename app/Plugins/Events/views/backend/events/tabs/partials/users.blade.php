@foreach ($users as $user)
    @include('Events::backend.events.tabs.partials.user',['user' => $user])
@endforeach
<div class="row my text-center">
    <div class="col-md-12 d-flex justify-content-center">
        {!! $users->onEachSide(10) !!}
    </div>
</div>
