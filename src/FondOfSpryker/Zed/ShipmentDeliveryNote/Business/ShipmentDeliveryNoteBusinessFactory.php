<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business;

use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNote\ShipmentDeliveryNoteHydrator;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote\ShipmentDeliveryNoteReader;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote\ShipmentDeliveryNoteReaderInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToLocaleInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\ShipmentDeliveryNoteDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\ShipmentDeliveryNoteConfig getConfig()
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteRepositoryInterface getRepository()
 */
class ShipmentDeliveryNoteBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote\ShipmentDeliveryNoteReaderInterface
     */
    public function createShipmentDeliveryNoteReader(): ShipmentDeliveryNoteReaderInterface
    {
        return new ShipmentDeliveryNoteReader(
            $this->getLocaleFacade(),
            $this->getEntityManager(),
            $this->createShipmentDeliveryNoteHydrator(),
            $this->getRepository()
        );
    }
    /**
     * @return \Spryker\Zed\Sales\Business\Model\Order\OrderHydratorInterface
     */
    public function createShipmentDeliveryNoteHydrator()
    {
        return new ShipmentDeliveryNoteHydrator();
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToLocaleInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getLocaleFacade(): ShipmentDeliveryNoteToLocaleInterface
    {
        return $this->getProvidedDependency(ShipmentDeliveryNoteDependencyProvider::FACADE_LOCALE);
    }
}
