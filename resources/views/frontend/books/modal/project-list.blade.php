<style>
    .searchable-container::-webkit-scrollbar {
        width: 0.3em;
    }

    .searchable-container::-webkit-scrollbar-track {
        /* box-shadow: inset 0 0 5px grey; */
    }

    .searchable-container::-webkit-scrollbar-thumb {
        background: #242254;
        border-radius: 10%;
    }

    .searchable-container::-webkit-scrollbar-thumb:hover {
        background: #b81242;
        border-radius: 30%;
    }
</style>

<div class="row step-third-row bg-white h-100 project-listing-loading"
    data-action="{{ route('frontend.project.api_list') }}">
    <div class="col-md-12 ">
        <div class="bg-white  ps-5 dynamic-padding" style="height:100%">
            <div class="row mb-3">
                <div class="col-md-12 mb-2">
                    <h4 class="mb-0" style="color: #03014C !important;font-weight:700;line-height:42px;font-size:34px;">
                        Select Your Project
                    </h4>
                </div>
            </div>
            <div class="row mt-1 me-5 mb-2">
                <div class="col-md-12 mb-3">
                    <input type="text" name="search_project" id="search" placeholder="Search your project"
                        class="form-control py-3 fs-5"
                        style="border: 0.8px solid rgb(3 1 76 / 12%);border-radius:8.3px;">
                </div>
            </div>
            <div class="searchable-container" style="max-height: 500px;overflow:hidden;overflow-y:scroll;">
                <div class="row mt-4 me-5">
                    <div class="col-md-12 d-flex justify-content-center">
                        <img src="{{ asset('loading.gif') }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /End project -->

<script>
    $(function() {
        $(document).on('keyup', '#search', function() {
            var pattern = $(this).val();
            $('.searchable-container .items').hide();
            $('.searchable-container .items').filter(function() {
                return $(this).text().match(new RegExp(pattern, 'i'));
            }).show();
        });
    });
    $("html, body").animate({
        scrollTop: 0
    }, "fast");
</script>
