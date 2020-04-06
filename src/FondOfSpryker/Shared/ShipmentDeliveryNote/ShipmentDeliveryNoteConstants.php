<?php

namespace FondOfSpryker\Shared\ShipmentDeliveryNote;

use Spryker\Shared\SequenceNumber\SequenceNumberConstants;

interface ShipmentDeliveryNoteConstants
{
    public const REFERENCE_NAME_VALUE = 'ShipmentDeliveryNoteReference';
    public const REFERENCE_PREFIX = 'SHIPMENT_DELIVERY_NOTE:REFERENCE_PREFIX';
    public const REFERENCE_ENVIRONMENT_PREFIX = SequenceNumberConstants::ENVIRONMENT_PREFIX;
    public const REFERENCE_OFFSET = 'SHIPMENT_DELIVERY_NOTE:REFERENCE_OFFSET';
}
