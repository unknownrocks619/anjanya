<div class="row">
    <div class="col-md-12 text-center">
        <h1>{!! htmlspecialchars_decode($values->intro_title) !!}</h1>
        <div class="text-description mb-4 vp1">
            {!! htmlspecialchars_decode($values->short_description) !!}
        </div>
        @if ($values->courses && count($values->courses))
            @include('themes.components.project_list.view.public.options.courses', [
                'courses' => $values->courses,
                'component' => $component,
                'values' => $values,
            ])
        @endif
        @if ($values->books_bundle && count($values->books_bundle))
            @include('themes.components.project_list.view.public.options.book_bundle', [
                'books_bundles' => $values->books_bundle,
                'component' => $component,
            ])
        @endif
        @if ($values->books && count($values->books))
            @include('themes.components.project_list.view.public.options.books', [
                'books' => $values->books,
                'component' => $component,
            ])
        @endif
        @if ($values->projects && count($values->projects))
            @include('themes.components.project_list.view.public.options.projects', [
                'projects' => $values->projects,
                'component' => $component,
            ])
        @endif
    </div>
</div>
