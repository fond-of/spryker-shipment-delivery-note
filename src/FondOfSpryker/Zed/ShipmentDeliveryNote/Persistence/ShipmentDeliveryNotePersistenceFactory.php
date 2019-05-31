<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence;

use Orm\Zed\Invoice\Persistence\FosShipmentDeliveryNoteAddressQuery;
use Orm\Zed\Invoice\Persistence\FosShipmentDeliveryNoteItemQuery;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\ShipmentDeliveryNoteConfig getConfig()
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteRepositoryInterface getRepository()
 */
class ShipmentDeliveryNotePersistenceFactory extends AbstractPersistenceFactory
{

    /**
     * @return \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteQuery
     */
    public function createShipmentDeliveryNoteQuery(): FosShipmentDeliveryNoteQuery
    {
        return FosShipmentDeliveryNoteQuery::create();
    }

    /**
     * @return \Orm\Zed\Invoice\Persistence\FosShipmentDeliveryNoteAddressQuery
     */
    public function createShipmentDeliveryNoteAddressQuery(): FosShipmentDeliveryNoteAddressQuery
    {
        return FosShipmentDeliveryNoteAddressQuery::create();
    }

    /**
     * @return \Orm\Zed\Invoice\Persistence\FosShipmentDeliveryNoteItemQuery
     */
    public function createShipmentDeliveryNoteItemQuery(): FosShipmentDeliveryNoteItemQuery
    {
        return FosShipmentDeliveryNoteItemQuery::create();
    }

}
