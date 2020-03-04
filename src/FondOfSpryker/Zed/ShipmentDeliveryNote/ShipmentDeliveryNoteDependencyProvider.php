<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote;

use FondOfSpryker\Zed\ShipmentDeliveryNote\Communication\Plugin\ShipmentDeliveryNoteExtension\AddressShipmentDeliveryNotePreSavePlugin;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Communication\Plugin\ShipmentDeliveryNoteExtension\ItemsShipmentDeliveryNotePostSavePlugin;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Communication\Plugin\ShipmentDeliveryNoteExtension\ReferenceShipmentDeliveryNotePreSavePlugin;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToSequenceNumberFacadeBridge;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToStoreFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\ShipmentDeliveryNoteConfig getConfig()
 */
class ShipmentDeliveryNoteDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_SEQUENCE_NUMBER = 'FACADE_SEQUENCE_NUMBER';
    public const FACADE_STORE = 'FACADE_STORE';

    public const PLUGINS_POST_SAVE = 'PLUGINS_POST_SAVE';
    public const PLUGINS_PRE_SAVE = 'PLUGINS_PRE_SAVE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addSequenceNumberFacade($container);
        $container = $this->addStoreFacade($container);

        $container = $this->addShipmentDeliveryNotePreSavePlugins($container);
        $container = $this->addShipmentDeliveryNotePostSavePlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSequenceNumberFacade(Container $container): Container
    {
        $container[static::FACADE_SEQUENCE_NUMBER] = static function (Container $container) {
            return new ShipmentDeliveryNoteToSequenceNumberFacadeBridge(
                $container->getLocator()->sequenceNumber()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container): Container
    {
        $container[static::FACADE_STORE] = static function (Container $container) {
            return new ShipmentDeliveryNoteToStoreFacadeBridge(
                $container->getLocator()->store()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addShipmentDeliveryNotePreSavePlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_PRE_SAVE] = static function () use ($self) {
            return $self->getShipmentDeliveryNotePreSavePlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNoteExtension\Dependency\Plugin\ShipmentDeliveryNotePreSavePluginInterface[]
     */
    protected function getShipmentDeliveryNotePreSavePlugins(): array
    {
        return [
            new ReferenceShipmentDeliveryNotePreSavePlugin(),
            new AddressShipmentDeliveryNotePreSavePlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addShipmentDeliveryNotePostSavePlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_POST_SAVE] = static function () use ($self) {
            return $self->getShipmentDeliveryNotePostSavePlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNoteExtension\Dependency\Plugin\ShipmentDeliveryNotePostSavePluginInterface[]
     */
    protected function getShipmentDeliveryNotePostSavePlugins(): array
    {
        return [
            new ItemsShipmentDeliveryNotePostSavePlugin(),
        ];
    }
}
