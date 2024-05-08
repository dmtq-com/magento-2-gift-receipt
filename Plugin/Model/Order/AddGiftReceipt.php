<?php
namespace DMTQ\GiftReceipt\Plugin\Model\Order;

use Magento\Sales\Api\Data\OrderSearchResultInterface;
use Magento\Sales\Model\OrderFactory;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderInterface;

class AddGiftReceipt
{
    /**
     * @var OrderFactory
     */
    private $orderFactory;

    /**
     * @var OrderExtensionFactory
     */
    private $orderExtensionFactory;

    /**
     * @param OrderExtensionFactory $extensionFactory
     * @param OrderFactory $orderFactory
     */
    public function __construct(
        OrderExtensionFactory $extensionFactory,
        OrderFactory $orderFactory
    ) {
        $this->orderExtensionFactory = $extensionFactory;
        $this->orderFactory = $orderFactory;
    }

    /**
     * Set "need_gift_receipt" to order data
     *
     * @param OrderInterface $order
     *
     * @return OrderSearchResultInterface
     */
    public function setNeedGiftReceipt(OrderInterface $order)
    {
        if ($order instanceof \Magento\Sales\Model\Order) {
            $giftReceipt = $order->getNeedGiftReceipt();
        } else {
            $orderModel = $this->orderFactory->create();
            $orderModel->load($order->getId());
            $giftReceipt = $orderModel->getNeedGiftReceipt();
        }

        $extensionAttributes = $order->getExtensionAttributes();
        $orderExtensionAttributes = $extensionAttributes ? $extensionAttributes
            : $this->orderExtensionFactory->create();

        $orderExtensionAttributes->setNeedGiftReceipt($giftReceipt);

        $order->setExtensionAttributes($orderExtensionAttributes);
    }

    /**
     * Add "need_gift_receipt" extension attribute to order data object
     *
     * To make it accessible in API data
     *
     * @param OrderRepositoryInterface $subject
     * @param OrderSearchResultInterface $orderSearchResult
     *
     * @return OrderSearchResultInterface
     */
    public function afterGetList(
        OrderRepositoryInterface $subject,
        OrderSearchResultInterface $orderSearchResult
    ) {
        foreach ($orderSearchResult->getItems() as $order) {
            $this->setNeedGiftReceipt($order);
        }
        return $orderSearchResult;
    }

    /**
     * Add "need_gift_receipt" extension attribute to order data object
     *
     * To make it accessible in API data
     *
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $resultOrder
     *
     * @return OrderInterface
     */
    public function afterGet(
        OrderRepositoryInterface $subject,
        OrderInterface $resultOrder
    ) {
        $this->setNeedGiftReceipt($resultOrder);
        return $resultOrder;
    }
}
