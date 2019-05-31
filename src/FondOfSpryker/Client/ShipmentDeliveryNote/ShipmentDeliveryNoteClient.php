<?php

namespace FondOfSpryker\Client\ShipmentDeliveryNote;

use Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer;
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


}
