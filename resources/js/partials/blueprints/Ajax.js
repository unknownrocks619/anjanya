export default class AjaxRequest {

    _requestParams;
    _currentRequest = null;
    _errors = false;
    _success = false;
    _response;

    constructor(url, method, params = {}) {

        this.buildRequest({ 'url': url, 'method': method, data: params });
    }

    async sendRequest() {
        this.cancelRequest();
        this._currentRequest = await $.ajax({
            method: this._requestParams.method,
            url: this._requestParams.url,
            data: this._requestParams.data,
        })

        this.setSuccessStatus(true);
    }

    isSuccess() {
        return this._success;
    }

    isFailed() {
        return this._errors;
    }

    getResponse() {
        return this._response;
    }

    buildRequest(params) {
        this._requestParams = params;
    }

    cancelRequest() {
        if (this._currentRequest) {
            this._currentRequest.abort();
        }

    }

    setResponse(response) {
        this._response = response;
    }

    setSuccessStatus(status) {
        console.log('this hello');
        this._success = status;
    }

    setErrorStatus(status) {
        this._errors = status;
    }



}
