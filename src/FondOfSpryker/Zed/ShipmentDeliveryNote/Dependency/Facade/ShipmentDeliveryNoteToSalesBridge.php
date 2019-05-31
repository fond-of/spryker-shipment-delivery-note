<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade;

use Orm\Zed\Sales\Persistence\SpySalesOrder;

class ShipmentDeliveryNoteToSalesBridge implements ShipmentDeliveryNoteToSalesInterface
{
    /**
     * @var \FondOfSpryker\Zed\Sales\Business\SalesFacadeInterface
     */
    protected $salesFacade;

    /**
     * @param \FondOfSpryker\Zed\Sales\Business\SalesFacadeInterface $salesFacade
     */
    public function __construct($salesFacade)
    {
        $this->salesFacade = $salesFacade;
    }

    /**
     * @param string $orderReference
     *
     * @return int
     */
    public function findSalesOrderByOrderReference(string $orderReference)
    {
        return $this->salesFacade->findSalesOrderByOrderReference($orderReference);
    }

}
