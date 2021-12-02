<?php

/*
 * @package     Intelipost_Shipping
 * @copyright   Copyright (c) Intelipost
 * @author      Alex Restani <alex.restani@intelipost.com.br>
 */

namespace Intelipost\Shipping\Cron;

class CreateOrder
{
    /** @var \Intelipost\Shipping\Helper\Data  */
    protected $helper;

    /** @var \Intelipost\Shipping\Model\ResourceModel\Shipment\CollectionFactory  */
    protected $collectionFactory;

    /** @var \Intelipost\Shipping\Client\ShipmentOrder  */
    protected $shipmentOrder;

    public function __construct(
        \Intelipost\Shipping\Model\ResourceModel\Shipment\CollectionFactory $collectionFactory,
        \Intelipost\Shipping\Client\ShipmentOrder $shipmentOrder,
        \Intelipost\Shipping\Helper\Data $helper
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->shipmentOrder = $shipmentOrder;
        $this->helper = $helper;
    }

    public function execute()
    {
        $enable = $this->helper->getConfig('enable_cron', 'order_status', 'intelipost_push');
        $status = $this->helper->getConfig('status_to_create', 'order_status', 'intelipost_push');

        if ($enable) {
            $statuses = explode(',', $status);

            $collection = $this->collectionFactory->create();
            $collection
                ->addFieldToFilter('status', ['in' => $statuses])
                ->addFieldToFilter('main_table.intelipost_status', 'pending');

            foreach ($collection as $shipment) {
                $this->shipmentOrder->execute($shipment);
            }
        }
    }
}
