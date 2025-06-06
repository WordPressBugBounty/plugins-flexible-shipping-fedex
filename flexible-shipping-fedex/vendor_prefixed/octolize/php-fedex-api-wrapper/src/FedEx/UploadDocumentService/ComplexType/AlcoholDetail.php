<?php

namespace FedExVendor\FedEx\UploadDocumentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * Specifies details for a package containing alcohol
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 *
 * @property \FedEx\UploadDocumentService\SimpleType\AlcoholRecipientType|string $RecipientType
 * @property string $ShipperAgreementType
 */
class AlcoholDetail extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'AlcoholDetail';
    /**
     * The license type that the recipient of the alcohol package.
     *
     * @param \FedEx\UploadDocumentService\SimpleType\AlcoholRecipientType|string $recipientType
     * @return $this
     */
    public function setRecipientType($recipientType)
    {
        $this->values['RecipientType'] = $recipientType;
        return $this;
    }
    /**
     * Specifies what type of entity the shipper of the alcohol shipment is registered as, for example, fulfillment house, retailer or a winery.
     *
     * @param string $shipperAgreementType
     * @return $this
     */
    public function setShipperAgreementType($shipperAgreementType)
    {
        $this->values['ShipperAgreementType'] = $shipperAgreementType;
        return $this;
    }
}
