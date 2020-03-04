<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade;

use Generated\Shared\Transfer\SequenceNumberSettingsTransfer;

interface ShipmentDeliveryNoteToSequenceNumberFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\SequenceNumberSettingsTransfer $sequenceNumberSettingsTransfer
     *
     * @return string
     */
    public function generate(SequenceNumberSettingsTransfer $sequenceNumberSettingsTransfer): string;
}
