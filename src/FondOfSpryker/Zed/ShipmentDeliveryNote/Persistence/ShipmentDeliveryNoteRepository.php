<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence;

use Generated\Shared\Transfer\ItemTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNotePersistenceFactory getFactory()
 */
class ShipmentDeliveryNoteRepository extends AbstractRepository implements ShipmentDeliveryNoteRepositoryInterface
{
    /**
     * @param int $idSalesOrderItem
     *
     * @return \Generated\Shared\Transfer\ItemTransfer|null
     */
    public function findShipmentDeliveryNoteItemByIdSalesOrderItem(int $idSalesOrderItem): ?ItemTransfer
    {
        $fosShipmentDeliveryNoteItemQuery = $this->getFactory()->createShipmentDeliveryNoteItemQuery();

        $fosShipmentDeliveryNoteItem = $fosShipmentDeliveryNoteItemQuery->filterByFkSalesOrderItem($idSalesOrderItem)
            ->findOne();

        if ($fosShipmentDeliveryNoteItem === null) {
            return null;
        }

        return $this->getFactory()->createShipmentDeliveryNoteItemMapper()->mapEntityToTransfer(
            $fosShipmentDeliveryNoteItem,
            new ItemTransfer()
        );
    }
}
