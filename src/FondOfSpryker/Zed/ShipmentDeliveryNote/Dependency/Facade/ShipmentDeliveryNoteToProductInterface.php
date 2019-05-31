<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade;

interface ShipmentDeliveryNoteToProductInterface
{
    /**
     * @param string $sku
     *
     * @return int
     */
    public function findIdProductAbstactByConcreteSku(string $sku): int;

    /**
     * @param string $sku
     *
     * @return int
     */
    public function findProductConcreteIdBySku(string $sku): int;
}
