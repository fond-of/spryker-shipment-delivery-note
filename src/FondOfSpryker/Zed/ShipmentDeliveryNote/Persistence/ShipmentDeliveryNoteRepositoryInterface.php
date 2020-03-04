<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence;

use Generated\Shared\Transfer\ItemTransfer;

interface ShipmentDeliveryNoteRepositoryInterface
{
    /**
     * @param int $idSalesOrderItem
     *
     * @return \Generated\Shared\Transfer\ItemTransfer|null
     */
    public function findShipmentDeliveryNoteItemByIdSalesOrderItem(int $idSalesOrderItem): ?ItemTransfer;
}
