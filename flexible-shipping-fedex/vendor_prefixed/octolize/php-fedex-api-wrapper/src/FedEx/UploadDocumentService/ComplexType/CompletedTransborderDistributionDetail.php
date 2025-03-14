<?php

namespace FedExVendor\FedEx\UploadDocumentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * Result data for a transborder distribution shipment.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 *
 * @property string $DeconsolidationLocationPostalCode
 */
class CompletedTransborderDistributionDetail extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'CompletedTransborderDistributionDetail';
    /**
     * Postal code of the destination country entry point; this is the location at which the constituent shipments are tendered into the destination country network.
     *
     * @param string $deconsolidationLocationPostalCode
     * @return $this
     */
    public function setDeconsolidationLocationPostalCode($deconsolidationLocationPostalCode)
    {
        $this->values['DeconsolidationLocationPostalCode'] = $deconsolidationLocationPostalCode;
        return $this;
    }
}
