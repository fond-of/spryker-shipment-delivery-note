<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade;

class ShipmentDeliveryNoteToProductBridge implements ShipmentDeliveryNoteToProductInterface
{
    /**
     * @var \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    protected $productFacade;

    public function __construct($productFacade)
    {
        $this->productFacade = $productFacade;
    }

    /**
     * @param string $sku
     *
     * @return int
     * @throws \Spryker\Zed\Product\Business\Exception\MissingProductException
     */
    public function findIdProductAbstactByConcreteSku($sku): int
    {
        return $this->productFacade->getProductAbstractIdByConcreteSku($sku);
    }

    /**
     * @param string $sku
     *
     * @return int
     */
    public function findProductConcreteIdBySku(string $sku): int
    {
        return $this->productFacade->findProductConcreteIdBySku($sku);
    }

}
