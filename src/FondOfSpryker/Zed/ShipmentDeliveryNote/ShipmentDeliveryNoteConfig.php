<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote;

use FondOfSpryker\Shared\ShipmentDeliveryNote\ShipmentDeliveryNoteConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ShipmentDeliveryNoteConfig extends AbstractBundleConfig
{
    /**
     * @return string|null
     */
    public function getEnvironmentPrefix(): ?string
    {
        return $this->get(ShipmentDeliveryNoteConstants::ENVIRONMENT_PREFIX, null);
    }
}
