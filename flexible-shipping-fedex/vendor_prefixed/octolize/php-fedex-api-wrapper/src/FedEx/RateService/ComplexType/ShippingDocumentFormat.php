<?php

namespace FedExVendor\FedEx\RateService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * Specifies characteristics of a shipping document to be produced.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Rate Service
 *
 * @property ShippingDocumentDispositionDetail[] $Dispositions
 * @property LinearMeasure $TopOfPageOffset
 * @property \FedEx\RateService\SimpleType\ShippingDocumentImageType|string $ImageType
 * @property \FedEx\RateService\SimpleType\ShippingDocumentStockType|string $StockType
 * @property boolean $ProvideInstructions
 * @property DocumentFormatOptionsRequested $OptionsRequested
 * @property Localization $Localization
 */
class ShippingDocumentFormat extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'ShippingDocumentFormat';
    /**
     * Specifies how to create, organize, and return the document.
     *
     * @param ShippingDocumentDispositionDetail[] $dispositions
     * @return $this
     */
    public function setDispositions(array $dispositions)
    {
        $this->values['Dispositions'] = $dispositions;
        return $this;
    }
    /**
     * Specifies how far down the page to move the beginning of the image; allows for printing on letterhead and other pre-printed stock.
     *
     * @param LinearMeasure $topOfPageOffset
     * @return $this
     */
    public function setTopOfPageOffset(LinearMeasure $topOfPageOffset)
    {
        $this->values['TopOfPageOffset'] = $topOfPageOffset;
        return $this;
    }
    /**
     * Set ImageType
     *
     * @param \FedEx\RateService\SimpleType\ShippingDocumentImageType|string $imageType
     * @return $this
     */
    public function setImageType($imageType)
    {
        $this->values['ImageType'] = $imageType;
        return $this;
    }
    /**
     * Set StockType
     *
     * @param \FedEx\RateService\SimpleType\ShippingDocumentStockType|string $stockType
     * @return $this
     */
    public function setStockType($stockType)
    {
        $this->values['StockType'] = $stockType;
        return $this;
    }
    /**
     * For those shipping document types which have both a "form" and "instructions" component (e.g. General Agency Agreement), this field indicates whether to provide the instructions.
     *
     * @param boolean $provideInstructions
     * @return $this
     */
    public function setProvideInstructions($provideInstructions)
    {
        $this->values['ProvideInstructions'] = $provideInstructions;
        return $this;
    }
    /**
     * Set OptionsRequested
     *
     * @param DocumentFormatOptionsRequested $optionsRequested
     * @return $this
     */
    public function setOptionsRequested(DocumentFormatOptionsRequested $optionsRequested)
    {
        $this->values['OptionsRequested'] = $optionsRequested;
        return $this;
    }
    /**
     * Governs the language to be used for this individual document, independently from other content returned for the same shipment.
     *
     * @param Localization $localization
     * @return $this
     */
    public function setLocalization(Localization $localization)
    {
        $this->values['Localization'] = $localization;
        return $this;
    }
}
