<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote;

interface ShipmentDeliveryNoteMapperInterface
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
    ): FosShipmentDeliveryNote;

    /**
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote $fosShipmentDeliveryNote
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    public function mapEntityToTransfer(
        FosShipmentDeliveryNote $fosShipmentDeliveryNote,
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
    ): ShipmentDeliveryNoteTransfer;
}
