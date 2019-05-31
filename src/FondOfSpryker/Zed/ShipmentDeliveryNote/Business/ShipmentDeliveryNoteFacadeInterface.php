<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business;

use Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteResponseTransfer;

interface ShipmentDeliveryNoteFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer $shipmentDeliveryNoteListTransfer
     * @param string $orderReference
     *
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNoteResponseTransfer
     */
    public function findShipmentDeliveryNotesByOrderReference(
        ShipmentDeliveryNoteListTransfer $shipmentDeliveryNoteListTransfer,
        string $orderReference): ShipmentDeliveryNoteListTransfer;

}
