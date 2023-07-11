<style>
    div,
    span {
        font-family: "Roboto" !important
    }
</style>
<div class="row bg-white validate-book" data-action="{{ route('frontend.books.validate-book', ['book' => $book]) }}">
    <div class="col-md-12">
        <div class="bg-white pt-4 mt-3 pb-3 px-2">
            <div class="row me-5 social-login-row">
                <h4 class="mb-0" style="color: #03014C !important;font-weight:700;line-height:42px;font-size:33.34px">
                    Upload Your Book!
                </h4>
            </div>
        </div>

        <div class="row  mt-3 px-2">
            <div class="col-md-10 bar mt-2 ps-0 mx-3 mt-4">
                <div class="row d-flex justicy-content-between my-2">
                    <div class="col pt-2 text-start" style="color:#242634;font-size:18px;">
                        <i class="icon fa fa-solid fa-file-pdf"></i>
                        {{-- $book->original_filename --}}
                    </div>
                    <div class="col text-end">

                        <button type="submit" class="btn btn-link data-confirm" data-confirm="Are you sure?"
                            data-action="{{ route('frontend.books.upload_user', ['book' => $book, 'current_tab' => 'destroy']) }}"
                            data-method="post"
                            style="color:#242254;font-size:17px;font-weight:400;text-decoration:none;font-family:'Inter'">
                            <i class='icon fas fal fa-minus-circle'></i>
                            Remove
                        </button>
                    </div>
                </div>
                <div class="progress w-100" style="background-color: #fff;">
                    <div class="progress-bar" style="width: 100%;" role="progressbar" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="col-md-12 mt-4 pt-2">
                <h5 class="mt-4"
                    style="color:#242254 !important;font-family:'Roboto' !important;font-size:19px; !important">
                    Checking your book for the following:
                </h5>
            </div>

            <div class="col-md-12 mt-4 pt-2">
                <div class="row">
                    <div style="font-size:24px;" class="col-md-10 'text-danger">
                        <table class="border-none _hasFirstPageBlank">
                            <tr style="font-size: 17px !important">
                                <td class="attribute">
                                    <span class="loading">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            style="margin: auto; background: rgb(255, 255, 255); display: block; shape-rendering: auto;"
                                            width="22px" height="22px" viewBox="0 0 100 100"
                                            preserveAspectRatio="xMidYMid">
                                            <path d="M10 50A40 40 0 0 0 90 50A40 42 0 0 1 10 50" fill="#242254"
                                                stroke="none">
                                                <animateTransform attributeName="transform" type="rotate"
                                                    dur="1s" repeatCount="indefinite" keyTimes="0;1"
                                                    values="0 50 51;360 50 51"></animateTransform>
                                            </path>
                                        </svg>
                                    </span>
                                </td>
                                <td class="ps-3 validation-text">
                                    Book has a blank page after the front cover and another before the back cover.
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-4 pt-2">
                <div class="row">
                    <div style="font-size:24px;" class="col-md-10">
                        <table class="border-none _hasPageEven">
                            <tr style="font-size: 17px !important">
                                <td>
                                    <span class="loading">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            style="margin: auto; background: rgb(255, 255, 255); display: block; shape-rendering: auto;"
                                            width="22px" height="22px" viewBox="0 0 100 100"
                                            preserveAspectRatio="xMidYMid">
                                            <path d="M10 50A40 40 0 0 0 90 50A40 42 0 0 1 10 50" fill="#242254"
                                                stroke="none">
                                                <animateTransform attributeName="transform" type="rotate"
                                                    dur="1s" repeatCount="indefinite" keyTimes="0;1"
                                                    values="0 50 51;360 50 51"></animateTransform>
                                            </path>
                                        </svg>
                                    </span>
                                </td>
                                <td class="ps-3 validation-text" style="font-size: 17px !important">
                                    The total number of pages in my book is an even number. (12, 14, 16, 18, 20, ...)
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-4 pt-2">
                <div class="row">
                    <div style="font-size:24px;" class="col-md-10 ">
                        <table class="border-none _hasSafeMargin">
                            <tr style="font-size: 17px !important">
                                <td>
                                    <span class="loading">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            style="margin: auto; background: rgb(255, 255, 255); display: block; shape-rendering: auto;"
                                            width="22px" height="22px" viewBox="0 0 100 100"
                                            preserveAspectRatio="xMidYMid">
                                            <path d="M10 50A40 40 0 0 0 90 50A40 42 0 0 1 10 50" fill="#242254"
                                                stroke="none">
                                                <animateTransform attributeName="transform" type="rotate"
                                                    dur="1s" repeatCount="indefinite" keyTimes="0;1"
                                                    values="0 50 51;360 50 51"></animateTransform>
                                            </path>
                                        </svg>
                                    </span>
                                </td>
                                <td class="ps-3 validation-text" style="padding-left: 0.8rem !important">My text is in
                                    the Safe Zone
                                    and not near the edges of the page</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-4 pt-2">
                <div class="row">
                    <div style="font-size:24px;" class="col-md-10">
                        <table class="border-none _bookSize ">
                            <tr style="font-size: 17px !important">
                                <td>
                                    <span class="loading">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            style="margin: auto; background: rgb(255, 255, 255); display: block; shape-rendering: auto;"
                                            width="22px" height="22px" viewBox="0 0 100 100"
                                            preserveAspectRatio="xMidYMid">
                                            <path d="M10 50A40 40 0 0 0 90 50A40 42 0 0 1 10 50" fill="#242254"
                                                stroke="none">
                                                <animateTransform attributeName="transform" type="rotate"
                                                    dur="1s" repeatCount="indefinite" keyTimes="0;1"
                                                    values="0 50 51;360 50 51"></animateTransform>
                                            </path>
                                        </svg>
                                    </span>
                                </td>
                                <td class="ps-3 validation-text" style="font-size: 17px !important">
                                    My book is A4 size (210mm x 297mm)
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- end of text. -->
            <div id="validationMessage"></div>

        </div>
    </div>
</div>
