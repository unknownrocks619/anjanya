<form action="{{ route('admin.users.customers.edit', ['customer' => $user]) }}" class="ajax-form" method="post">
    <div class="row">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="mb-3 col-md-6 mt-0">
                            <div class="form-group">
                                <label for="education_level">Education Level</label>
                                <select name="education_level" id="education_level" class="form-control">
                                    @foreach (\App\Models\UserMeta::USER_EDUCATIONS as $key => $value)
                                        <option value="{{ $key }}"
                                            @if ($content->education?->level == $key) selected @endif>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 mt-0">
                            <div class="form-group">
                                <label for="education_major">Education Major</label>
                                <input type="text" value="{{ $content->education?->education_major }}"
                                    name="education_major" id="education_major" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 mt-2">
                            <div class="form-group">
                                <label for="citizenship_country">Citizenship Country</label>
                                <select name="citizenship_country" id="citizenship_country" class="form-control">
                                    @foreach (\App\Models\Country::get() as $country)
                                        <option value="{{ $country->getKey() }}"
                                            @if ($country->getKey() == $user->citizenship_country) selected @endif>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 mt-2">
                            <div class="form-group">
                                <label for="profession">Profession</label>
                                <input type="text" name="profession" id="profession"
                                    value="{{ $content->profession }}" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Zero Configuration  Ends-->
    </div>
    <div class="row my-2">
        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Update User Information
            </button>
        </div>
    </div>
</form>
