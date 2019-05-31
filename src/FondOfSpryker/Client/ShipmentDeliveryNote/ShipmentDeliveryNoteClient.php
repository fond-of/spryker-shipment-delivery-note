<?php

namespace FondOfSpryker\Client\ShipmentDeliveryNote;

use Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteResponseTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfSpryker\Client\ShipmentDeliveryNote\ShipmentDeliveryNoteFactory getFactory()
 */
class ShipmentDeliveryNoteClient extends AbstractClient implements ShipmentDeliveryNoteClientInterface
{
    public function findShipmentDeliveryNotesByOrderReference(ShipmentDeliveryNoteListTransfer $shipmentDeliveryNoteListTransfer)
    {
        return $this->getFactory()
            ->createZedShipmentDeliveryNoteStub()
            ->findShipmentDeliveryNotesByOrderReference($shipmentDeliveryNoteListTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer $shipmentDeliveryNoteListTransfer
     *
     * @return \FondOfSpryker\Client\ShipmentDeliveryNote\ShipmentDeliveryNoteResponseTransfer
     */
    public function createShipmentDeliveryNote(ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer): ShipmentDeliveryNoteResponseTransfer
    {
        return $this->getFactory()
            ->createZedShipmentDeliveryNoteStub()
            ->create($shipmentDeliveryNoteTransfer);
    }

}
