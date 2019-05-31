<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote;

interface ShipmentDeliveryNoteValidatorInterface
{
    /**
     * @param string $orderReference
     *
     * @return bool
     */
    public function isOrderReferenceValid(string $orderReference): bool;
}
