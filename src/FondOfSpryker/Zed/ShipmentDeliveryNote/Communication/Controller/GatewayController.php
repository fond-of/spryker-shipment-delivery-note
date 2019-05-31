<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Communication\Controller;

use Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfSpyker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNoteFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Communication\ShipmentDeliveryNoteCommunicationFactory getFactory()
 */
class GatewayController extends AbstractGatewayController
{

    public function findShipmentDeliveryNotesByOrderReferenceAction(ShipmentDeliveryNoteListTransfer $shipmentDeliveryNoteListTransfer)
    {
        return $this->getFacade()->findShipmentDeliveryNotesByOrderReference($shipmentDeliveryNoteListTransfer, $shipmentDeliveryNoteListTransfer->getOrderReference());
    }

}
