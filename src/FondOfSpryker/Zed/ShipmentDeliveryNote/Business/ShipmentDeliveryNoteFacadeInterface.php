<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business;

use Generated\Shared\Transfer\ShipmentDeliveryNoteResponseTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;

interface ShipmentDeliveryNoteFacadeInterface
{
    /**
     * Specification:
     * - Creates shipment delivery note
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteResponseTransfer
     */
    public function createShipmentDeliveryNote(
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
    ): ShipmentDeliveryNoteResponseTransfer;

    /**
     * Specification:
     * - Creates shipment delivery note address
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    public function createShipmentDeliveryNoteAddress(
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
    ): ShipmentDeliveryNoteTransfer;

    /**
     * Specification:
     * - Creates shipment delivery note items
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    public function createShipmentDeliveryNoteItems(
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
    ): ShipmentDeliveryNoteTransfer;

    /**
     * Specification:
     * - Creates shipment delivery note reference
     *
     * @api
     *
     * @return string
     */
    public function createShipmentDeliveryNoteReference(): string;
}
