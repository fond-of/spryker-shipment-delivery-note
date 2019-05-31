<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;

interface ShipmentDeliveryNoteToLocaleInterface
{

    /**
     * @param int $idLocale
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getLocaleByIdLocale(int $idLocale): LocaleTransfer;
}
