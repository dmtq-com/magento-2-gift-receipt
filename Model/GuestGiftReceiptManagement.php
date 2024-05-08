<?php

namespace DMTQ\GiftReceipt\Model;

use DMTQ\GiftReceipt\Api\GuestGiftReceiptManagementInterface;
use Magento\Quote\Model\QuoteIdMaskFactory;
use DMTQ\GiftReceipt\Api\GiftReceiptManagementInterface;
use DMTQ\GiftReceipt\Api\Data\GiftReceiptInterface;

class GuestGiftReceiptManagement implements GuestGiftReceiptManagementInterface
{
    /**
     * @var QuoteIdMaskFactory
     */
    protected $quoteIdMaskFactory;

    /**
     * @var GiftReceiptManagementInterface
     */
    protected $giftReceiptManagement;

    /**
     * GuestGiftReceiptManagement constructor.
     * @param QuoteIdMaskFactory $quoteIdMaskFactory
     * @param GiftReceiptManagementInterface $giftReceiptManagement
     */
    public function __construct(
        QuoteIdMaskFactory $quoteIdMaskFactory,
        GiftReceiptManagementInterface $giftReceiptManagement
    ) {
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->giftReceiptManagement = $giftReceiptManagement;
    }

    /**
     * @inheritDoc
     */
    public function saveNeedGiftReceipt(
        $cartId,
        GiftReceiptInterface $giftReceipt
    ) {
        $quoteIdMask = $this->quoteIdMaskFactory->create()
            ->load($cartId, 'masked_id');

        return $this->giftReceiptManagement->saveNeedGiftReceipt(
            $quoteIdMask->getQuoteId(),
            $giftReceipt
        );
    }

    /**
     * @inheritDoc
     */
    public function removeNeedGiftReceipt(
        $cartId
    ) {
        $quoteIdMask = $this->quoteIdMaskFactory->create()
            ->load($cartId, 'masked_id');

        return $this->giftReceiptManagement->removeNeedGiftReceipt(
            $quoteIdMask->getQuoteId()
        );
    }
}
