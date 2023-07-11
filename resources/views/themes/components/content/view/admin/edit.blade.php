<?php
$values = json_decode($component->values);
?>
<form action="{{ route('admin.components.update', ['componentBuilder' => $component]) }}" method="post"
    class="ajax-component-form">
    <input type="hidden" name="component" value="{{ $component->component_type }}">

    <div class="bg-light px-2 py-2">
        <div class="component-container">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="text-dark">Title</label>
                        <input type="text" name="title" value="{{ $values->title }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="text-dark">Subtitle</label>
                        <input type="text" name="subtitle" value="{{ $values->subtitle }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-12 mt-2">
                    <div class="form-group">
                        <label for='full_text' class="text-dark">
                            Full Text
                        </label>
                        <textarea name="full_text" class="form-control tiny-mce">{{ $values->description }}</textarea>
                    </div>
                </div>
            </div>

            <div>
                @if ($values?->media)
                    @php
                        $counter = 1;
                    @endphp
                    @foreach ($values->media as $media_key => $media_array)
                        <div class="row mt-2 @if ($counter == 1) clone_element @endif">


                            @foreach ($media_array as $media)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="media" class="text-dark">
                                            Media Source
                                        </label>
                                        <select name="media_source[]" class="form-control no-select-2">
                                            <option value="youtube" @if (isset($media->query->host) && $media->query->host == 'youtube.com') selected @endif>
                                                Youtube</option>
                                            <option value="vimeo" @if (isset($media->query->host) && $media->query->host == 'vimeo.com') selected @endif>
                                                Vimeo
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="media" class="text-dark">
                                            Media URL
                                        </label>
                                        <input type="url" name="media_link[]" value='{{ $media->link }}'
                                            class='form-control'>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-dark">
                                            Display Position
                                        </label>
                                        <select name="display_position[]" class="form-control no-select-2">
                                            <option value="top" @if ($media_key == 'top') selected @endif>
                                                Above
                                                Content</option>
                                            <option value="bottom" @if ($media_key == 'bottom') selected @endif>
                                                Below
                                                Content</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex justify-content-center align-items-center">
                                    @if ($counter == 1)
                                        <a class="btn btn-info clone-component">
                                            <i class="fa fa-copy"></i>
                                        </a>
                                    @endif
                                    <a
                                        class="btn btn-danger @if ($counter == '1') d-none @endif remove-clone-component">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                                @php
                                    $counter++;
                                @endphp
                            @endforeach
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    Update Component
                </button>
            </div>
        </div>
    </div>
</form>
