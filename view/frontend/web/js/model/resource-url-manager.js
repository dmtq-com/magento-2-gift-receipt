define([
        'Magento_Customer/js/model/customer',
        'Magento_Checkout/js/model/url-builder',
        'mageUtils',
        'mage/url',
        'mage/translate'
], function (customer, urlBuilder, utils, url, $t) {
    'use strict';

    return {

        /**
         * @param {String} quoteId
         * @param {String} action
         * @return {*}
         */
        getActionUrl: function (quoteId,action) {
            var action = action || 'save-need-gift-receipt',
                params = this.getCheckoutMethod() === 'guest' ? //eslint-disable-line eqeqeq
                    {
                        quoteId: quoteId
                    } : {},
                urls = {
                    'guest': '/guest-carts/' + quoteId + '/' + action,
                    'customer': '/carts/mine/' + action
                };

            return this.getUrl(urls, params);
        },

        /**
         * @return {String}
         */
        getCheckoutMethod: function () {
            return customer.isLoggedIn() ? 'customer' : 'guest';
        },

        /**
         * Get url for service.
         *
         * @param {*} urls
         * @param {*} urlParams
         * @return {String|*}
         */
        getUrl: function (urls, urlParams) {
            var url;

            if (utils.isEmpty(urls)) {
                return $t('Provided service call does not exist.');
            }

            if (!utils.isEmpty(urls['default'])) {
                url = urls['default'];
            } else {
                url = urls[this.getCheckoutMethod()];
            }

            return urlBuilder.createUrl(url, urlParams);
        }
    };
    }
);
