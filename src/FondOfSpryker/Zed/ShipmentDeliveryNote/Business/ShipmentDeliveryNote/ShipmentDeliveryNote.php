<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote;


use FondOfSpryker\Shared\ShipmentDeliveryNote\Code\Messages;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote\ShipmentDeliveryNoteInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToCountryInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToProductInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToSalesInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteQueryContainerInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\ShipmentDeliveryNoteConfig;
use Generated\Shared\Transfer\ShipmentDeliveryNoteAddressTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteItemTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteResponseTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteAddress;
use Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteItem;
use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Locale\Persistence\LocaleQueryContainerInterface;


class ShipmentDeliveryNote implements ShipmentDeliveryNoteInterface
{
    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToProductInterface
     */
    protected $productFacade;

    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToSalesInterface
     */
    protected $salesFacade;

    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToCountryInterface
     */
    protected $countryFacade;

    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\ShipmentDeliveryNoteConfig
     */
    protected $shipmentDeliveryNoteConfig;

    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote\ShipmentDeliveryNoteValidatorInterface
     */
    protected $shipmentDeliveryNoteValidator;

    /**
     * @var \Spryker\Zed\Locale\Persistence\LocaleQueryContainerInterface
     */
    protected $localeQueryContainer;

    /**
     * @var \Spryker\Shared\Kernel\Store
     */
    protected $store;

    /**
     * ShipmentDeliveryNote constructor.
     *
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToProductInterface $productFacade
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToSalesInterface $salesFacade
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToCountryInterface $countryFacade
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteQueryContainerInterface $queryContainer
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\ShipmentDeliveryNoteConfig $shipmentDeliveryNoteConfig
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote\ShipmentDeliveryNoteValidatorInterface $shipmentDeliveryNoteValidator
     * @param \Spryker\Zed\Locale\Persistence\LocaleQueryContainerInterface $localeQueryContainer
     * @param \Spryker\Shared\Kernel\Store $store
     */
    public function __construct(
        ShipmentDeliveryNoteToProductInterface $productFacade,
        ShipmentDeliveryNoteToSalesInterface $salesFacade,
        ShipmentDeliveryNoteToCountryInterface $countryFacade,
        ShipmentDeliveryNoteQueryContainerInterface $queryContainer,
        ShipmentDeliveryNoteConfig $shipmentDeliveryNoteConfig,
        ShipmentDeliveryNoteValidatorInterface $shipmentDeliveryNoteValidator,
        LocaleQueryContainerInterface $localeQueryContainer,
        Store $store
    ) {
        $this->countryFacade = $countryFacade;
        $this->productFacade = $productFacade;
        $this->salesFacade = $salesFacade;
        $this->queryContainer = $queryContainer;
        $this->shipmentDeliveryNoteConfig = $shipmentDeliveryNoteConfig;
        $this->shipmentDeliveryNoteValidator = $shipmentDeliveryNoteValidator;
        $this->localeQueryContainer = $localeQueryContainer;
        $this->store = $store;
    }


