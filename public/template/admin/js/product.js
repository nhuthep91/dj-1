var ProductController = {

    checkFormAdd: function() {
        var bol = true;
        if (BASE.isEmty('pro_name')) {
            $('#errPro_name').html('Mơi nhập Ten sp');
            bol = false;
        } else {
            $('#errPro_name').html('');
        }
        if (BASE.isEmty('pro_price')) {
            $('#errPro_price').html('Mơi nhập Gia sp');
            bol = false;
        } else {
            $('#errPro_price').html('');
        }
        return bol;

    },

    checkForm: function() {
        var flag = true;
        if (BASE.isEmty('title')) {
            flag = false;
            $("#errTitle").html("Title required!");
        }

        return flag;
    },
    delProduct: function(ele) {
        var url;
        url = 'admin/product/delProduct';
        var page = $("#page_curent").val();
        var data = 'id=' + ele + '&page=' + page;
        var callback = ProductController.cbdelProduct;
        if (confirm("delete product " + ele)) {
            BASE.sendRequest(url, data, callback);
        }
    },
    delMutilProduct: function() {
        var url = 'admin/product/delProduct';
        var ids = [];
        $('.pro-checkbox:checked').each(function() {
            ids.push($(this).val());
        });
        var page = $("#page_curent").val();
        var data = 'id=' + ids.toString() + '&page=' + page;
        var callback = ProductController.cbdelProduct;
        if (ids != '') {
            if (confirm("delete product " + ids)) {
                BASE.sendRequest(url, data, callback);
            }
        }
    },
    cbdelProduct: function(data) {
        try {
            $('#show_content').html(data.html);
        } catch (e) {
            alert('Loi');
        }
    },
    checkFormPro: function() {
        var bol = true;
        var price = /^\d+$/;
        if (BASE.isEmty('name')) {
            $('#errName').html('Mơi nhập tên sản phẩm');
            bol = false;
        } else {
            $('#errName').html('');
        }
        if ($.trim($('#price').val()).match(price)) {
            $('#errPrice').html('');
        } else {
            $('#errPrice').html('Mơi nhập giá (là số)');
            bol = false;
        }
        if (ProductController.checkNameExits == false) {
            $('#errName').html('Tên đã tồn tại');
            bol = false;
        }
        return bol;
    },
    checkName: function(ele, id) {
        var url;
        var valueName = $('#' + ele).val();
        url = 'admin/product/checkName';
        var data = 'name=' + valueName + '&id=' + id;
        if (BASE.isEmty('name')) {
            $('#errName').html('Mơi nhập tên sản phẩm');
        }
        else {
            var callback = ProductController.cbcheckName;
            BASE.sendRequest(url, data, callback);
        }
    },
    cbcheckName: function(data) {
        try {
            $('#errName').html(data.html);
            if (data.html == 'Tên đã tồn tại') {
                ProductController.checkNameExits = false;
            } else {
                ProductController.checkNameExits = true;
            }
        } catch (e) {
            alert('Loi');
        }
    }
}