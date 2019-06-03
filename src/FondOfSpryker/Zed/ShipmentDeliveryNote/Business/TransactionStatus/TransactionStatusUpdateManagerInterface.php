<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business\TransactionStatus;

interface TransactionStatusUpdateManagerInterface
{

    /**
     * @param $idSalesOrder
     * @param $idSalesOrderItem
     *
     * @return bool
     */
    public function isShipmentDeliveryNoteAppointed($idSalesOrder, $idSalesOrderItem): bool;

}