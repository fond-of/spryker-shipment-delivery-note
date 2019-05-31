<?php

namespace FondOfSpryker\Client\ShipmentDeliveryNote;

use Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer;

interface ShipmentDeliveryNoteClientInterface
{

    public function findShipmentDeliveryNotesByOrderReference(ShipmentDeliveryNoteListTransfer $shipmentDeliveryNoteListTransfer);

}
