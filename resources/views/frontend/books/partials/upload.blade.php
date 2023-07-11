<div class="row step-zero-row main bg-white py-3 h-100">
    <div class="col-md-12">
        <div class="bg-white pt-4 mt-3 pb-3 ps-4 ">
            <div class="row me-5 social-login-row">
                <h4 class="mb-0" style="color: #03014C !important;font-weight:700;line-height:42px;font-size:33.34px">
                    Upload Your Book!
                </h4>
            </div>
        </div>

        <div class="row ps-3 pe-5">
            <div class="col-md-12">
                <div class="card border-0" style="border-radius: 24px;box-shadow:none">
                    <div class="card-header border-0 bg-white text-center px-5 py-3">
                        <a href='https://upschool.co/wp-content/uploads/2022/08/Authors-Checklist.png'
                            data-lightbox="Book Upload Checklist" class="btn btn-danger w-100 py-3 border border-dark"
                            style="background:#D61A5F;border-radius: 50px;font-family:'Inter';font-size:20px;box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                            View Book Upload Checklist
                        </a>
                    </div>
                    <div class="card-body bg-light rounded-0">
                        <div class="row">
                            <div class="col-md-12 px-1">
                                <form action="{{ route('frontend.books.upload_user') }}" class="dropzone w-100"
                                    id="book-upload-dropzone">
                                    <div class="dz-message">
                                        <div class="row">
                                            <div class="col-md-12"><img
                                                    src="https://upschool.co/wp-content/plugins/pdf_upload_and_sales1/asset/css/images/uploder-icon.png"
                                                    class="img-fluid" /></div>
                                            <div class="col-md-12 ajax-response-error d-none">
                                            </div>
                                            <div class="col-md-12 mt-4 pt-4">
                                                <p>
                                                    Max 100 MB per File
                                                    <br />
                                                    Support File Type: PDF
                                                </p>
                                            </div>
                                            <div class="col-md-12 mt-4 pt-4">
                                                <a href="#" class="btn btn-primary "
                                                    style="background:#242254">Drag or Click to Upload
                                                    File</a>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="file" name="file" id="file" class="form-control d-none">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2 mt-5 text-right me-5">
                <div class="col-md-12 mt-5 text-right d-flex justify-content-end">
                    {{-- <button class="btn next py-3 px-5 step-back disabled" data-step="0">
                    Next
                    <i class="fas fa-arrow-right"></i>
                </button> --}}
                </div>
            </div>
        </div>

    </div>
</div>
