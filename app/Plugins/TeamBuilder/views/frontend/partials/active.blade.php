<div class="row g-5 mt--20 mt_md--30 mt_sm--0">
    @foreach($team->members ?? [] as $member)
        @include("TeamBuilder::frontend.partials.member-col",['member' => $member])
    @endforeach
</div>