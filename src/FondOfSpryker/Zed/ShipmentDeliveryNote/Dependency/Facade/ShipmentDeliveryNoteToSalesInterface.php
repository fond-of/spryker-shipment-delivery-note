<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade;

use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface ShipmentDeliveryNoteToSalesInterface
{
    /**
     * @param string $orderReference
     *
     * @return int
     */
    public function findSalesOrderByOrderReference(string $orderReference);
}
