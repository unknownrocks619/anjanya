@foreach ($posts as $post)
    {!! $user_theme->partials('post.detail-card', ['post' => $post, 'card_size' => $values->card_size]) !!}
@endforeach
