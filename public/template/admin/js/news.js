var NewsController = {
    checkTitleExits: true,
    check: function() {
        var bol = true;
        var html = $.trim($('.nicEdit-main').html());
        var title = $.trim($('#title').val());
        if (title == '') {
            $('#errTitle').html('Mời nhập tiêu đề');
            bol = false;
        } else {
            $('#errTitle').html('');
        }
        if (html == '') {
            $('#err').html('Mời nhập nội dung');
            bol = false;
        } else {
            $('#err').html('');
            $('#text_content').val(html);
        }
        if (NewsController.checkOrder('order_display') == false)
            bol = false;
        if (NewsController.checkTitleExits == false)
        {
            $('#errTitle').html('Tiêu đề đã tồn tại');
            bol = false;
        }
        return bol;
    },
    checkTitle: function(ele, id) {
        var url;
        var valueTitle = $.trim($('#' + ele).val());
        if (valueTitle != '') {
            url = 'admin/news/checkTitle';
            var data = 'title=' + valueTitle;
            if (id != '') {
                data = 'title=' + valueTitle + '&id=' + id;
            }
            var callback = NewsController.cbcheckTitle;
            BASE.sendRequest(url, data, callback);
        } else {
            $('#errTitle').html('Mơi nhập tiêu đề');
        }
    },
    cbcheckTitle: function(data) {
        try {
            $('#errTitle').html(data.html);
            if (data.html == 'Tiêu đề đã tồn tại') {
                NewsController.checkTitleExits = false;
            } else {
                NewsController.checkTitleExits = true;
            }
        } catch (e) {
            alert('Loi');
        }
    },
    checkOrder: function(ele) {
        var val = $.trim($('#' + ele).val());
        if (isNaN(val) || BASE.isEmty(ele)) {
            $('#errOrder').html('Nhập số');
            return false;
        } else {
            $('#errOrder').html('');
            return true;
        }
    }
}
