<div class="row step-one-row bg-white py-3">
    <form action="{{ route('frontend.books.upload_user', ['book' => $book]) }}" class="ajax-form" method="post">
        <div class="col-md-12">
            <div class="bg-white pt-3 mt-4 ps-3 ">
                <h4 class="mb-0" style="color: #03014C !important;font-weight:700;line-height:42px;font-size:28px;">
                    About Your Book
                </h4>
                <div class="row mt-5 pe-5 me-1">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input value="{{ $book->book_title }}" type="text" name="book_title" id="book_title"
                                placeholder="Book Title" class="form-control py-3 fs-5"
                                style="border: 0.8px solid rgb(3 1 76 / 12%);border-radius:8.3px;">
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="form-group">
                            <textarea name="book_description" id="book_description" cols="30" rows="6" class="form-control py-3 fs-5"
                                placeholder="Book Description" style="border: 0.8px solid rgb(3 1 76 / 12%);border-radius: 8.3px;resize:none">{{ $book->full_description }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="form-group">
                            <input value="{{ $book->canva_link }}" type="text" name="canva_book" id="canva_book"
                                placeholder="Canva Book Link" class="form-control py-3 fs-5"
                                style="border: 0.8px solid rgb(3 1 76 / 12%);border-radius:8.3px;">
                        </div>
                    </div>
                    <div class="col-md-12 my-2 ps-4 mt-2">
                        <a href="#" data-bs-toggle='modal' data-bs-target='#canvaTarget'
                            style="color:#03014C;font-style:normal;text-decoration: underline;font-size:18.34px;">View
                            how to get the link from Canva</a>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <input type="email"
                                value="{{ $book->parent_email ??auth()->guard('web')->user()->parent_email }}"
                                name="parent_email" id="parent_email"
                                placeholder="Parent/Guardian/Teacher email address" class="form-control py-3 fs-5"
                                style="border: 0.8px solid rgb(3 1 76 / 12%);border-radius:8.3px;">
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-between mb-4">
                    <div class="col-5 text-start pt-4 mt-3 ms-0 ps-0 d-flex justify-content-start">

                    </div>
                    <div class="col mt-3 text-right d-flex justify-content-end pt-4 me-5 pe-4">
                        <button type="submit" class="btn btn-primary next py-3 px-5">
                            Next
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
