<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence;

use Generated\Shared\Transfer\InvoiceTransfer;
use Orm\Zed\Invoice\Persistence\FosInvoice;

interface ShipmentDeliveryNoteRepositoryInterface
{
    public function findShipmentDeliveryNotesByOrderReference(string $orderReference);
}
