    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="" class="text-dark">
                            Display title
                        </label>
                        <input type="text" name="display_title" id="" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class='text-dark'>
                        Select Layout
                    </label>
                    <select name="layout" class="form-control no-select-2">
                        <option value="course_layout">Course Layout</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class='text-dark'>
                        Background
                    </label>
                    <input type="color" name="background_color" value='' />
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="text-dark">Enable Registration Button</label>
                        <input type="text" name="registration_button"class="form-control" value="Register Now">
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="" class="text-dark">
                            TagLine below button
                        </label>
                        <input type="text" class="form-control" name="registration_tagline"
                            value="Register for a FREE Upschool account to enrol in this course" />
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="row first_accordian">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="text-dark">
                                    Question Text
                                </label>
                                <input type="text" name="question_text[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-dark">Faq Description</label>
                                <textarea name="faq_description[]" class="form-control tiny-mce"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 d-flex justify-content-center align-items-center">
                    <a class="btn btn-info clone_accordian_component">
                        <i class="fa fa-copy"></i>
                    </a>
                    <a class="btn btn-danger d-none remove_accordian_component">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Save Component
                    </button>
                </div>
            </div>
        </div>
    </div>
