<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model;

interface ShipmentDeliveryNoteReferenceGeneratorInterface
{
    /**
     * @return string
     */
    public function generate(): string;
}
