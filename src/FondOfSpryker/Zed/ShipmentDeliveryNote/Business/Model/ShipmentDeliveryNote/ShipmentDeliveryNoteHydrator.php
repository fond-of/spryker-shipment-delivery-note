<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNote;

use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNote\ShipmentDeliveryNoteHydratorInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteQueryContainerInterface;
use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteAddressTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteItemTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;
use Orm\Zed\Country\Persistence\SpyCountry;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteItem;

class ShipmentDeliveryNoteHydrator implements ShipmentDeliveryNoteHydratorInterface
{
    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * ShipmentDeliveryNoteHydrator constructor.
     *
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteQueryContainerInterface $queryContainer
     */
    public function __construct(
        ShipmentDeliveryNoteQueryContainerInterface $queryContainer
    ) {
        $this->queryContainer = $queryContainer;
    }

    /**
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote $shipmentDeliveryNoteEntity
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    public function hydrateShipmentDeliveryNoteTransferFromPersistenceByShipmentDeliveryNote(FosShipmentDeliveryNote $shipmentDeliveryNoteEntity): ShipmentDeliveryNoteTransfer
    {
        return $this->applyShipmentDeliveryNoteTransferHydrators($shipmentDeliveryNoteEntity);
    }

    /**
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote $shipmentDeliveryNoteEntity
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    protected function applyShipmentDeliveryNoteTransferHydrators(FosShipmentDeliveryNote $shipmentDeliveryNoteEntity): ShipmentDeliveryNoteTransfer
    {
        $shipmentDeliveryNoteTransfer = $this->hydrateBaseShipmentDeliveryNoteTransfer($shipmentDeliveryNoteEntity);
        $this->hydrateShipmentDeliveryNoteAddressToShipmentDeliveryNoteTransfer($shipmentDeliveryNoteEntity, $shipmentDeliveryNoteTransfer);
        $this->hydrateShipmentDeliveryNoteItemsToShipmentDeliveryNoteTransfer($shipmentDeliveryNoteEntity, $shipmentDeliveryNoteTransfer);

        return $shipmentDeliveryNoteTransfer;
    }

    /**
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote $shipmentDeliveryNoteEntity
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    public function hydrateBaseShipmentDeliveryNoteTransfer(FosShipmentDeliveryNote $shipmentDeliveryNoteEntity): ShipmentDeliveryNoteTransfer
    {
        $shipmentDeliveryNoteTransfer = new ShipmentDeliveryNoteTransfer();
        $shipmentDeliveryNoteTransfer->fromArray($shipmentDeliveryNoteEntity->toArray(), true);

        return $shipmentDeliveryNoteTransfer;
    }

    /**
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote $shipmentDeliveryNoteEntity
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     */
    protected function hydrateShipmentDeliveryNoteAddressToShipmentDeliveryNoteTransfer(
        FosShipmentDeliveryNote $shipmentDeliveryNoteEntity,
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer): void
    {
        $countryEntity = $shipmentDeliveryNoteEntity->getAddress()->getCountry();

        $addressTransfer = new ShipmentDeliveryNoteAddressTransfer();
        $addressTransfer->fromArray($shipmentDeliveryNoteEntity->getAddress()->toArray(), true);
        $this->hydrateCountryEntityIntoAddressTransfer($addressTransfer, $countryEntity);

        $shipmentDeliveryNoteTransfer->setAddress($addressTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteAddressTransfer $addressTransfer
     *
     * @param \Orm\Zed\Country\Persistence\SpyCountry $countryEntity
     */
    protected function hydrateCountryEntityIntoAddressTransfer(ShipmentDeliveryNoteAddressTransfer $addressTransfer, SpyCountry $countryEntity): void
    {
        $countryTransfer = (new CountryTransfer())->fromArray($countryEntity->toArray(), true);
        $addressTransfer->setCountry($countryTransfer);
    }

    /**
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote $shipmentDeliveryNoteEntity
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function hydrateShipmentDeliveryNoteItemsToShipmentDeliveryNoteTransfer(
        FosShipmentDeliveryNote $shipmentDeliveryNoteEntity,
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer): void
    {
        foreach ($shipmentDeliveryNoteEntity->getItems() as $shipmentDeliveryNoteItemEntity) {
            $itemTransfer = $this->hydrateShipmentDeliveryNoteItemTransfer($shipmentDeliveryNoteItemEntity);
            $shipmentDeliveryNoteTransfer->addShipmentDeliveryNoteItem($itemTransfer);
        }

    }

    /**
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteItem $shipmentDeliveryNoteItemEntity
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteItemTransfer
     */
    protected function hydrateShipmentDeliveryNoteItemTransfer(FosShipmentDeliveryNoteItem $shipmentDeliveryNoteItemEntity): ShipmentDeliveryNoteItemTransfer
    {
        $itemTransfer = new ShipmentDeliveryNoteItemTransfer();
        $itemTransfer->fromArray($shipmentDeliveryNoteItemEntity->toArray(), true);

        return $itemTransfer;
    }

}

