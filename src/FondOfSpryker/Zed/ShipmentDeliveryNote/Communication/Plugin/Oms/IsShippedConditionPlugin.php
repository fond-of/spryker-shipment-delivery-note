<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Communication\Plugin\Oms;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionInterface;

/**
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNoteFacade getFacade()
 * @method \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteRepository getRepository()
 */
class IsShippedConditionPlugin extends AbstractPlugin implements ConditionInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     *
     * @return bool
     */
    public function check(SpySalesOrderItem $orderItem): bool
    {
        $idSalesOrderItem = $orderItem->getIdSalesOrderItem();
        $itemTransfer = $this->getRepository()->findShipmentDeliveryNoteItemByIdSalesOrderItem($idSalesOrderItem);

        return $itemTransfer !== null
            && $itemTransfer->getIdShipmentDeliveryNoteItem() !== null
            && $itemTransfer->getFkShipmentDeliveryNote() !== null;
    }
}
