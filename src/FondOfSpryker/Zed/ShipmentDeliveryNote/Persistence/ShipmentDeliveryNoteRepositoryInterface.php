<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence;

use Generated\Shared\Transfer\InvoiceTransfer;
use Orm\Zed\Invoice\Persistence\FosInvoice;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote;

interface ShipmentDeliveryNoteRepositoryInterface
{
    public function findShipmentDeliveryNotesByOrderReference(string $orderReference);

    /**
     * @param int $idSalesOrder
     *
     * @return \Orm\Zed\Invoice\Persistence\FosInvoice|null
     */
    public function findShipmentDeliveryNoteByIdSalesOrder(int $idSalesOrder): ?FosShipmentDeliveryNote;
}
