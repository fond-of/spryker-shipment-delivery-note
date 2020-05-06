<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model;

use FondOfSpryker\Shared\ShipmentDeliveryNote\ShipmentDeliveryNoteConstants;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToSequenceNumberFacadeInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToStoreFacadeInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\ShipmentDeliveryNoteConfig;
use Generated\Shared\Transfer\SequenceNumberSettingsTransfer;

class ShipmentDeliveryNoteReferenceGenerator implements ShipmentDeliveryNoteReferenceGeneratorInterface
{
    protected const UNIQUE_IDENTIFIER_SEPARATOR = '-';

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
        $sequenceNumberSettingsTransfer = (new SequenceNumberSettingsTransfer())
            ->setName(ShipmentDeliveryNoteConstants::REFERENCE_NAME_VALUE)
            ->setPrefix($this->getSequenceNumberPrefix());

        if ($this->config->getReferenceOffset() === null) {
            return $sequenceNumberSettingsTransfer;
        }

        return $sequenceNumberSettingsTransfer->setOffset($this->config->getReferenceOffset());
    }

    /**
     * @return string
     */
    protected function getSequenceNumberPrefix(): string
    {
        $sequenceNumberPrefixParts = [
            $this->storeFacade->getCurrentStore()->getName(),
        ];

        $referencePrefix = $this->config->getReferencePrefix();

        if ($referencePrefix !== null && $referencePrefix !== '') {
            $sequenceNumberPrefixParts[0] = $referencePrefix;
        }

        $referenceEnvironmentPrefix = $this->config->getReferenceEnvironmentPrefix();

        if ($referenceEnvironmentPrefix !== null && $referenceEnvironmentPrefix !== '') {
            $sequenceNumberPrefixParts[] = $this->config->getReferenceEnvironmentPrefix();
        }

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
        return static::UNIQUE_IDENTIFIER_SEPARATOR;
    }
}
