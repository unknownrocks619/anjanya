<div class="col-md-6 mt-2 col-lg-6 col-sm-12 col-xs-12">
    <form action="{{ route('facebook-register') }}" method="post">
        @csrf
        <button formaction="{{-- route('facebook-register') --}}" type="submit"
            class="btn btn-outline-secondary px-4 py-3 w-100  social-login">
            <img src="{{ asset('images/4.png') }}"
                style="width:25px; height: 25px;position:relative;top: -4px; left:-14px;" /> Continue with Facebook
        </button>
    </form>
</div>
