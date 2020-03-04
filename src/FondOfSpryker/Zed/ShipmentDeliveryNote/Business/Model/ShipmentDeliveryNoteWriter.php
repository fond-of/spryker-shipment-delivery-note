<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model;

use ArrayObject;
use Exception;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteEntityManagerInterface;
use Generated\Shared\Transfer\ShipmentDeliveryNoteErrorTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteResponseTransfer;
use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class ShipmentDeliveryNoteWriter implements ShipmentDeliveryNoteWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNotePluginExecutorInterface
     */
    protected $shipmentDeliveryNotePluginExecutor;

    /**
     * ShipmentDeliveryNoteWriter constructor.
     *
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteEntityManagerInterface $entityManager
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model\ShipmentDeliveryNotePluginExecutorInterface $shipmentDeliveryNotePluginExecutor
     */
    public function __construct(
        ShipmentDeliveryNoteEntityManagerInterface $entityManager,
        ShipmentDeliveryNotePluginExecutorInterface $shipmentDeliveryNotePluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->shipmentDeliveryNotePluginExecutor = $shipmentDeliveryNotePluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteResponseTransfer
     */
    public function create(
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
    ): ShipmentDeliveryNoteResponseTransfer {
        $shipmentDeliveryNoteResponseTransfer = (new ShipmentDeliveryNoteResponseTransfer())
            ->setIsSuccess(false)
            ->setShipmentDeliveryNoteTransfer(null);

        try {
            $shipmentDeliveryNoteTransfer = $this->getTransactionHandler()->handleTransaction(
                function () use ($shipmentDeliveryNoteTransfer) {
                    return $this->executeCreateTransaction($shipmentDeliveryNoteTransfer);
                }
            );

            $shipmentDeliveryNoteResponseTransfer->setIsSuccess(true)
                ->setShipmentDeliveryNoteTransfer($shipmentDeliveryNoteTransfer);
        } catch (Exception $exception) {
            $errorTransferList = new ArrayObject();
            $errorTransferList->append((new ShipmentDeliveryNoteErrorTransfer())->setMessage($exception->getMessage()));

            $shipmentDeliveryNoteResponseTransfer->setErrors($errorTransferList);
        }

        return $shipmentDeliveryNoteResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    protected function executeCreateTransaction(
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
    ): ShipmentDeliveryNoteTransfer {
        $shipmentDeliveryNoteTransfer = $this->shipmentDeliveryNotePluginExecutor
            ->executePreSavePlugins($shipmentDeliveryNoteTransfer);

        $shipmentDeliveryNoteTransfer = $this->entityManager->createShipmentDeliveryNote($shipmentDeliveryNoteTransfer);

        return $this->shipmentDeliveryNotePluginExecutor
            ->executePostSavePlugins($shipmentDeliveryNoteTransfer);
    }
}
