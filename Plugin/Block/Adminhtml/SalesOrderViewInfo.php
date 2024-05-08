<?php
namespace DMTQ\GiftReceipt\Plugin\Block\Adminhtml;

use DMTQ\GiftReceipt\Model\Data\GiftReceipt;
use Magento\Sales\Block\Adminhtml\Order\View\Info as ViewInfo;

class SalesOrderViewInfo
{
    /**
     * Set
     *
     * @param ViewInfo $subject
     * @param string $result
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function afterToHtml(
        ViewInfo $subject,
        $result
    ) {
        $block = $subject->getLayout()
            ->getBlock('gift_receipt');

        if ($block !== false) {
            $block->setNeedGiftReceipt($subject->getOrder()
                ->getData(GiftReceipt::FIELD_NAME));
            $result = $result . $block->toHtml();
        }

        return $result;
    }
}
