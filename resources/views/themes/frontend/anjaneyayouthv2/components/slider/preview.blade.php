<iframe id="slider_frame" sandbox="allow-scripts allow-same-origin"
    src="{{ route('frontend.pages.page', ['slug' => request()->get('param') ?? $slug, 'previewMode' => true]) }}"
    height="1084px" width="100%" loading='lazy' name="Background Image Preview">
</iframe>