    /**
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote\ShipmentDeliveryNoteResponseTransfer
     */
    public function create(ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer): ShipmentDeliveryNoteResponseTransfer
    {
        $shipmentDeliveryNoteResponseTransfer = $this->add($shipmentDeliveryNoteTransfer);

        if (!$shipmentDeliveryNoteResponseTransfer->getIsSuccess()) {
            return $shipmentDeliveryNoteResponseTransfer;
        }

        return $shipmentDeliveryNoteResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceResponseTransfer
     */
    protected function add(ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer): ShipmentDeliveryNoteResponseTransfer
    {
        $shipmentDeliveryNoteEntity = new FosShipmentDeliveryNote();
        $shipmentDeliveryNoteEntity->fromArray($shipmentDeliveryNoteTransfer->toArray());

        $shipmentDeliveryNoteResponseTransfer = $this->createShipmentDeliveryNoteResponseTransfer();
        $shipmentDeliveryNoteResponseTransfer = $this->validateOrderReference($shipmentDeliveryNoteResponseTransfer, $shipmentDeliveryNoteEntity);

        if ($shipmentDeliveryNoteResponseTransfer->getIsSuccess() !== true) {
            return $shipmentDeliveryNoteResponseTransfer;
        }

        $shipmentDeliveryNoteEntity = $this->saveShipmentDeliveryNoteTransaction($shipmentDeliveryNoteTransfer);


        $shipmentDeliveryNoteTransfer->setIdShipmentDeliveryNote($shipmentDeliveryNoteEntity->getPrimaryKey());
        $shipmentDeliveryNoteTransfer->setCreatedAt($shipmentDeliveryNoteEntity->getCreatedAt()->format("Y-m-d H:i:s.u"));
        $shipmentDeliveryNoteTransfer->setUpdatedAt($shipmentDeliveryNoteEntity->getUpdatedAt()->format("Y-m-d H:i:s.u"));

        $shipmentDeliveryNoteResponseTransfer
            ->setIsSuccess(true)
            ->setShipmentDeliveryNoteTransfer($shipmentDeliveryNoteTransfer);

        return $shipmentDeliveryNoteResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    public function findById(ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer): ShipmentDeliveryNoteTransfer
    {
        $shipmentDeliveryNoteEntity = $this->queryContainer
            ->queryShipmentDeliveryNoteById($shipmentDeliveryNoteTransfer->getIdShipmentDeliveryNote())
            ->findOne();

        if ($shipmentDeliveryNoteEntity === null) {
            return null;
        }

        $shipmentDeliveryNoteTransfer = $this->hydrateShipmentDeliveryNoteTransferFromEntity($shipmentDeliveryNoteTransfer, $shipmentDeliveryNoteEntity);

        return $shipmentDeliveryNoteTransfer;
    }

    /**
     * @param bool $isSuccess
     *
     * @return \Generated\Shared\Transfer\InvoiceResponseTransfer
     */
    protected function createShipmentDeliveryNoteResponseTransfer($isSuccess = true)
    {
        $shipmentDeliveryNoteResponseTransfer = new ShipmentDeliveryNoteResponseTransfer();
        $shipmentDeliveryNoteResponseTransfer->setIsSuccess($isSuccess);

        return $shipmentDeliveryNoteResponseTransfer;
    }

    /**
     * @param string $message
     *
     * @return \Generated\Shared\Transfer\CustomerErrorTransfer
     */
    protected function createErrorInvoiceResponseTransfer($message)
    {
        $invoiceErrorTransfer = new InvoiceErrorTransfer();
        $invoiceErrorTransfer->setMessage($message);

        return $invoiceErrorTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteResponseTransfer $shipmentDeliveryNoteResponseTransfer
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote $shipmentDeliveryNoteEntity
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteResponseTransfer
     */
    protected function validateOrderReference(
        ShipmentDeliveryNoteResponseTransfer $shipmentDeliveryNoteResponseTransfer,
        FosShipmentDeliveryNote $shipmentDeliveryNoteEntity): ShipmentDeliveryNoteResponseTransfer
    {
        if (!$this->shipmentDeliveryNoteValidator->isOrderReferenceValid($shipmentDeliveryNoteEntity->getOrderReference())) {
            $shipmentDeliveryNoteResponseTransfer = $this->addErrorToShipmentDeliveryNoteResponseTransfer(
                $shipmentDeliveryNoteResponseTransfer,
                Messages::SALES_ORDER_REFERENCE_NOT_FOUND
            );
        }

        return $shipmentDeliveryNoteResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\InvoiceResponseTransfer $invoiceResponseTransfer
     * @param string $message
     *
     * @return \Generated\Shared\Transfer\InvoiceResponseTransfer
     */
    protected function addErrorToShipmentDeliveryNoteResponseTransfer(InvoiceResponseTransfer $invoiceResponseTransfer, string $message): InvoiceResponseTransfer
    {
        $invoiceResponseTransfer->setIsSuccess(false);
        $invoiceResponseTransfer->addError(
            $this->createErrorInvoiceResponseTransfer($message)
        );

        return $invoiceResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote
     */
    protected function saveShipmentDeliveryNoteTransaction(ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer): FosShipmentDeliveryNote
    {
        $shipmentDeliveryNoteEntity = $this->saveShipmentDeliveryNoteEntity($shipmentDeliveryNoteTransfer);

        $this->saveShipmentDeliveryNoteItems($shipmentDeliveryNoteTransfer, $shipmentDeliveryNoteEntity);

        return $shipmentDeliveryNoteEntity;
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote
     */
    protected function saveShipmentDeliveryNoteEntity(ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer): FosShipmentDeliveryNote
    {
        $shipmentDeliveryNoteEntity = $this->createShipmentDeliveryNoteEntity();
        $this->hydrateAddress($shipmentDeliveryNoteTransfer, $shipmentDeliveryNoteEntity);
        $this->hydrateShipmentDeliveryNoteEntity($shipmentDeliveryNoteTransfer, $shipmentDeliveryNoteEntity);

        $shipmentDeliveryNoteEntity->save();

        return $shipmentDeliveryNoteEntity;
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote $shipmentDeliveryNoteEntity
     */
    protected function hydrateAddress(ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer, FosShipmentDeliveryNote $shipmentDeliveryNoteEntity): void
    {
        $addressEntity = $this->saveShipmentDeliveryNoteAddress($shipmentDeliveryNoteTransfer->getAddress());

        $shipmentDeliveryNoteEntity->setAddress($addressEntity);
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote $shipmentDeliveryNoteEntity
     */
    protected function hydrateShipmentDeliveryNoteEntity(ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer, FosShipmentDeliveryNote $shipmentDeliveryNoteEntity): void
    {
        $shipmentDeliveryNoteEntity->fromArray($shipmentDeliveryNoteTransfer->toArray());
        $shipmentDeliveryNoteEntity->setFkSalesOrder($this->getIdSalesOrder($shipmentDeliveryNoteTransfer->getOrderReference()));
        $shipmentDeliveryNoteEntity->setOrderReference($shipmentDeliveryNoteTransfer->getOrderReference());
        $shipmentDeliveryNoteEntity->setCustomerReference($shipmentDeliveryNoteTransfer->getCustomerReference());
        $shipmentDeliveryNoteEntity->setFkShipmentDeliveryNoteAddress($shipmentDeliveryNoteTransfer->getAddress()->getIdShipmentDeliveryNoteAddress());
        $shipmentDeliveryNoteEntity->setStore($shipmentDeliveryNoteTransfer->getStore());
        $shipmentDeliveryNoteEntity->setFkLocale($this->getIdLocale($shipmentDeliveryNoteTransfer));
        $shipmentDeliveryNoteEntity->setCurrencyIsoCode($shipmentDeliveryNoteTransfer->getCurrency());
    }


    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteAddressTransfer $shipmentDeliveryNoteAddressTransfer
     *
     * @return \Orm\Zed\Invoice\Persistence\FosShipmentDeliveryNoteAddress
     */
    protected function saveShipmentDeliveryNoteAddress(ShipmentDeliveryNoteAddressTransfer $shipmentDeliveryNoteAddressTransfer): FosShipmentDeliveryNoteAddress
    {
        $shipmentDeliveryNoteAddressEntity = $this->createShipmentDeliveryNoteAddressEntity();
        $this->hydrateShipmentDeliveryNoteAddress($shipmentDeliveryNoteAddressTransfer, $shipmentDeliveryNoteAddressEntity);

        $shipmentDeliveryNoteAddressEntity->save();

        $shipmentDeliveryNoteAddressTransfer->setIdShipmentDeliveryNoteAddress($shipmentDeliveryNoteAddressEntity->getIdShipmentDeliveryNoteAddress());

        return $shipmentDeliveryNoteAddressEntity;
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteAddressTransfer $addressTransfer
     * @param \Orm\Zed\Invoice\Persistence\FosShipmentDeliveryNoteAddress $shipmentDeliveryNoteAddressEntity
     */
    protected function hydrateShipmentDeliveryNoteAddress(
        ShipmentDeliveryNoteAddressTransfer $addressTransfer,
        FosShipmentDeliveryNoteAddress $shipmentDeliveryNoteAddressEntity): void
    {
        $shipmentDeliveryNoteAddressEntity->fromArray($addressTransfer->toArray());

        $shipmentDeliveryNoteAddressEntity->setFkCountry(
            $this->countryFacade->getCountryByIso2Code($addressTransfer->getCountry())->getIdCountry()
        );

        if ($addressTransfer->getRegion() != null) {
            $shipmentDeliveryNoteAddressEntity->setFkRegion(
                $this->countryFacade->getIdRegionByIso2Code($addressTransfer->getRegion())
            );
        }
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote $shipmentDeliveryNoteEntity
     */
    protected function saveShipmentDeliveryNoteItems(ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer, FosShipmentDeliveryNote $shipmentDeliveryNoteEntity): void
    {
        foreach ($shipmentDeliveryNoteTransfer->getItems() as $itemTransfer) {
            $shipmentDeliveryNoteItemEntity = $this->createShipmentDeliveryNoteItemEntity();
            $this->hydrateShipmentDeliveryNoteItemEntity($shipmentDeliveryNoteEntity, $shipmentDeliveryNoteTransfer, $shipmentDeliveryNoteItemEntity, $itemTransfer);

            $shipmentDeliveryNoteItemEntity->save();
        }
    }

    /**
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote $shipmentDeliveryNoteEntity
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteItem $shipmentDeliveryNoteItemEntity
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteItemTransfer $shipmentDeliveryNoteItemTransfer
     */
    protected function hydrateShipmentDeliveryNoteItemEntity(
        FosShipmentDeliveryNote $shipmentDeliveryNoteEntity,
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer,
        FosShipmentDeliveryNoteItem $shipmentDeliveryNoteItemEntity,
        ShipmentDeliveryNoteItemTransfer $shipmentDeliveryNoteItemTransfer
    ):void
    {
        $shipmentDeliveryNoteItemEntity->fromArray($shipmentDeliveryNoteItemTransfer->toArray());

        $shipmentDeliveryNoteItemEntity->setFkShipmentDeliveryNote($shipmentDeliveryNoteEntity->getIdShipmentDeliveryNote());
        $shipmentDeliveryNoteItemEntity->setFkProductAbstract($this->getIdProductAbstractByConcreteSku($shipmentDeliveryNoteItemTransfer->getSku()));
        $shipmentDeliveryNoteItemEntity->setFkProduct($this->getIdProductConcreteBySku($shipmentDeliveryNoteItemTransfer->getSku()));
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     * @param \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote $shipmentDeliveryNoteEntity
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    protected function hydrateShipmentDeliveryNoteTransferFromEntity(
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer, FosShipmentDeliveryNote $shipmentDeliveryNoteEntity
    ): ShipmentDeliveryNoteTransfer {

        $shipmentDeliveryNoteTransfer->fromArray($shipmentDeliveryNoteEntity->toArray(), true);

        return $shipmentDeliveryNoteTransfer;
    }


    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return int
     */
    protected function getIdLocale(ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer): int
    {
        $localeName = $shipmentDeliveryNoteTransfer->getLocale();
        $localeEntity = $this->localeQueryContainer->queryLocaleByName($localeName)->findOne();

        return $localeEntity->getIdLocale();
    }

    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return int
     */
    protected function getIdSalesOrder(string $orderReference): int
    {
        $salesOrderEntity = $this->salesFacade->findSalesOrderByOrderReference($orderReference);

        if ($salesOrderEntity === null) {
            return null;
        }

        return $salesOrderEntity->getIdSalesOrder();
    }

    /**
     * @param string $sku
     *
     * @return int
     */
    protected function getIdProductAbstractByConcreteSku(string $sku): int
    {
        return $this->productFacade->findIdProductAbstactByConcreteSku($sku);
    }

    /**
     * @param string $sku
     * 
     * @return int
     */
    protected function getIdProductConcreteBySku(string $sku): int
    {
        return $this->productFacade->findProductConcreteIdBySku($sku);
    }

    /**
     * @return \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNote
     */
    protected function createShipmentDeliveryNoteEntity()
    {
        return new FosShipmentDeliveryNote();
    }

    /**
     * @return \Orm\Zed\ShipmentDeliveryNote\Persistence\FosShipmentDeliveryNoteAddress
     */
    protected function createShipmentDeliveryNoteAddressEntity()
    {
        return new FosShipmentDeliveryNoteAddress();
    }

    /**
     * @return \Orm\Zed\Invoice\Persistence\FosShipmentDeliveryNoteItem
     */
    protected function createShipmentDeliveryNoteItemEntity()
    {
        return new FosShipmentDeliveryNoteItem();
    }

}