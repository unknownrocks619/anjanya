import $ from 'jquery'

class CustomerRoutes {

    _id = null;
    _customerData = {};

    ContactEdit() {
        let url = '/studio/customer/contact/edit/:id';
        let fullUrl = url.replace(':id', this._id);
        return fullUrl;
    }

    setCustomerRecord(customerData) {
        this._customerData = customerData;
        this._setCustomerID(customerData.id_scd);
    }

    _setCustomerID(id) {
        this._id = this._customerData.id_scd;
    }

    CustomerDetail() {
        let customerData = this._customerData;
        let customer = `<div class="tab-pane contact-tab-0 tab-content-child fade show active" id="v-pills-user" role="tabpanel"
        aria-labelledby="v-pills-user-tab">
        <div class="profile-mail">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1 mt-0">
                    <h3><span class="first_name_0">${customerData.first_name_scd}
                        </span><span class="last_name_0">${customerData.last_name_scd}</span>
                    </h3>
                    <p class="email_add_0">${customerData.email_address_scd}</p>
                    <ul>
                        <li>
                            <a href="javascript:void(0)" class='edit-contact ajax-modal' data-action='${this.ContactEdit()}' data-type='modal' data-bs-target='#contactEdit' data-customer-id='${customerData.id_scd}'>Edit</a>
                        </li>
                        <li><a href="javascript:void(0)" class='history-contact' data-type='sidebar' data-bs-target='historyContact' data-customer-id='${customerData.id_scd}'>History</a>
                        </li>
                        <li>
                            <a href="https://google.com" class='delete-customer-contact text-danger data-confirm' data-method='POST' data-confirm='You are about to delete custome contact record. Are you sure you want to perform this action ?'>
                                Delete
                            </a>
                        </li>
                        <li><a href="javascript:void(0)" onclick="printContact(0)" data-bs-toggle="modal"
                                data-bs-target="#printModal">Create Bill</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="email-general">
                <h4 class="mb-3">General</h4>
                <ul>
                    <li>Name <span class="font-primary first_name_0">${customerData.first_name_scd}</span>
                    </li>
                    <li>Gender <span class="font-primary">${customerData.gender_scd}</span>
                    </li>
                    </li>
                    <li>Mobile No<span class="font-primary mobile_num_0">${customerData.phone_number_scd}</span></li>
                    <li>Customer Date<span class="font-primary mobile_num_0">${customerData.created_at_scd.substring(0, 10)}</span></li>
                </ul>
            </div>
        </div>
    </div>`;

        return customer;
    }
}
let CustomerBuild = new CustomerRoutes;

window.customerDetailReload = function (customerDetail) {
    CustomerBuild.setCustomerRecord(customerDetail.customer);
    $(".customer-detail-tab").html(CustomerBuild.CustomerDetail());

    $('a [data-customer-scd-id=' + customerDetail.customer.id_scd + ']').data('customer', customerDetail.customer);
}


$(document).on('click', '.customer-detail', function (event) {
    event.preventDefault();
    let customerData = $(this).data('customer');
    CustomerBuild.setCustomerRecord(customerData);
    $(".customer-detail-tab").html(CustomerBuild.CustomerDetail());
});

