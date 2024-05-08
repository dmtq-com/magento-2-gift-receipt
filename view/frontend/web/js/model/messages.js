define([
    'ko',
    'jquery',
    'underscore',
    'Magento_Ui/js/model/messages'
], function (ko, $, _, Messages) {
    'use strict';

    return Messages.extend({
        _disableClear: false,

        initObservable: function () {
            this.warningMessages = ko.observableArray([]);

            return this._super();
        },

        /**
         * Add messages by type and create by type as needed.
         *
         * @param {Object} messages
         * @return {void}
         */
        addMessages: function (messages) {
            let funcName,
                self = this;

            this._disableClear = true;
            _.each(messages, function (message) {
                funcName = $.camelCase('add-' + message.type + '-message');
                self[funcName]({'message': message.text});
            });
            this._disableClear = false;
        },

        /**
         * Add warning message.
         *
         * @param {Object} message
         * @return {*|Boolean}
         */
        addWarningMessage: function (message) {
            return this.add(message, this.warningMessages);
        },

        /**
         * Get warning messages.
         *
         * @return {Array}
         */
        getWarningMessages: function () {
            return this.warningMessages;
        },

        /**
         * Checks if an instance has stored messages.
         *
         * @return {Boolean}
         */
        hasMessages: function () {
            return this.warningMessages().length > 0 || this._super();
        },

        /**
         * Removes stored messages.
         */
        clear: function () {
            if (!this._disableClear) {
                this.warningMessages.removeAll();
                this._super();
            }
        }
    });
});
