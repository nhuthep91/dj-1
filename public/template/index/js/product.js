var ProductController = {
    delProduct: function(ele) {
        var url;
        url = 'index/product/delProduct';
        var data = 'id=' + ele;
        var callback = ProductController.cbdelProduct;
        BASE.sendRequest(url, data, callback);
    },
    cbdelProduct: function(data) {
        try {
            $('#show_content').html(data.html);
        } catch (e) {
            alert('Loi');
        }
    },
}