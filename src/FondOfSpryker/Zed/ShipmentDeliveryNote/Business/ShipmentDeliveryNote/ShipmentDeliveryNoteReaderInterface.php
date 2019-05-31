<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote;

use Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer;

interface ShipmentDeliveryNoteReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer $shipmentDeliveryNoteListTransfer
     * @param string $orderReference
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer
     */
    public function findShipmentDeliveryNotesByOrderReference(
        ShipmentDeliveryNoteListTransfer $shipmentDeliveryNoteListTransfer,
        string $orderReference): ShipmentDeliveryNoteListTransfer;
}
