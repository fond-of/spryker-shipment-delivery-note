<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model;

use FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteEntityManagerInterface;
use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;

class ShipmentDeliveryNoteItemsWriter implements ShipmentDeliveryNoteItemsWriterInterface
{
    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteEntityManagerInterface
     */
    protected $entityManager;

    /**
     * ShipmentDeliveryNoteAddressWriter constructor.
     *
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteEntityManagerInterface $entityManager
     */
    public function __construct(ShipmentDeliveryNoteEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    public function create(
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
    ): ShipmentDeliveryNoteTransfer {
        $shipmentDeliveryNoteTransfer->requireIdShipmentDeliveryNote();
        $shipmentDeliveryNoteTransfer->requireItems();

        foreach ($shipmentDeliveryNoteTransfer->getItems() as $shipmentDeliveryNoteItemTransfer) {
            $this->entityManager->createShipmentDeliveryNoteItem(
                $shipmentDeliveryNoteItemTransfer->setFkShipmentDeliveryNote(
                    $shipmentDeliveryNoteTransfer->getIdShipmentDeliveryNote()
                )
            );
        }

        return $shipmentDeliveryNoteTransfer;
    }
}
