<?php
namespace DMTQ\GiftReceipt\Api;

use DMTQ\GiftReceipt\Api\Data\GiftReceiptInterface;

/**
 * Interface for saving the checkout
 * to the quote for logged in users
 * @api
 */
interface GiftReceiptManagementInterface
{
    /**
     * @param int $cartId
     * @param GiftReceiptInterface $giftReceipt
     * @return mixed
     */
    public function saveNeedGiftReceipt(
        $cartId,
        GiftReceiptInterface $giftReceipt
    );

    /**
     * @param int $cartId
     * @return mixed
     */
    public function removeNeedGiftReceipt(
        $cartId
    );
}
