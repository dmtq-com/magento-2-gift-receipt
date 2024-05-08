<?php

namespace DMTQ\GiftReceipt\Model;

use DMTQ\GiftReceipt\Api\Data\GiftReceiptInterface;
use DMTQ\GiftReceipt\Api\GiftReceiptManagementInterface;
use DMTQ\GiftReceipt\Model\Data\GiftReceipt;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\ValidatorException;
use Magento\Quote\Api\CartRepositoryInterface;

class GiftReceiptManagement implements GiftReceiptManagementInterface
{
    /**
     * @var CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param CartRepositoryInterface $quoteRepository
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        CartRepositoryInterface $quoteRepository,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Save
     *
     * @param int $cartId
     * @param GiftReceiptInterface $giftReceipt
     * @return null|int
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function saveNeedGiftReceipt(
        $cartId,
        GiftReceiptInterface $giftReceipt
    ) {
        $quote = $this->quoteRepository->getActive($cartId);

        if (!$quote->getItemsCount()) {
            throw new NoSuchEntityException(
                __('Cart %1 doesn\'t contain products', $cartId)
            );
        }

        $needGiftReceipt = (int)$giftReceipt->getNeedGiftReceipt();

        $this->validate($needGiftReceipt);

        try {
            $quote->setData(GiftReceipt::FIELD_NAME, $needGiftReceipt);

            $this->quoteRepository->save($quote);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __('The order need giff receipt could not be saved')
            );
        }

        return $needGiftReceipt;
    }

    /**
     * remove
     *
     * @param int $cartId
     * @return null|string
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function removeNeedGiftReceipt(
        $cartId
    ) {
        $quote = $this->quoteRepository->getActive($cartId);

        if (!$quote->getItemsCount()) {
            throw new NoSuchEntityException(
                __('Cart %1 doesn\'t contain products', $cartId)
            );
        }

        try {
            $quote->setData(GiftReceipt::FIELD_NAME, '');
            $this->quoteRepository->save($quote);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __('The order need gift receipt could not be removed')
            );
        }

        return '';
    }

    /**
     * Validate
     *
     * @param int $needGiftReceipt
     * @throws ValidatorException
     */
    protected function validate(int $needGiftReceipt)
    {
        if (!in_array($needGiftReceipt,[0,1])) {
            throw new ValidatorException(
                __('The order need gift receipt data error')
            );
        }
    }
}
