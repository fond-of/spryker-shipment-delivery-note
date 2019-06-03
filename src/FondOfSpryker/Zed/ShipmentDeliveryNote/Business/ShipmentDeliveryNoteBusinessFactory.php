<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business;

use FondOfSpryker\Zed\Sales\Persistence\SalesQueryContainerInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNote\ShipmentDeliveryNoteHydrator;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote\ShipmentDeliveryNoteReader;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote\ShipmentDeliveryNote;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote\ShipmentDeliveryNoteReaderInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote\ShipmentDeliveryNoteValidator;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote\ShipmentDeliveryNoteValidatorInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\TransactionStatus\TransactionStatusUpdateManager;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\TransactionStatus\TransactionStatusUpdateManagerInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToCountryInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToLocaleInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToProductInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToSalesInterface;
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
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote\ShipmentDeliveryNote
     */
    public function createShipmentDeliveryNote(): ShipmentDeliveryNote
    {
        $config = $this->getConfig();

        $shipmentDeliveryNote = new ShipmentDeliveryNote(
            $this->getProductFacade(),
            $this->getSalesFacade(),
            $this->getCountryFacade(),
            $this->getQueryContainer(),
            $config,
            $this->createShipmentDeliveryNoteValidator(),
            $this->getLocaleQueryContainer(),
            $this->getStore()
        );

        return $shipmentDeliveryNote;
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\TransactionStatus\TransactionStatusUpdateManager
     */
    public function createTransactionStatusManager(): TransactionStatusUpdateManagerInterface
    {
        return new TransactionStatusUpdateManager(
            $this->getQueryContainer(),
            $this->getRepository(),
            $this->createShipmentDeliveryNoteHydrator()
        );
    }

    /**
     * @return \Spryker\Zed\Sales\Business\Model\Order\OrderHydratorInterface
     */
    public function createShipmentDeliveryNoteHydrator()
    {
        return new ShipmentDeliveryNoteHydrator(
            $this->getQueryContainer()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote\ShipmentDeliveryNoteValidatorInterface
     */
    protected function createShipmentDeliveryNoteValidator(): ShipmentDeliveryNoteValidatorInterface
    {
        return new ShipmentDeliveryNoteValidator(
            $this->getQueryContainer(),
            $this->getSalesQueryContainer()
        );
    }

    /**
     * @return \Spryker\Zed\Locale\Persistence\LocaleQueryContainerInterface
     */
    protected function getLocaleQueryContainer()
    {
        return $this->getProvidedDependency(ShipmentDeliveryNoteDependencyProvider::QUERY_CONTAINER_LOCALE);
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

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToCountryInterface
     */
    protected function getCountryFacade(): ShipmentDeliveryNoteToCountryInterface
    {
        return $this->getProvidedDependency(ShipmentDeliveryNoteDependencyProvider::FACADE_COUNTRY);
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToProductInterface
     */
    protected function getProductFacade(): ShipmentDeliveryNoteToProductInterface
    {
        return $this->getProvidedDependency(ShipmentDeliveryNoteDependencyProvider::FACADE_PRODUCT);
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToSalesInterface
     */
    protected function getSalesFacade(): ShipmentDeliveryNoteToSalesInterface
    {
        return $this->getProvidedDependency(ShipmentDeliveryNoteDependencyProvider::FACADE_SALES);
    }

    /**
     * @return \FondOfSpryker\Zed\Sales\Persistence\SalesQueryContainerInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getSalesQueryContainer(): SalesQueryContainerInterface
    {
        return $this->getProvidedDependency(ShipmentDeliveryNoteDependencyProvider::QUERY_CONTAINER_SALES);
    }

    /**
     * @return \Spryker\Shared\Kernel\Store
     */
    protected function getStore()
    {
        return $this->getProvidedDependency(ShipmentDeliveryNoteDependencyProvider::STORE);
    }
}
