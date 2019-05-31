<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote;

use ArrayObject;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNote\ShipmentDeliveryNoteHydratorInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToLocaleInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteEntityManagerInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteRepositoryInterface;
use Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer;
use Orm\Zed\Locale\Persistence\SpyLocale;
use Orm\Zed\Locale\Persistence\SpyLocaleQuery;
use Propel\Runtime\Collection\ObjectCollection;

class ShipmentDeliveryNoteReader implements ShipmentDeliveryNoteReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteEntityManagerInterface
     */
    protected $shipmentDeliveryNoteEntityManager;

    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Dependency\Facade\ShipmentDeliveryNoteToLocaleInterface
     */
    protected $localeFacade;

    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\Invoice\ShipmentDeliveryNoteHydratorInterface
     */
    protected $shipmentDeliveryNoteHydrator;

    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteRepositoryInterface
     */
    protected $shipmentDeliveryNoteRepository;

    /**
     * InvoiceReader constructor.
     *
     * @param \FondOfSpryker\Zed\Invoice\Dependency\Facade\InvoiceToLocaleInterface $invoiceToLocale
     * @param \FondOfSpryker\Zed\Invoice\Persistence\InvoiceEntityManagerInterface $invoiceEntityManager
     * @param \FondOfSpryker\Zed\Invoice\Business\Model\Invoice\InvoiceHydratorInterface $invoiceHydrator
     * @param \FondOfSpryker\Zed\Invoice\Persistence\InvoiceRepositoryInterface $invoiceRepository
     */
    public function __construct(
        ShipmentDeliveryNoteToLocaleInterface $localeFacade,
        ShipmentDeliveryNoteEntityManagerInterface $shipmentDeliveryNoteEntityManager,
        ShipmentDeliveryNoteHydratorInterface $shipmentDeliveryNoteHydrator,
        ShipmentDeliveryNoteRepositoryInterface $shipmentDeliveryNoteRepository
    ) {
        $this->shipmentDeliveryNoteEntityManager = $shipmentDeliveryNoteEntityManager;
        $this->shipmentDeliveryNoteHydrator = $shipmentDeliveryNoteHydrator;
        $this->shipmentDeliveryNoteRepository = $shipmentDeliveryNoteRepository;
        $this->localeFacade = $localeFacade;
    }


    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer $shipmentDeliveryNoteListTransfer
     * @param string $orderReference
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteListTransfer
     */
    public function findShipmentDeliveryNotesByOrderReference(ShipmentDeliveryNoteListTransfer $shipmentDeliveryNoteListTransfer, string $orderReference): ShipmentDeliveryNoteListTransfer
    {
        $shipmentDeliveryNoteCollection = $this->shipmentDeliveryNoteRepository->findShipmentDeliveryNotesByOrderReference($orderReference);
        //$shipmentDeliveryNoteListCollection = $this->hydrateShipmentDeliveryNoteListCollectionTransferFromEntityCollection($shipmentDeliveryNoteCollection);

       // $shipmentDeliveryNoteListTransfer->setItems($shipmentDeliveryNoteListCollection);

        return $shipmentDeliveryNoteListTransfer;
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $shipmentDeliveryNoteCollection
     * @return \ArrayObject
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    protected function hydrateShipmentDeliveryNoteListCollectionTransferFromEntityCollection(ObjectCollection $shipmentDeliveryNoteCollection): ArrayObject
    {
        $items = new ArrayObject();
        
        return $invoices;
    }
    
}
