<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote;

use FondOfSpryker\Shared\ShipmentDeliveryNote\ShipmentDeliveryNoteConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ShipmentDeliveryNoteConfig extends AbstractBundleConfig
{
    /**
     * @return string|null
     */
    public function getReferenceEnvironmentPrefix(): ?string
    {
        return $this->get(ShipmentDeliveryNoteConstants::REFERENCE_ENVIRONMENT_PREFIX, null);
    }

    /**
     * @return string|null
     */
    public function getReferencePrefix(): ?string
    {
        return $this->get(ShipmentDeliveryNoteConstants::REFERENCE_PREFIX, null);
    }

    /**
     * @return string|null
     */
    public function getReferenceOffset(): ?string
    {
        return $this->get(ShipmentDeliveryNoteConstants::REFERENCE_OFFSET, null);
    }
}
