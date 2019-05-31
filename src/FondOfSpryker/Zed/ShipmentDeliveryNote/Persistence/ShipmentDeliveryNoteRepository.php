<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence;

use FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteRepositoryInterface;
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
}
