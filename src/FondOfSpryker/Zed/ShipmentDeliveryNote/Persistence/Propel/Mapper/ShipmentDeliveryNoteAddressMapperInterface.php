<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteAddressTransfer;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteAddress;

interface ShipmentDeliveryNoteAddressMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteAddress $fosShipmentDeliveryNoteAddress
     *
     * @return \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteAddress
     */
    public function mapTransferToEntity(
        AddressTransfer $addressTransfer,
        FosShipmentDeliveryNoteAddress $fosShipmentDeliveryNoteAddress
    ): FosShipmentDeliveryNoteAddress;
}
