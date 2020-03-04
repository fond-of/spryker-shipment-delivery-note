<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model;

use FondOfSpryker\Shared\ShipmentDeliveryNote\ShipmentDeliveryNoteConstants;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToSequenceNumberFacadeInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToStoreFacadeInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\ShipmentDeliveryNoteConfig;
use Generated\Shared\Transfer\SequenceNumberSettingsTransfer;

class ShipmentDeliveryNoteReferenceGenerator implements ShipmentDeliveryNoteReferenceGeneratorInterface
{
    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToSequenceNumberFacadeInterface
     */
    protected $sequenceNumberFacade;

    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\ShipmentDeliveryNoteConfig
     */
    protected $config;

    /**
     * ShipmentDeliveryNoteReferenceGenerator constructor.
     *
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToSequenceNumberFacadeInterface $sequenceNumberFacade
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToStoreFacadeInterface $storeFacade
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\ShipmentDeliveryNoteConfig $config
     */
    public function __construct(
        ShipmentDeliveryNoteToSequenceNumberFacadeInterface $sequenceNumberFacade,
        ShipmentDeliveryNoteToStoreFacadeInterface $storeFacade,
        ShipmentDeliveryNoteConfig $config
    ) {
        $this->sequenceNumberFacade = $sequenceNumberFacade;
        $this->storeFacade = $storeFacade;
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function generate(): string
    {
        $sequenceNumberSettingsTransfer = $this->getSequenceNumberSettingsTransfer();

        return $this->sequenceNumberFacade->generate($sequenceNumberSettingsTransfer);
    }

    /**
     * @return \Generated\Shared\Transfer\SequenceNumberSettingsTransfer
     */
    protected function getSequenceNumberSettingsTransfer(): SequenceNumberSettingsTransfer
    {
        return (new SequenceNumberSettingsTransfer())
            ->setName(ShipmentDeliveryNoteConstants::NAME_SHIPMENT_DELIVERY_NOTE_REFERENCE)
            ->setPrefix($this->getSequenceNumberPrefix());
    }

    /**
     * @return string
     */
    protected function getSequenceNumberPrefix(): string
    {
        $sequenceNumberPrefixParts = [
            $this->storeFacade->getCurrentStore()->getName(),
            $this->config->getEnvironmentPrefix(),
        ];

        return sprintf(
            '%s%s',
            implode($this->getUniqueIdentifierSeparator(), $sequenceNumberPrefixParts),
            $this->getUniqueIdentifierSeparator()
        );
    }

    /**
     * Separator for the sequence number
     *
     * @return string
     */
    protected function getUniqueIdentifierSeparator(): string
    {
        return '-';
    }
}
