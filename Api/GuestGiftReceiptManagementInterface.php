<?php
namespace DMTQ\GiftReceipt\Api;

use DMTQ\GiftReceipt\Api\Data\GiftReceiptInterface;

/**
 * Interface for saving the checkout
 * to the quote for guest users
 * @api
 */
interface GuestGiftReceiptManagementInterface
{
    /**
     * @param string $cartId
     * @param GiftReceiptInterface $giftReceipt
     * @return mixed
     */
    public function saveNeedGiftReceipt(
        $cartId,
        GiftReceiptInterface $giftReceipt
    );

    /**
     * @param string $cartId
     * @return mixed
     */
    public function removeNeedGiftReceipt(
        $cartId
    );
}
