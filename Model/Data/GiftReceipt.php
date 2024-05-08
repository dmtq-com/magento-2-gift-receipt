<?php
namespace DMTQ\GiftReceipt\Model\Data;

use DMTQ\GiftReceipt\Api\Data\GiftReceiptInterface;
use Magento\Framework\Api\AbstractSimpleObject;

class GiftReceipt extends AbstractSimpleObject implements GiftReceiptInterface
{
    public const FIELD_NAME = 'need_gift_receipt';

    /**
     * Get
     *
     * @return string|null
     */
    public function getNeedGiftReceipt()
    {
        return $this->_get(static::FIELD_NAME);
    }

    /**
     * Set
     *
     * @param string $giftReceipt
     * @return $this
     */
    public function setNeedGiftReceipt($giftReceipt)
    {
        return $this->setData(static::FIELD_NAME, $giftReceipt);
    }
}
