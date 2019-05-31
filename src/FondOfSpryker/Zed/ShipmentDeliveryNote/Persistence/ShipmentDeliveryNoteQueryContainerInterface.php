<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence;

use Orm\Zed\Invoice\Persistence\FosInvoice;
use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;

interface ShipmentDeliveryNoteQueryContainerInterface extends QueryContainerInterface
{

    public function queryShipmentDeliveryNoteByOrderReference(string $orderReference);

}
