<?php

namespace FondOfSpryker\Client\ShipmentDeliveryNote\Zed;

use Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer;

interface ShipmentDeliveryNoteStubInterface
{
    public function findShipmentDeliveryNotesByOrderReference(ShipmentDeliveryNoteListTransfer $shipmentDeliveryNoteListTransferListTransfer): ShipmentDeliveryNoteListTransfer;

}
