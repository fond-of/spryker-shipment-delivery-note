<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ItemTransfer;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteItem;

class ShipmentDeliveryNoteItemMapper implements ShipmentDeliveryNoteItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteItem $fosShipmentDeliveryNoteItem
     *
     * @return \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteItem
     */
    public function mapTransferToEntity(
        ItemTransfer $itemTransfer,
        FosShipmentDeliveryNoteItem $fosShipmentDeliveryNoteItem
    ): FosShipmentDeliveryNoteItem {
        $fosShipmentDeliveryNoteItem->fromArray(
            $itemTransfer->modifiedToArray(false)
        );

        return $fosShipmentDeliveryNoteItem;
    }

    /**
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteItem $fosShipmentDeliveryNoteItem
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ItemTransfer
     */
    public function mapEntityToTransfer(
        FosShipmentDeliveryNoteItem $fosShipmentDeliveryNoteItem,
        ItemTransfer $itemTransfer
    ): ItemTransfer {
        return $itemTransfer->fromArray(
            $fosShipmentDeliveryNoteItem->toArray(),
            true
        );
    }
}
