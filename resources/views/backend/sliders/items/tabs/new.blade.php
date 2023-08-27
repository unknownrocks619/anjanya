<div class="md-sidebar job-sidebar"><a class="btn btn-primary md-sidebar-toggle" href="javascript:void(0)">file
        filter</a>
    <div class="md-sidebar-aside custom-scrollbar">
        <div class="file-sidebar">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Drag and Drop Your Slider Images
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-col-md-12">
                            <form action="{{ route('admin.slider.items.upload', ['album' => $album]) }}" data-max-file="20" method="post">
                                <div class="card-body">
                                    <div class="dropzone dropzone-info dz-area" id="fileTypeValidation"
                                        action="/uploader.php">
                                        <div class="dz-message needsclick"><i class="icon-cloud-up"></i>
                                            <h4>Drop files here or click to upload.</h4><span class="note needsclick">
                                                Upload now organize later. Simple :)
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
