var CateController = {
    click: 0,
    checkForm: function() {
        var flag = true;
        if (BASE.isEmty('title')) {
            flag = false;
            $("#errTitle").html("Title required!");
        }

        return flag;
    },
    delCate: function(ele) {
        var url;
        url = 'admin/category/delCate';
        var page = $("#page_curent").val();
        var data = 'id=' + ele + '&page=' + page;
        var callback = CateController.cbdelCate;
        if (confirm("delete category and product in " + ele)) {
            BASE.sendRequest(url, data, callback);
        }
    },
    delMutilCate: function() {
        var url = 'admin/category/delCate';
        var ids = [];
        $('.cate-checkbox:checked').each(function() {
            ids.push($(this).val());
        });
        var page = $("#page_curent").val();
        var data = 'id=' + ids.toString() + '&page=' + page;
        var callback = CateController.cbdelCate;
        if (ids != '') {
            if (confirm("delete category  and product in " + ids)) {
                BASE.sendRequest(url, data, callback);
            }
        }
    },
    cbdelCate: function(data) {
        try {
            if (data.err == 'Mời xóa các sản phẩm thuộc danh mục đã chọn trước') {
                alert(data.err);
            }
            $('#show_content').html(data.html);
        } catch (e) {
            alert('Loi');
        }
    },
    checkAll: function() {
        if (CateController.click == 0) {
            $('.cate-checkbox').each(function() {
                this.checked = true;
            });
            CateController.click = 1;
            return false;
        } else {
            $('.cate-checkbox').each(function() {
                this.checked = false;
            });
            CateController.click = 0;
            return false;
        }

    }
}