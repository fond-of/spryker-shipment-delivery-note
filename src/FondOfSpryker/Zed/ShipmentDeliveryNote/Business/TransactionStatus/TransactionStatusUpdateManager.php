<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business\TransactionStatus;

use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNote\ShipmentDeliveryNoteHydratorInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteQueryContainerInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteRepositoryInterface;
use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;

class TransactionStatusUpdateManager implements TransactionStatusUpdateManagerInterface
{

    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNote\ShipmentDeliveryNoteHydratorInterface
     */
    protected $shipmentDeliveryNoteHydrator;

    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteRepositoryInterface
     */
    protected $shipmentDeliveryNoteRepository;

    /**
     * TransactionStatusUpdateManager constructor.
     *
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteQueryContainerInterface $queryContainer
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteRepositoryInterface $shipmentDeliveryNoteRepository
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNote\ShipmentDeliveryNoteHydratorInterface $shipmentDeliveryNoteHydrator
     */
    public function __construct(
        ShipmentDeliveryNoteQueryContainerInterface $queryContainer,
        ShipmentDeliveryNoteRepositoryInterface $shipmentDeliveryNoteRepository,
        ShipmentDeliveryNoteHydratorInterface $shipmentDeliveryNoteHydrator
    ) {

        $this->queryContainer = $queryContainer;
        $this->shipmentDeliveryNoteRepository= $shipmentDeliveryNoteRepository;
        $this->shipmentDeliveryNoteHydrator = $shipmentDeliveryNoteHydrator;
    }

    /**
     * @param int $idSalesOrder
     * @param int $idSalesOrderItem
     *
     * @return bool
     */
    public function isShipmentDeliveryNoteAppointed($idSalesOrder, $idSalesOrderItem): bool
    {
        return $this->IsShipmentDeliveryNoteCreated($idSalesOrder, $idSalesOrderItem);
    }

    /**
     * @param int $idSalesOrder
     * @param int $idSalesOrderItem
     *
     * @return bool
     */
    protected function IsShipmentDeliveryNoteCreated($idSalesOrder, $idSalesOrderItem): bool
    {
        $shipmentDeliveryNoteTransfer = $this->findShipmentDeliveryNoteByIdSalesOrder($idSalesOrder);

        if ($shipmentDeliveryNoteTransfer == null) {
           return false;
        }

        return true;
    }

    /**
     * @param int $idSalesOrder
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer|null
     */
    protected function findShipmentDeliveryNoteByIdSalesOrder(int $idSalesOrder): ?ShipmentDeliveryNoteTransfer
    {
        $shipmentDeliveryNoteEntity = $this->shipmentDeliveryNoteRepository->findShipmentDeliveryNoteByIdSalesOrder($idSalesOrder);

        if ($shipmentDeliveryNoteEntity == null)
        {
            return null;
        }

        return $this->shipmentDeliveryNoteHydrator
            ->hydrateShipmentDeliveryNoteTransferFromPersistenceByShipmentDeliveryNote($shipmentDeliveryNoteEntity);
    }
}