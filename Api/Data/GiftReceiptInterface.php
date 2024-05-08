<?php
namespace DMTQ\GiftReceipt\Api\Data;

/**
 * Interface GiftReceiptInterface
 * @api
 */
interface GiftReceiptInterface
{
    /**
     * Get
     *
     * @return string|null
     */
    public function getNeedGiftReceipt();

    /**
     * Set
     *
     * @param string $giftReceipt
     * @return null
     */
    public function setNeedGiftReceipt($giftReceipt);
}
