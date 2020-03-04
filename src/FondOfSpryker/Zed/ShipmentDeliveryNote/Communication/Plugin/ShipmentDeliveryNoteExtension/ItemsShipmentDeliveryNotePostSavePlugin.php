<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Communication\Plugin\ShipmentDeliveryNoteExtension;

use FondOfSpryker\Zed\ShipmentDeliveryNoteExtension\Dependency\Plugin\ShipmentDeliveryNotePostSavePluginInterface;
use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNoteFacade getFacade()
 */
class ItemsShipmentDeliveryNotePostSavePlugin extends AbstractPlugin implements ShipmentDeliveryNotePostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    public function postSave(
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
    ): ShipmentDeliveryNoteTransfer {
        return $this->getFacade()->createShipmentDeliveryNoteItems($shipmentDeliveryNoteTransfer);
    }
}
