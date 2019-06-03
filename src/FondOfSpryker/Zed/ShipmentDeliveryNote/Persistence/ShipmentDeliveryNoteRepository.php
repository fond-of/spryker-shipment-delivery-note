<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence;

use FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteRepositoryInterface;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNotePersistenceFactory getFactory()
 */
class ShipmentDeliveryNoteRepository extends AbstractRepository implements ShipmentDeliveryNoteRepositoryInterface
{
    public function findShipmentDeliveryNotesByOrderReference(string $orderReference)
    {
        return $this->getFactory()
            ->createShipmentDeliveryNoteQuery()
            ->findByOrderReference($orderReference);
    }

    /**
     * @param int $idSalesOrder
     *
     * @return \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote|null
     */
    public function findShipmentDeliveryNoteByIdSalesOrder(int $idSalesOrder): ?FosShipmentDeliveryNote
    {
        return $this->getFactory()
            ->createShipmentDeliveryNoteQuery()
            ->findOneByFkSalesOrder($idSalesOrder);
    }
}
