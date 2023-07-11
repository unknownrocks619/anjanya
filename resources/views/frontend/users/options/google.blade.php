<div class="col-md-12 ">
    <form action="{{-- route('google-register') --}}" method="post">
        @csrf
        <button formaction="{{ route('google-register') }}" type="submit"
            class="btn btn-outline-secondary px-4 py-3 social-login w-100">
            <img src="{{ asset('images/3.png') }}"
                style="width:25px; height: 25px;position:relative;top: -4px; left:-14px;" />
            Continue With Google
        </button>
    </form>
</div>

<div class="row me-5">
    <div class="col-md-12 mb-3 mt-4 ms-1">
        <div class="border-bottom"></div>
    </div>
</div>
