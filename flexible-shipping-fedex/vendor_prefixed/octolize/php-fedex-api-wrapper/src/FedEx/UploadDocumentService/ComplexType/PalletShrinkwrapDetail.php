<?php

namespace FedExVendor\FedEx\UploadDocumentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * Specifications for pallets to be shrinkwrapped as part of a Freight shipment.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 *
 * @property int $PalletCount
 */
class PalletShrinkwrapDetail extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'PalletShrinkwrapDetail';
    /**
     * Number of pallets to be shrinkwrapped.
     *
     * @param int $palletCount
     * @return $this
     */
    public function setPalletCount($palletCount)
    {
        $this->values['PalletCount'] = $palletCount;
        return $this;
    }
}
