<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence;

use Orm\Zed\Invoice\Persistence\FosInvoice;
use Orm\Zed\Invoice\Persistence\FosInvoiceQuery;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteQuery;
use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;

interface ShipmentDeliveryNoteQueryContainerInterface extends QueryContainerInterface
{
    /**
     * @param string $orderReference
     *
     * @return \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteQuery
     */
    public function queryShipmentDeliveryNoteByOrderReference(string $orderReference): FosShipmentDeliveryNoteQuery;

    /**
     * @param int $idShipmentDeliveryNote
     *
     * @return \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteQuery
     */
    public function queryShipmentDeliveryNoteById(int $idShipmentDeliveryNote): FosShipmentDeliveryNoteQuery;

}
