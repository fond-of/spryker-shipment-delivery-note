<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business;

use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNoteAddressWriter;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNoteAddressWriterInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNoteItemsWriter;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNoteItemsWriterInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNotePluginExecutor;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNotePluginExecutorInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNoteReferenceGenerator;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNoteReferenceGeneratorInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNoteWriter;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNoteWriterInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToSequenceNumberFacadeInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToStoreFacadeInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\ShipmentDeliveryNoteDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\ShipmentDeliveryNoteConfig getConfig()
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteEntityManagerInterface getEntityManager()
 */
class ShipmentDeliveryNoteBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNoteWriterInterface
     */
    public function createShipmentDeliveryNoteWriter(): ShipmentDeliveryNoteWriterInterface
    {
        return new ShipmentDeliveryNoteWriter(
            $this->getEntityManager(),
            $this->createShipmentDeliveryNotePluginExecutor()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNotePluginExecutorInterface
     */
    protected function createShipmentDeliveryNotePluginExecutor(): ShipmentDeliveryNotePluginExecutorInterface
    {
        return new ShipmentDeliveryNotePluginExecutor(
            $this->getShipmentDeliveryNotePreSavePlugins(),
            $this->getShipmentDeliveryNotePostSavePlugins()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNoteAddressWriterInterface
     */
    public function createShipmentDeliveryNoteAddressWriter(): ShipmentDeliveryNoteAddressWriterInterface
    {
        return new ShipmentDeliveryNoteAddressWriter($this->getEntityManager());
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNoteItemsWriterInterface
     */
    public function createShipmentDeliveryNoteItemsWriter(): ShipmentDeliveryNoteItemsWriterInterface
    {
        return new ShipmentDeliveryNoteItemsWriter($this->getEntityManager());
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNoteReferenceGeneratorInterface
     */
    public function createShipmentDeliveryNoteReferenceGenerator(): ShipmentDeliveryNoteReferenceGeneratorInterface
    {
        return new ShipmentDeliveryNoteReferenceGenerator(
            $this->getSequenceNumberFacade(),
            $this->getStoreFacade(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNoteExtension\Dependency\Plugin\ShipmentDeliveryNotePreSavePluginInterface]|
     */
    protected function getShipmentDeliveryNotePreSavePlugins(): array
    {
        return $this->getProvidedDependency(ShipmentDeliveryNoteDependencyProvider::PLUGINS_PRE_SAVE);
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNoteExtension\Dependency\Plugin\ShipmentDeliveryNotePostSavePluginInterface[]
     */
    protected function getShipmentDeliveryNotePostSavePlugins(): array
    {
        return $this->getProvidedDependency(ShipmentDeliveryNoteDependencyProvider::PLUGINS_POST_SAVE);
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToSequenceNumberFacadeInterface
     */
    protected function getSequenceNumberFacade(): ShipmentDeliveryNoteToSequenceNumberFacadeInterface
    {
        return $this->getProvidedDependency(ShipmentDeliveryNoteDependencyProvider::FACADE_SEQUENCE_NUMBER);
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToStoreFacadeInterface
     */
    protected function getStoreFacade(): ShipmentDeliveryNoteToStoreFacadeInterface
    {
        return $this->getProvidedDependency(ShipmentDeliveryNoteDependencyProvider::FACADE_STORE);
    }
}
