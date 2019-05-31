<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote;

use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToCountryBridge;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToLocaleBridge;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToProductBridge;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToSalesBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Kernel\Container;

/**
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\ShipmentDeliveryNoteConfig getConfig()
 */
class ShipmentDeliveryNoteDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_COUNTRY = 'FACADE_COUNTRY';
    public const FACADE_LOCALE = 'FACADE_LOCALE';
    public const FACADE_PRODUCT = 'FACADE_PRODUCT';
    public const FACADE_SALES = 'FACADE_SALES';

    public const QUERY_CONTAINER_LOCALE = 'QUERY_CONTAINER_LOCALE';
    public const QUERY_CONTAINER_SALES = 'QUERY_CONTAINER_SALES';

    public const STORE = 'STORE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = $this->addLocaleQueryConainer($container);
        $container = $this->addSalesQueryConainer($container);
        $container = $this->addStore($container);
        $container = $this->addCountryFacade($container);
        $container = $this->addLocaleFacade($container);
        $container = $this->addProductFacade($container);
        $container = $this->addSalesFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStore(Container $container)
    {
        $container[static::STORE] = function (Container $container) {
            return Store::getInstance();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addLocaleFacade(Container $container)
    {
        $container[static::FACADE_LOCALE] = function (Container $container) {
            return new ShipmentDeliveryNoteToLocaleBridge($container->getLocator()->locale()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductFacade(Container $container)
    {
        $container[static::FACADE_PRODUCT] = function (Container $container) {
            return new ShipmentDeliveryNoteToLocaleBridge($container->getLocator()->product()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCountryFacade(Container $container): Container
    {
        $container[static::FACADE_COUNTRY] = function (Container $container) {
            return new ShipmentDeliveryNoteToCountryBridge($container->getLocator()->country()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSalesFacade(Container $container): Container
    {
        $container[static::FACADE_SALES] = function (Container $container) {
            return new ShipmentDeliveryNoteToSalesBridge($container->getLocator()->sales()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addLocaleQueryConainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_LOCALE] = function (Container $container) {
            return $container->getLocator()->locale()->queryContainer();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSalesQueryConainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_SALES] = function (Container $container) {
            return $container->getLocator()->sales()->queryContainer();
        };

        return $container;
    }

}
