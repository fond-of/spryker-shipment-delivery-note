<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteAddress;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteItem;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNotePersistenceFactory getFactory()
 */
class ShipmentDeliveryNoteEntityManager extends AbstractEntityManager implements ShipmentDeliveryNoteEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    public function createShipmentDeliveryNote(
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
    ): ShipmentDeliveryNoteTransfer {
        $fosShipmentDeliveryNote = $this->getFactory()
            ->createShipmentDeliveryNoteMapper()
            ->mapTransferToEntity($shipmentDeliveryNoteTransfer, new FosShipmentDeliveryNote());

        $fosShipmentDeliveryNote->save();

        return $shipmentDeliveryNoteTransfer->setIdShipmentDeliveryNote(
            $fosShipmentDeliveryNote->getIdShipmentDeliveryNote()
        );
    }

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer
     */
    public function createShipmentDeliveryNoteAddress(
        AddressTransfer $addressTransfer
    ): AddressTransfer {
        $fosShipmentDeliveryNoteAddress = $this->getFactory()
            ->createShipmentDeliveryNoteAddressMapper()
            ->mapTransferToEntity($addressTransfer, new FosShipmentDeliveryNoteAddress());

        $fosShipmentDeliveryNoteAddress->save();

        return $addressTransfer->setIdShipmentDeliveryNoteAddress(
            $fosShipmentDeliveryNoteAddress->getIdShipmentDeliveryNoteAddress()
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ItemTransfer
     */
    public function createShipmentDeliveryNoteItem(
        ItemTransfer $itemTransfer
    ): ItemTransfer {
        $fosShipmentDeliveryNoteItem = $this->getFactory()
            ->createShipmentDeliveryNoteItemMapper()
            ->mapTransferToEntity($itemTransfer, new FosShipmentDeliveryNoteItem());

        $fosShipmentDeliveryNoteItem->save();

        return $itemTransfer->setIdShipmentDeliveryNoteItem(
            $fosShipmentDeliveryNoteItem->getIdShipmentDeliveryNoteItem()
        );
    }
}
