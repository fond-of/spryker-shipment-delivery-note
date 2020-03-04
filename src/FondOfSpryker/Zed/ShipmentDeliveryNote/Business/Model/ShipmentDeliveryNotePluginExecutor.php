<?php

namespace FondOfSpryker\Zed\ShipmentDeliveryNote\Business\Model;

use Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer;

class ShipmentDeliveryNotePluginExecutor implements ShipmentDeliveryNotePluginExecutorInterface
{
    /**
     * @var array|\FondOfSpryker\Zed\ShipmentDeliveryNoteExtension\Dependency\Plugin\ShipmentDeliveryNotePreSavePluginInterface[]
     */
    protected $shipmentDeliveryNotePreSavePlugins;

    /**
     * @var array|\FondOfSpryker\Zed\ShipmentDeliveryNoteExtension\Dependency\Plugin\ShipmentDeliveryNotePostSavePluginInterface[]
     */
    protected $shipmentDeliveryNotePostSavePlugins;

    /**
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNoteExtension\Dependency\Plugin\ShipmentDeliveryNotePreSavePluginInterface[] $shipmentDeliveryNotePreSavePlugins
     * @param \FondOfSpryker\Zed\ShipmentDeliveryNoteExtension\Dependency\Plugin\ShipmentDeliveryNotePostSavePluginInterface[] $shipmentDeliveryNotePostSavePlugins
     */
    public function __construct(
        array $shipmentDeliveryNotePreSavePlugins,
        array $shipmentDeliveryNotePostSavePlugins
    ) {
        $this->shipmentDeliveryNotePreSavePlugins = $shipmentDeliveryNotePreSavePlugins;
        $this->shipmentDeliveryNotePostSavePlugins = $shipmentDeliveryNotePostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    public function executePostSavePlugins(
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
    ): ShipmentDeliveryNoteTransfer {
        foreach ($this->shipmentDeliveryNotePostSavePlugins as $shipmentDeliveryNotePostSavePlugin) {
            $shipmentDeliveryNoteTransfer = $shipmentDeliveryNotePostSavePlugin
                ->postSave($shipmentDeliveryNoteTransfer);
        }

        return $shipmentDeliveryNoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentDeliveryNoteTransfer
     */
    public function executePreSavePlugins(
        ShipmentDeliveryNoteTransfer $shipmentDeliveryNoteTransfer
    ): ShipmentDeliveryNoteTransfer {
        foreach ($this->shipmentDeliveryNotePreSavePlugins as $shipmentDeliveryNotePreSavePlugin) {
            $shipmentDeliveryNoteTransfer = $shipmentDeliveryNotePreSavePlugin
                ->preSave($shipmentDeliveryNoteTransfer);
        }

        return $shipmentDeliveryNoteTransfer;
    }
}
