<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\AddressTransfer;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteAddress;

class ShipmentDeliveryNoteAddressMapper implements ShipmentDeliveryNoteAddressMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteAddressTransfer $shipmentDeliveryNoteAddressTransfer
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteAddress $fosShipmentDeliveryNoteAddress
     *
     * @return \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteAddress
     */
    public function mapTransferToEntity(
        AddressTransfer $addressTransfer,
        FosShipmentDeliveryNoteAddress $fosShipmentDeliveryNoteAddress
    ): FosShipmentDeliveryNoteAddress {
        $fosShipmentDeliveryNoteAddress->fromArray(
            $addressTransfer->modifiedToArray(false)
        );

        return $fosShipmentDeliveryNoteAddress;
    }
}
