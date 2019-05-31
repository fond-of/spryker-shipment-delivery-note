<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade;

use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToLocaleInterface;
use Generated\Shared\Transfer\LocaleTransfer;

class ShipmentDeliveryNoteToLocaleBridge implements ShipmentDeliveryNoteToLocaleInterface
{
    /**
     * @var \Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @param \Spryker\Zed\Locale\Business\LocaleFacadeInterface $localeFacade
     */
    public function __construct($localeFacade)
    {
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param int $idLocale
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     *
     * @throws
     */
    public function getLocaleByIdLocale(int $idLocale): LocaleTransfer
    {
        return $this->localeFacade->getLocaleById($idLocale);
    }


}
