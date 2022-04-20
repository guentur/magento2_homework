define([
    'jquery',
    'uiComponent',
    'ko'
], function ($, Component, ko) {
    'use strict';

    return Component.extend({
        defaults: {
            url: '',
            reviewerName: ko.observable('Default Name'),
            reviewerMessage: ko.observable('Default Review'),
        },
        isLoading: ko.observable(false),

        initialize: function () {
            this._super();
            this.nextReview();
            return this;
        },

        nextReview: function () {
            this.isLoading(true);
            let self = this;
            $.ajax({
                url: self.url,
                type: 'POST',
                dataType: 'JSON'
            }).done(function (data) {
                if(data.name && data.message) {
                    self.reviewerName(data.name);
                    self.reviewerMessage(data.message);
                }
            }).always(function () {
                self.isLoading(false);
            });
        },
    });
});
