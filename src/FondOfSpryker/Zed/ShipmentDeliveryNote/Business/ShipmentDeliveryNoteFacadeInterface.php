<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business;

use Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteResponseTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;

interface ShipmentDeliveryNoteFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer $shipmentDeliveryNoteListTransfer
     * @param string $orderReference
     *
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNoteResponseTransfer
     */
    public function findShipmentDeliveryNotesByOrderReference(
        ShipmentDeliveryNoteListTransfer $shipmentDeliveryNoteListTransfer,
        string $orderReference): ShipmentDeliveryNoteListTransfer;

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteResponseTransfer
     */
    public function createShipmentDeliveryNote(ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer): ShipmentDeliveryNoteResponseTransfer;

    /**
     * Specification:
     * - Checks if Shipment Delivery Note is Created
     *
     * @api
     *
     * @param int $idSalesOrder
     * @param int $idSalesOrderItem
     *
     * @return bool
     */
    public function isShipmentDeliveryNoteAppointed($idSalesOrder, $idSalesOrderItem): bool;

}
