<?php
/**
 * Copyright (c) 2024 KOUNT, INC.
 * See COPYING.txt for license details.
 */
namespace Kount\Kount360\Model;

use Kount\Kount360\Model\Order\ActionFactory as OrderActionFactory;

abstract class WorkflowAbstract implements WorkflowInterface
{
    /**
     * @var \Kount\Kount360\Model\Config\Workflow
     */
    protected $configWorkflow;

    /**
     * @var \Kount\Kount360\Model\RisService
     */
    protected $risService;

    /**
     * @var \Kount\Kount360\Model\Order\ActionFactory
     */
    protected $orderActionFactory;

    /**
     * @var \Kount\Kount360\Model\Order\Ris
     */
    protected $orderRis;

    /**
     * @var \Magento\Sales\Api\OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * @var \Kount\Kount360\Model\Logger
     */
    protected $logger;

    /**
     * @param \Kount\Kount360\Model\Config\Workflow $configWorkflow
     * @param \Kount\Kount360\Model\RisService $risService
     * @param \Kount\Kount360\Model\Order\ActionFactory $orderActionFactory
     * @param \Kount\Kount360\Model\Order\Ris $orderRis
     * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
     * @param \Kount\Kount360\Model\Logger $logger
     */
    public function __construct(
        \Kount\Kount360\Model\Config\Workflow $configWorkflow,
        \Kount\Kount360\Model\RisService $risService,
        \Kount\Kount360\Model\Order\ActionFactory $orderActionFactory,
        \Kount\Kount360\Model\Order\Ris $orderRis,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        \Kount\Kount360\Model\Logger $logger
    ) {
        $this->configWorkflow = $configWorkflow;
        $this->risService = $risService;
        $this->orderActionFactory = $orderActionFactory;
        $this->orderRis = $orderRis;
        $this->orderRepository = $orderRepository;
        $this->logger = $logger;
    }


    protected function updaterOrderStatus($order, $inPaymentWorkflow = false)
    {
        $kountRisResponse = $this->orderRis->getRis($order)->getResponse();
        switch ($kountRisResponse) {
            case RisService::AUTO_DECLINE:
                $this->orderActionFactory->create(OrderActionFactory::DECLINE)->process($order, $inPaymentWorkflow);
                break;
            case RisService::AUTO_REVIEW:
            case RisService::AUTO_ESCALATE:
                $this->orderActionFactory->create(OrderActionFactory::REVIEW)->process($order);
                break;
        }

        $this->orderRepository->save($order);
    }
}
