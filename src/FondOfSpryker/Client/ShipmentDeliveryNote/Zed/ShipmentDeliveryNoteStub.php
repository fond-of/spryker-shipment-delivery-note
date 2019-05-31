<?php

namespace FondOfSpryker\Client\ShipmentDeliveryNote\Zed;

use Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteResponseTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;
use Spryker\Client\ZedRequest\ZedRequestClient;

class ShipmentDeliveryNoteStub implements ShipmentDeliveryNoteStubInterface
{
    /**
     * @var \Spryker\Client\ZedRequest\ZedRequestClient
     */
    protected $zedStub;

    /**
     * @param \Spryker\Client\ZedRequest\ZedRequestClient $zedStub
     */
    public function __construct(ZedRequestClient $zedStub)
    {
        $this->zedStub = $zedStub;
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer $shipmentDeliveryNoteListTransferListTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer
     */
    public function findShipmentDeliveryNotesByOrderReference(ShipmentDeliveryNoteListTransfer $shipmentDeliveryNoteListTransferListTransfer): ShipmentDeliveryNoteListTransfer
    {/** @var \Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer $shipmentDeliveryNoteListTransfer */
        $shipmentDeliveryNoteListTransfer = $this->zedStub->call('/shipment-delivery-note/gateway/find-shipment-delivery-notes-by-order-reference', $shipmentDeliveryNoteListTransferListTransfer);

        return $shipmentDeliveryNoteListTransferListTransfer;
    }

    /**
     * @param \FondOfSpryker\Client\ShipmentDeliveryNote\Zed\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \FondOfSpryker\Client\ShipmentDeliveryNote\Zed\ShipmentDeliveryNoteResponseTransfer
     */
    public function create(ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer): ShipmentDeliveryNoteResponseTransfer
    {
        /** @var \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer */
        $shipmentDeliveryNoteResponseTransfer = $this->zedStub->call('/shipment-delivery-note/gateway/create', $shipmentDeliveryNoteTransfer);

        return $shipmentDeliveryNoteResponseTransfer;
    }

}
