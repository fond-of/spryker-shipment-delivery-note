<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model;

use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;

class ShipmentDeliveryNoteExpander implements ShipmentDeliveryNoteExpanderInterface
{
    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNoteReferenceGeneratorInterface
     */
    protected $shipmentDeliveryNoteReferenceGenerator;

    /**
     * ShipmentDeliveryNoteExpander constructor.
     *
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNoteReferenceGeneratorInterface $shipmentDeliveryNoteReferenceGenerator
     */
    public function __construct(ShipmentDeliveryNoteReferenceGeneratorInterface $shipmentDeliveryNoteReferenceGenerator)
    {
        $this->shipmentDeliveryNoteReferenceGenerator = $shipmentDeliveryNoteReferenceGenerator;
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    public function expandWithShipmentDeliveryNoteReference(ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer): ShipmentDeliveryNoteTransfer
    {
        // TODO: Implement expandWithShipmentDeliveryNoteReference() method.
    }
}
