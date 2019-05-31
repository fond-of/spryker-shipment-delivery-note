<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade;

interface ShipmentDeliveryNoteToCountryInterface
{

    /**
     * @param string $iso2Code
     *
     * @return \Generated\Shared\Transfer\CountryTransfer
     */
    public function getCountryByIso2Code($iso2Code);

    /**
     * @param string $iso2Code
     *
     * @return int
     */
    public function getIdRegionByIso2Code($iso2Code);
}
