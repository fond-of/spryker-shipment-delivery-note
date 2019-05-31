<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence;

use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNotePersistenceFactory getFactory()
 */
class ShipmentDeliveryNoteQueryContainer extends AbstractQueryContainer implements ShipmentDeliveryNoteQueryContainerInterface
{
    /**
     * @return \Orm\Zed\Invoice\Persistence\FosInvoiceQuery
     */
    public function queryShipmentDelivertyNote(): FosShipmentDeliveryNoteQuery
    {
        return $this->getFactory()->createShipmentDeliveryNoteQuery();
    }

    /**
     *
     * @param string $orderReference
     *
     * @return \Orm\Zed\Invoice\Persistence\SpyInvoiceQuery
     *
     */
    public function queryShipmentDeliveryNoteByOrderReference(string $orderReference)
    {
        return $this->queryShipmentDelivertyNote()->findOneByOrderReference($orderReference);
    }

}
