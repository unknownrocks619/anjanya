
<div class="container py-5">
    <div class="row g-5">
        <div class="col-md-6">
            <div class="form-group">
                <label for="first_name">First name <sup class="text-danger">*</sup></label>
                <input type="text" name="first_name" id="first_name" class="form-control" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="last_name">Last Name <sup class="text-danger">*</sup></label>
                <input type="text" name="last_name" id="last_name" class="form-control" />
            </div>
        </div>
    </div>
    <div class="row g-5">
        <div class="col-md-6">
            <div class="form-group">
                <label for="mobile_number">Phone Number
                    <sup class="text-danger">*</sup>
                </label>
                <input type="text" class="form-control" name="mobile_number" value="" id="mobile_number" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email
                    <sup class="text-danger">*</sup>
                </label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
        </div>
    </div>

    <div class="row g-5 my-4 border">
        <div class="col-md-6">
            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" class="form-control no-select-2">
                    <option value="male" selected>Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
            </div>
        </div>
        <div class="col-md-12 my-4">
            <div class="form-group">
                <label for="address">Full Address</label>
                <textarea name="address" id="address" class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="row my-2 g-5 pb-4 mb-5">
        <div class="col-md-12">
            <button class="btn btn-primary p-4 fs-1">Register My Account</button>
        </div>
    </div>
</div>
