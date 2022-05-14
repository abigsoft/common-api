InfoDlg.clearData = function () {
    this.formData = {};
};

InfoDlg.set = function (key, val) {
    this.formData[key] = (typeof value == "undefined") ? $("#" + key).val() : value;
    return this;
};

InfoDlg.get = function (key) {
    return $("#" + key).val();
};

InfoDlg.close = function () {
    parent.layer.close(parent.layer.getFrameIndex(window.name));
};


