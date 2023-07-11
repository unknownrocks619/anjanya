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

<div class="row step-third-row bg-white h-100">
    <div class="col-md-12 mt-4">
        <div class="bg-white pt-3 ps-5 dynamic-padding" style="height:100%">
            <div class="row mb-3">
                <div class="col-md-12 mb-2">
                    <h4 class="mb-0" style="color: #03014C !important;font-weight:700;line-height:42px;font-size:34px;">
                        Select Your Project
                    </h4>
                </div>
            </div>
            <div class="row mt-4 me-5 mb-2">
                <div class="col-md-12 mb-3">
                    <input type="text" name="search_project" id="search" placeholder="Search your project"
                        class="form-control py-3 fs-5"
                        style="border: 0.8px solid rgb(3 1 76 / 12%);border-radius:8.3px;">
                </div>
            </div>
            <div class="searchable-container" style="max-height: 500px;overflow:hidden;overflow-y:scroll;">
                <div class="row mt-4 me-5">
                    <?php
                    $projects = \App\Models\Project::where('active', true)
                        ->with(['organisation', 'getImage'])
                        ->get();
                    ?>
                    @foreach ($projects as $project)
                        <div class="col-md-4 items">
                            <div class="card my-3" style="box-shadow: none">
                                @php
                                    $image = $project
                                        ->getImage()
                                        ->where('type', 'featured_image')
                                        ->latest()
                                        ->first();
                                    
                                    if (!$image) {
                                        $image = $project
                                            ->getImage()
                                            ->latest()
                                            ->first();
                                    }
                                    
                                    if (!$image) {
                                        $src = asset('missing-image.png');
                                    } else {
                                        $src = \App\Classes\Helpers\Image::getImageAsSize($image->image->filepath, 'm');
                                    }
                                @endphp
                                <img src="{{ $src }}" class="img-fluid responsive-img" />
                                <h1 class="mt-3 px-3 text-cemter"
                                    style="max-height:40px; overflow:hidden ;font-size:16px;color:#242254;line-height:1.3em;text-decoration:none;font-family:'Inter';font-weight:600">
                                    {{ substr($project->title, 0, 40) }}...
                                </h1>
                                <div class="mt-1  text-center"
                                    style="font-size:16px; color:#242254;font-family:'Inter'">
                                    {{ $project->organisation?->organisation_name ?? '' }}
                                </div>
                                <div class="card-footer bg-white mt-3 border-0">
                                    <form class="ajax-form"
                                        action="{{ route('frontend.books.upload_user', ['book' => $book]) }}"
                                        method="post">
                                        <input type="hidden" name="project" value="{{ $project->getKey() }}">
                                        <button type="submit" class="w-100 btn btn-primary rounded-3 py-2"
                                            style="background:#b81242;border:none !important">
                                            Select Project
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row pt-2 text-right me-5 mb-3">
                <div class="col text-start pt-1">
                    <a href="#"
                        data-url="{{ route('frontend.books.upload_user', ['book' => $book, 'current_tab' => 'back']) }}"
                        class="step-back btn btn-link mt-2 pt-1 step-back-book-uploader"
                        style="color:#242254;font-weight:400;text-decoration:underline;font-size:18px;line-height:25.42px;font-family:'Inter'">
                        <i class=" fas fa-arrow-left"></i>
                        Go back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /End project -->

<script>
    $(function() {
        $('#search').on('keyup', function() {
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
