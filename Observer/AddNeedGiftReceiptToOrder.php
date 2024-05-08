<?php
namespace DMTQ\GiftReceipt\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use DMTQ\GiftReceipt\Model\Data\GiftReceipt;

class AddNeedGiftReceiptToOrder implements ObserverInterface
{
    /**
     * Set Note to order
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        /** @var $order \Magento\Sales\Model\Order **/

        $quote = $observer->getEvent()->getQuote();
        /** @var $quote \Magento\Quote\Model\Quote **/

        $order->setData(
            GiftReceipt::FIELD_NAME,
            $quote->getData(GiftReceipt::FIELD_NAME)
        );
    }
}
