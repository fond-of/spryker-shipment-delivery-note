<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNote;


use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote;

interface ShipmentDeliveryNoteHydratorInterface
{
    /**
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote $shipmentDeliveryNoteEntity
     * 
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    public function hydrateShipmentDeliveryNoteTransferFromPersistenceByShipmentDeliveryNote(FosShipmentDeliveryNote $shipmentDeliveryNoteEntity): ShipmentDeliveryNoteTransfer;
}


