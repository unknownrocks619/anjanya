<div class="widget rounded">
    <div class="widget-header text-center">
        <h3 class="widget-title">Newsletter</h3>
        <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
    </div>
    <div class="widget-content">
        @if (\App\Models\Subscriber::count() > 1000)
            <span class="newsletter-headline text-center mb-3">Join {{ \App\Models\Subscriber::count() }} plus
                subscribers!</span>
        @endif

        <div class="mb-2">
            <div class="form-group">
                <input name="email" class="form-control w-100 text-center" placeholder="Email address…"
                    type="email">
            </div>
        </div>
        <button class="newsletter-button btn btn-default btn-full" type="button">Sign Up</button>
        <span class="newsletter-privacy text-center mt-3">By signing up, you agree to our <a href="#">Privacy
                Policy</a></span>
    </div>
</div>
