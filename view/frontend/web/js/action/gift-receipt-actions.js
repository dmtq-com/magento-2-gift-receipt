define([
    'jquery',
    'Magento_Checkout/js/model/quote',
    'DMTQ_GiftReceipt/js/model/resource-url-manager',
    'Magento_Checkout/js/model/error-processor',
    'DMTQ_GiftReceipt/js/model/payment/gift-receipt-messages',
    'mage/storage'
], function ($, quote, urlManager, errorProcessor, messageContainer, storage) {
    'use strict';

    return {
        remove: function () {
            var quoteId = quote.getQuoteId(),
                url = urlManager.getActionUrl(quoteId,'remove-need-gift-receipt');

            messageContainer.clear();

            return storage.delete(url, false);
        },

        set: function (data) {
            var quoteId = quote.getQuoteId(),
                url = urlManager.getActionUrl(quoteId, 'save-need-gift-receipt');

            messageContainer.clear();
            var payload = {
                giftReceipt: {
                    need_gift_receipt: data
                }
            };
            return storage.put(url, JSON.stringify(payload), false);
        }
    };
});
