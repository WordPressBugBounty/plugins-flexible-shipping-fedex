<?php

namespace FedExVendor\FedEx\UploadDocumentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * This is a structure for providing document line item content (in part or in whole) to a service.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Upload Document Service
 *
 * @property KeyValueDetail[] $Values
 */
class DocumentLineItem extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'DocumentLineItem';
    /**
     * Set Values
     *
     * @param KeyValueDetail[] $values
     * @return $this
     */
    public function setValues(array $values)
    {
        $this->values['Values'] = $values;
        return $this;
    }
}
