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
     * @param string $orderReference
     *
     * @return \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteQuery
     */
    public function queryShipmentDeliveryNoteByOrderReference(string $orderReference): FosShipmentDeliveryNoteQuery
    {
        return $this->queryShipmentDelivertyNote()->findOneByOrderReference($orderReference);
    }

    /**
     * @param int $idShipmentDeliveryNote
     *
     * @return \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteQuery
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function queryShipmentDeliveryNoteById(int $idShipmentDeliveryNote): FosShipmentDeliveryNoteQuery
    {
        $query = $this->queryShipmentDelivertyNote();
        $query->filterByIdShipmentDeliveryNote($idShipmentDeliveryNote);

        return $query;
    }

}
