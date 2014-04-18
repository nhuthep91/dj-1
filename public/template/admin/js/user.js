var UserController = {
    checkMailExits: true,
    delUser: function(ele) {
        var url;
        url = 'admin/user/delUser';
        var page = $("#page_curent").val();
        var data = 'id=' + ele  + '&page=' + page;
        var callback = UserController.cbdelUser;
        if(confirm("delete user " + ele)){
            BASE.sendRequest(url, data, callback);
        }
    },
    delMutilUser: function () {
        var url;
        url = 'admin/user/delUser';
        var ids = [];
        $('.user-checkbox:checked').each(function(){
            ids.push($(this).val());
        });
        var page = $("#page_curent").val();
        var data = 'id=' + ids.toString()  + '&page=' + page;
        var callback = UserController.cbdelUser;
        if (confirm("delete user " + ids)) {
            BASE.sendRequest(url, data, callback);
        }
    },
    cbdelUser: function(data) {
        try {
            $('#show_content').html(data.html);
        } catch (e) {
            alert('Loi');
        }
    },
    checkForm: function() {
        var bol = true;
        var phoneno = /^\d+$/;
        if (BASE.isEmty('name')) {
            $('#errName').html('Mơi nhập name');
            bol = false;
        } else {
            $('#errName').html('');
        }
        if (BASE.isEmty('password')) {
            $('#errPassword').html('Mơi nhập password');
            bol = false;
        } else {
            $('#errPassword').html('');
        }
        if ($('#password').val() != $('#confirmPassword').val()) {
            $('#errconfirmPassword').html('Mật khẩu và nhập lại mật khẩu chưa chính xác');
            bol = false;
        } else {
            $('#errconfirmPassword').html('');
        }
        if (BASE.isEmty('email')||!UserController.validateEmail($("#email").val())) {
            $('#errEmail').html('Mơi nhập email (example@abc.com)');
            bol = false;
        } else {
            $('#errEmail').html('');
        }
        if (BASE.isEmty('address')) {
            $('#errAddress').html('Mơi nhập address');
            bol = false;
        } else {
            $('#errAddress').html('');
        }
        if ($.trim($('#phone').val()).match(phoneno)) {
            $('#errPhone').html('');
        } else {
            $('#errPhone').html('Mơi nhập phone (là số)');
            bol = false;
        }
        if (UserController.checkMailExits == false) {
            $('#errEmail').html('Mail đã tồn tại');
            bol = false;
        }
        return bol;

    },
    validateEmail: function(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    },
    checkmail: function(ele) {
        var url;
        var valueEmail = $('#' + ele).val();
        if (UserController.validateEmail(valueEmail)) {
            url = 'admin/user/checkMail';
            var data = 'email=' + valueEmail;
            var callback = UserController.cbCheckmail;
            BASE.sendRequest(url, data, callback);
        } else {
            $('#errEmail').html('Mơi nhập email (example@abc.com)');
        }
    },
    cbCheckmail: function(data) {
        try {
            $('#errEmail').html(data.html);
            if (data.html == 'Mail đã tồn tại') {
                UserController.checkMailExits = false;
            } else {
                UserController.checkMailExits = true;
            }
        } catch (e) {
            alert('Loi');
        }
    }

}