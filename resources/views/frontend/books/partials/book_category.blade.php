<style>
    .checkbox-container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .checkbox-container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #fff;
        border: 2px black solid;
    }

    /* On mouse-over, add a grey background color */
    .checkbox-container:hover input~.checkmark {
        background-color: transparent;
    }

    /* When the checkbox is checked, add a blue background */
    .checkbox-container input:checked~.checkmark {
        background-color: #242254;
    }

    /* When the checkbox is checked, add a blue background */
    .checkbox-container input:disabled~.checkmark {
        background-color: #cfcfcf;
        border-color: #cfcfcf;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .checkbox-container input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .checkbox-container .checkmark:after {
        left: 6px;
        top: 3px;
        width: 5px;
        height: 8px;
        border: solid white;
        border-width: 0 2px 2px 0;
        -webkit-transform: rotate(35deg);
        -ms-transform: rotate(35deg);
        transform: rotate(35deg);
    }

    .next {
        background: #242254;
        color: #fff;
    }

    .next:hover {
        background: #242254 !important;
        color: #fff !important;

    }

    .next:visited {
        background: #242254 !important;
    }

    .next:active {
        background: #242254 !important;
    }

    .next:disabled {
        background: #242254 !important;
    }

    .next:focus {
        background: #242254 !important;
        border-color: transparent
    }

    button:focus {
        outline: 0 !important;
    }
</style>
<div style="position: absolute; width: 100%;top:50%;z-index:1;display:none" class="loading">
    <div class="loading" style="height:100%; width:100%;display:flex;justify-content:center">
        <img src='https://upschool.co/wp-content/plugins/pdf_upload_and_sales1//asset/css/images/loader.gif' />
    </div>
</div>
<?php
$categories = \App\Models\Category::where('active', true)
    ->where('category_type', 'books')
    ->get();

if (!$book->categories) {
    $book->categories = [];
}
?>
<!-- Start Caegory -->
<div class="row step-two-row bg-white h-100 mt-5">
    <div class="col-md-12 mt-4">
        <form class="ajax-form" action="{{ route('frontend.books.upload_user', ['book' => $book]) }}" method="post">
            <div class="bg-white pt-3 ps-3" style="height:100%">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="mb-0"
                            style="color: #03014C !important;font-weight:700;line-height:42px;font-size:34px;">
                            Please select up to 5 categories
                        </h4>
                    </div>
                </div>

                <div id="cat_id_error" class="my-3 text-danger input-error response-ajax-category"></div>
                <div class="row mt-4 me-5 pt-4">
                    @foreach ($categories as $category)
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-xs-12 mb-3 d-block">
                            <div class="d-flex">
                                <label for="personal_detail_{{ $category->getKey() }}" class="checkbox-container">
                                    <input type="checkbox" @if (in_array($category->getKey(), $book->categories)) checked @endif
                                        value="{{ $category->id }}" name="cat_id[{{ $category->id }}]" class="checkmark"
                                        id="personal_detail_{{ $category->getKey() }}"
                                        style="width:24px; height:24px;" />
                                    <span class="checkmark"></span>
                                </label>
                                <div class="ms-2" style="font-family: 'Inter';font-weight:400">
                                    {{ $category->category_name }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row d-flex justify-content-between mb-4">
                    <div class="col text-start pt-3 ms-0 ps-0 d-flex justify-content-start">
                        <a href="#"
                            data-url="{{ route('frontend.books.upload_user', ['book' => $book, 'current_tab' => 'back']) }}"
                            class="step-back btn btn-link mt-2 pt-1 step-back-book-uploader"
                            style="color:#242254;font-weight:400;text-decoration:underline;font-size:18px;line-height:25.42px;font-family:'Inter'">
                            <i class=" fas fa-arrow-left"></i>
                            Go back
                        </a>
                    </div>
                    <div class="col mt-3 text-right d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary next py-3 px-5">
                            Next
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
