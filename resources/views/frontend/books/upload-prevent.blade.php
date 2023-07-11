@extends('themes.frontend.users.auth', ['bodyAttribute' => ['id' => 'home', 'class' => 'bg-white'], 'isLanding' => true, 'isFooter' => true])

@push('title')
    :: Upload Your Book
@endpush


@section('main_content')
    <div class="container mt-5">

        <div class="row px-0 mx-auto step-parent-row mt-5 mb-4 pt-5" style="margin-bottom:50px !important">
            <!-- Row -->
            <div class="mt-4 col-md-12 pl-0 ml-0 mx-auto mt-4">
                <a href="{{ route('frontend.users.login') }}"><img
                        src="https://upschool.co/wp-content/uploads/2022/06/Drawing-Class-Banner-1024x512.png"
                        alt="upload book"
                        srcset="https://upschool.co/wp-content/uploads/2022/06/Drawing-Class-Banner-1024x512.png"
                        class="img-fluid"></a>

            </div>
        </div>
    </div>
@endsection
