/**
 * Created by Hungpv
 * on 28/03/2014.
 */

var OrderController = {
    deleteOrder: function (id) {
        var url = 'admin/order/deleteOrder';
        var page = $("#page_curent").val();
        var data = 'id=' + id + '&page=' + page;
        var callback = OrderController.cbdelOrder;
        if (confirm("Delete order no. " + id)) {
            BASE.sendRequest(url, data, callback);
        }
    },
    delMutilUser: function () {
        var url = 'admin/order/deleteOrder';
        var ids = [];
        $('.order-checkbox:checked').each(function () {
            ids.push($(this).val());
        });
        var page = $("#page_curent").val();
        var data = 'id=' + ids.toString() + '&page=' + page;
        var callback = OrderController.cbdelOrder;
        if (confirm("Delete orders no." + ids)) {
            BASE.sendRequest(url, data, callback);
        }
    },
    cbdelOrder: function (data) {
        try {
            $('#show_content').html(data.html);
        } catch (e) {
            alert('Loi');
        }
    },
    checkNum: function (id) {
        var box = $("#numBox" + id);
        var errBox = $("#numErr" + id);
        var value = box.val();
        if (!isNaN(value) && value > 0 && value < 100) {
            errBox.fadeOut();
            box.val(Math.floor(value));
            OrderController.changePrice(id);
        } else {
            errBox.fadeIn();
            errBox.css('display', 'block');
        }
    },
    changePrice: function (id) {
        var boxTotalPrice = $('.boxTotalPrice');
        var boxSubPrice = $("#subPriceBox" + id);
        var boxQuantity = $("#numBox" + id);
        var boxPrice = $("#priceBox" + id);
        // Get current total price
        var totalPrice = parseFloat(boxTotalPrice.html().split(' ').join(''));
        // Get old subprice
        var subPrice = parseFloat(boxSubPrice.html().split(' ').join(''));
        //Get price
        var price = parseFloat(boxPrice.html().split(' ').join(''));
        // Get new quantity
        var quantity = boxQuantity.val();
        // Set total price = totalPrice - subPrice
        totalPrice = totalPrice - subPrice;
        // Set new sub price = quantity * price
        subPrice = quantity * price;
        // Set total price = totalPrice + (new)subPrice
        totalPrice = totalPrice + subPrice;
        // reformat value
        totalPrice = totalPrice.formatMoney(2, '.', ' ');
        subPrice = subPrice.formatMoney(2, '.', ' ');
        //Set new value to box
        boxTotalPrice.html(totalPrice);
        boxSubPrice.html(subPrice);
    },

    deleteItem: function (pro_id, order_id, name){
        var url = 'admin/order/deleteItem';
        var data = 'pro_id=' + pro_id + "&order_id=" + order_id;
        var callback = OrderController.cbDelIem;
        if (confirm("Delete product = " + name)) {
            BASE.sendRequest(url, data, callback);
        }
    },
    cbDelIem: function(data){
        try {
            $('#show_content').html(data.html);
        } catch (e) {
            alert('Loi');
        }
    }
};