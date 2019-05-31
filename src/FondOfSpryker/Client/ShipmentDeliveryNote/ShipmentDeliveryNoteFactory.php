<?php

namespace FondOfSpryker\Client\ShipmentDeliveryNote;

use FondOfSpryker\Client\ShipmentDeliveryNote\Zed\ShipmentDeliveryNoteStub;
use Spryker\Client\Kernel\AbstractFactory;

class ShipmentDeliveryNoteFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Client\ShipmentDeliveryNote\Zed\ShipmentDeliveryNoteStubInterface
     */
    public function createZedShipmentDeliveryNoteStub()
    {
        return new ShipmentDeliveryNoteStub(
            $this->getProvidedDependency(ShipmentDeliveryNoteDependencyProvider::SERVICE_ZED)
        );
    }
}
