<?php

namespace DMTQ\GiftReceipt\Block\Order;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use DMTQ\GiftReceipt\Model\Data\GiftReceipt;
use Magento\Framework\Registry;
use Magento\Sales\Model\Order;
use Magento\Framework\App\Config\ScopeConfigInterface;

class NeedGiftReceipt extends Template
{

    /**
     * @var Registry
     */
    protected $coreRegistry = null;

    /**
     * @param    Context $context
     * @param    Registry $registry
     * @param   array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        $this->_isScopePrivate = true;
        $this->_template = 'order/view/need-gift-receipt.phtml';
        parent::__construct($context, $data);
    }

    /**
     * Get Order
     *
     * @return array|null
     */
    public function getOrder()
    {
        return $this->coreRegistry->registry('current_order');
    }

    /**
     * Get
     *
     * @return string
     */
    public function getNeedGiftReceipt()
    {
        return trim((string)$this->getOrder()->getData(GiftReceipt::FIELD_NAME));
    }

    /**
     * Retrieve html
     *
     * @return string
     */
    public function getNeedGiftReceiptHtml()
    {
        return nl2br($this->escapeHtml($this->getNeedGiftReceipt()));
    }

    /**
     * Check if has
     *
     * @return bool
     */
    public function hasNeedGiftReceipt()
    {
        return strlen($this->getNeedGiftReceipt()) > 0;
    }
}
