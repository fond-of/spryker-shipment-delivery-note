<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Communication\Controller;

use Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteResponseTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNoteFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Communication\ShipmentDeliveryNoteCommunicationFactory getFactory()
 */
class GatewayController extends AbstractGatewayController
{

    public function findShipmentDeliveryNotesByOrderReferenceAction(ShipmentDeliveryNoteListTransfer $shipmentDeliveryNoteListTransfer)
    {
        return $this->getFacade()->findShipmentDeliveryNotesByOrderReference($shipmentDeliveryNoteListTransfer, $shipmentDeliveryNoteListTransfer->getOrderReference());
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteResponseTransfer
     */
    public function createAction(ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer): ShipmentDeliveryNoteResponseTransfer
    {
        return $this->getFacade()->createShipmentDeliveryNote($shipmentDeliveryNoteTransfer);
    }

}
