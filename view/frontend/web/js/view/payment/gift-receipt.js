define([
    'jquery',
    'underscore',
    'uiComponent',
    'DMTQ_GiftReceipt/js/model/payment/gift-receipt-messages',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/full-screen-loader',
    'mage/translate',
    'DMTQ_GiftReceipt/js/action/loader',
    'Magento_Checkout/js/model/error-processor',
    'DMTQ_GiftReceipt/js/action/gift-receipt-actions',
], function (
    $,
    _,
    Component,
    messageContainer,
    quote,
    fullScreenLoader,
    $t,
    loader,
    errorProcessor,
    giftReceiptActions,
) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'DMTQ_GiftReceipt/payment/gift-receipt',
            isChecked: false,
            loader: {},
        },

        initialize: function () {
            this._super();
            if (window.checkoutConfig.quoteData) {
                var checked = window.checkoutConfig.quoteData.need_gift_receipt === "1";
                this.isChecked(checked);
            }
            this.isChecked.subscribe((newValue) => {
                var data = newValue ? 1 : 0;
                this.apply(data);
            });

            this.loader = loader(false);
            return this;
        },


        initObservable: function () {
            this._super()
                .observe([
                    'isChecked'
                ]);
            return this;
        },

        setContainer: function (element) {
            this.container = element;
        },

        /**
         * application procedure
         */
        apply: function (data) {
           this.loader.start();
            giftReceiptActions.set(data).done(function (response) {
                if (response) {
                    this.applyDone(response);
                }
            }.bind(this))
                .fail(function (response) {
                    this.loader.stop();
                    errorProcessor.process(response, messageContainer);
                }.bind(this));
        },

        /**
         * @param response
         */
        applyDone: function (response) {
            this.loader.stop();
        },

    });
});
