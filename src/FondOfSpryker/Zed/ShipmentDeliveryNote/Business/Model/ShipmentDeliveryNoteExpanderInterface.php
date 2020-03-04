<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model;

use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;

interface ShipmentDeliveryNoteExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    public function expandWithShipmentDeliveryNoteReference(
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
    ): ShipmentDeliveryNoteTransfer;
}
