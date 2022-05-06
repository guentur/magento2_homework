define([
    'jquery',
    'uiComponent',
    'ko',
    'mage/translate'
], function ($, Component, ko) {
    'use strict';

    return Component.extend({
        defaults: {
            url: '',
            rowResult: $.mage.__('Available Qty: '),
            availableQty: ko.observable(''),
        },
        productSku: document.querySelector('#product_addtocart_form').dataset.productSku,
        isLoading: ko.observable(false),

        showAvailableQty: function () {
            let self = this;
            this.isLoading(true);
            $.ajax({
                url: self.url,
                data: {
                    productSku: self.productSku
                },
                type: 'POST',
                dataType: 'JSON'
            }).done(function (data) {
                if (data.status === 'success') {
                    self.availableQty(data.available_qty);
                } else {
                    self.availableQty('Something went wrong');
                }
            }).always(function () {
                self.isLoading(false);
            });
        },
    });
});
