<?php

namespace FedExVendor\FedEx\UploadDocumentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * Specifies printing options for a shipping document.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 *
 * @property string $PrinterId
 */
class ShippingDocumentPrintDetail extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'ShippingDocumentPrintDetail';
    /**
     * Provides environment-specific printer identification.
     *
     * @param string $printerId
     * @return $this
     */
    public function setPrinterId($printerId)
    {
        $this->values['PrinterId'] = $printerId;
        return $this;
    }
}
