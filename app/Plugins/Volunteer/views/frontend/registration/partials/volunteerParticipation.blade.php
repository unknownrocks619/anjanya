<div class="container">
   <div class="row">
                <div class="col-md-6">
                    <label for="jaap_anushthan"  class="mb-4">
                        Are you in Hanuman Mantra Jaap Anusthan?
                    </label>
                    <select name="jaap_anushthan" id="jaap_anushthan" class="form-control mt-1">
                        <option value="no">No</option>
                        <option value="yes">Yes</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="jaap_anushthan">
                        Have you volunteered with Himalayan Siddha Mahayog/Anjaneya Youth Club before?
                    </label>
                    <select name="jaap_anushthan" id="jaap_anushthan" class="form-control">
                        <option value="no">No</option>
                        <option value="yes">Yes</option>
                    </select>
                </div>
            </div>
    <div class="row mt-3 my-3">
        <div class="col-md-12 text-end">
            <button type="button" onclick="window.Registration.stepBack()" class="btn btn-danger me-1">
                <i class="fas fa-arrow-left"></i>
                {{__('web/registration/events.back')}}
            </button>
            <button type="submit" onclick="window.Registration.submitForm(this)" class="btn btn-primary">Next
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </div>
</div>
