<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Communication\Plugin\ShipmentDeliveryNoteExtension;

use FondOfSpryker\Zed\ShipmentDeliveryNoteExtension\Dependency\Plugin\ShipmentDeliveryNotePreSavePluginInterface;
use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNoteFacade getFacade()
 */
class AddressShipmentDeliveryNotePreSavePlugin extends AbstractPlugin implements ShipmentDeliveryNotePreSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    public function preSave(
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
    ): ShipmentDeliveryNoteTransfer {
        return $this->getFacade()->createShipmentDeliveryNoteAddress($shipmentDeliveryNoteTransfer);
    }
}
