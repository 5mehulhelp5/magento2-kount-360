<?php
/**
 * Copyright (c) 2025 KOUNT, INC.
 * See COPYING.txt for license details.
 */
namespace Kount\Kount360\Model\Ris\Update;

use Magento\Framework\DataObject;
use Magento\Sales\Model\Order;

class Builder
{
    public function __construct(
        private \Kount\Kount360\Model\Ris\UpdateFactory $updateFactory,
        private \Kount\Kount360\Model\Ris\Inquiry\Builder\Order $orderBuilder,
    ) {
    }

    /**
     * @param \Magento\Sales\Model\Order $order
     * @param mixed $risTransactionId
     * @param mixed $realTimeDecline
     * @return DataObject
     */
    public function build(Order $order, $risTransactionId, $realTimeDecline = false): DataObject
    {
        $updateRequest = $this->updateFactory->create($order->getStore()->getWebsiteId());
        $this->orderBuilder->processUpdate($updateRequest, $risTransactionId, $order, $realTimeDecline);
        return $updateRequest;
    }
}
