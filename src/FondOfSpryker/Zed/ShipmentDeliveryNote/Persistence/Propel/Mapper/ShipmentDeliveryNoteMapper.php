<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote;

class ShipmentDeliveryNoteMapper implements ShipmentDeliveryNoteMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote $fosShipmentDeliveryNote
     *
     * @return \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote
     */
    public function mapTransferToEntity(
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer,
        FosShipmentDeliveryNote $fosShipmentDeliveryNote
    ): FosShipmentDeliveryNote {
        $fosShipmentDeliveryNote->fromArray(
            $shipmentDeliveryNoteTransfer->modifiedToArray(false)
        );

        $addressTransfer = $shipmentDeliveryNoteTransfer->getAddress();

        if ($addressTransfer !== null && $addressTransfer->getIdShipmentDeliveryNoteAddress() !== null) {
            $fosShipmentDeliveryNote->setFkShipmentDeliveryNoteAddress(
                $addressTransfer->getIdShipmentDeliveryNoteAddress()
            );
        }

        return $fosShipmentDeliveryNote;
    }

    /**
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote $fosShipmentDeliveryNote
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    public function mapEntityToTransfer(
        FosShipmentDeliveryNote $fosShipmentDeliveryNote,
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
    ): ShipmentDeliveryNoteTransfer {
        return $shipmentDeliveryNoteTransfer->fromArray($fosShipmentDeliveryNote->toArray(), true);
    }
}
