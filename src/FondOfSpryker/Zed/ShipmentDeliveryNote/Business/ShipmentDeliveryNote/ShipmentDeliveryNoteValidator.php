<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote;

use FondOfSpryker\Zed\ShipmentDeliveryNote\Business\ShipmentDeliveryNote\ShipmentDeliveryNoteValidatorInterface;
use FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteQueryContainerInterface;
use Spryker\Zed\Sales\Persistence\SalesQueryContainerInterface;

class ShipmentDeliveryNoteValidator implements ShipmentDeliveryNoteValidatorInterface
{
    /**
     * @var \Spryker\Zed\Sales\Persistence\SalesQueryContainerInterface
     */
    protected $salesQueryContainer;

    /**
     * @var \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteQueryContainerInterface 
     */
    protected $queryContainer;

    /**
     * ShipmentDeliveryNoteValidator constructor.
     *
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNote\Persistence\ShipmentDeliveryNoteQueryContainerInterface $queryContainer
     * @param \Spryker\Zed\Sales\Persistence\SalesQueryContainerInterface $salesQueryContainer
     */
    public function __construct(
        ShipmentDeliveryNoteQueryContainerInterface $queryContainer,
        SalesQueryContainerInterface $salesQueryContainer
    )
    {
        $this->salesQueryContainer = $salesQueryContainer;
        $this->queryContainer = $queryContainer;

    }


    /**
     * @param string $orderReference
     *
     * @return bool
     */
    public function isOrderReferenceValid(string $orderReference): bool
    {
        $salesOrderEntity = $this->salesQueryContainer
            ->querySalesOrder()
            ->filterByOrderReference($orderReference)
            ->findOne();

        return ($salesOrderEntity !== null);
    }


}
