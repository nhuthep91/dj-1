
//kiem tra thong tin form login trống
var LoginController = {
    validateForm: function(email, password) {
        var ktra = 0;
        var e = $('#' + email).val();
        var p = $('#' + password).val();
        if (e == '' || $.trim(e) == null) {
            $('#errEmail').html('Hay nhap email');
            ktra = 1;
        } else {
            $('#errEmail').html('');
        }
        if (p == '' || $.trim(p) == null) {
            $('#errPass').html('Hay nhap pass');
            ktra = 1;
        } else {
            $('#errPass').html('');
        }
        if (ktra == 1) {
            return false;
        }
        return true;
    }
}