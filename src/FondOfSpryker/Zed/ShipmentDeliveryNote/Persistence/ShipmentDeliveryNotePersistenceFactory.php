<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence;

use FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\Propel\Mapper\ShipmentDeliveryNoteAddressMapper;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\Propel\Mapper\ShipmentDeliveryNoteAddressMapperInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\Propel\Mapper\ShipmentDeliveryNoteItemMapper;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\Propel\Mapper\ShipmentDeliveryNoteItemMapperInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\Propel\Mapper\ShipmentDeliveryNoteMapper;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\Propel\Mapper\ShipmentDeliveryNoteMapperInterface;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteItemQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\ShipmentDeliveryNoteConfig getConfig()
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteEntityManagerInterface getEntityManager()
 */
class ShipmentDeliveryNotePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteItemQuery
     */
    public function createShipmentDeliveryNoteItemQuery(): FosShipmentDeliveryNoteItemQuery
    {
        return FosShipmentDeliveryNoteItemQuery::create();
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\Propel\Mapper\ShipmentDeliveryNoteMapperInterface
     */
    public function createShipmentDeliveryNoteMapper(): ShipmentDeliveryNoteMapperInterface
    {
        return new ShipmentDeliveryNoteMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\Propel\Mapper\ShipmentDeliveryNoteAddressMapperInterface
     */
    public function createShipmentDeliveryNoteAddressMapper(): ShipmentDeliveryNoteAddressMapperInterface
    {
        return new ShipmentDeliveryNoteAddressMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\Propel\Mapper\ShipmentDeliveryNoteItemMapperInterface
     */
    public function createShipmentDeliveryNoteItemMapper(): ShipmentDeliveryNoteItemMapperInterface
    {
        return new ShipmentDeliveryNoteItemMapper();
    }
}
