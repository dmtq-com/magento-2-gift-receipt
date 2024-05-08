define([
    'Magento_Ui/js/view/messages',
    'DMTQ_GiftReceipt/js/model/payment/gift-receipt-messages'
], function (Component, messageContainer) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'DMTQ_GiftReceipt/messages',
        },

        /** @inheritdoc */
        initialize: function (config) {
            return this._super(config, messageContainer);
        }
    });
});
