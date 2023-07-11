$(document).on('change', '.studioOptions', function (event) {
    event.preventDefault();
    let _this = this;
    let selectedValue = $(_this).find(':selected').val();
    let parentDiv = $(_this).closest('div.modal-body');

    if ($('#settings_options').length) {
        $('#settings_options').remove();
    }
    if (selectedValue == 'undefined') {
        return;
    }
    let settings = JSON.parse($(_this).find(':selected').attr('data-options'));
    var options = $("<div id='settings_options' class='row bg-light text-dark p-2'></div>");
    var _html = `
        <div class='col-md-12'><h4>Other Settings</h4></div>
            <div class='col-md-12 mt-2 mb-2'>
                <div class='form-group'>
                    <label>
                        Unit
                    </label>
                    <input type='text' class='form-control' name='unit' value='${settings.unit}' />
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class='row'>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>
                            Height (${settings.height})
                        </label>
                        <input type='text' class='form-control' name='height' value='${settings.height}' />
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>
                            Width (${settings.width})
                        </label>
                        <input type='text' class='form-control' name='width' value='${settings.width}' />
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>
                            Default Price (NRs)
                        </label>
                        <input type='text' class='form-control' name='service_price' value='' required='true' />
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>
                            Default Quantity (NRs)
                        </label>
                        <input type='text' class='form-control' name='quantity_per_price' value='' required='true' />
                    </div>
                </div>
            </div>
        </div>
    `;
    $(options).html(_html);
    $(parentDiv).append(options);
});
