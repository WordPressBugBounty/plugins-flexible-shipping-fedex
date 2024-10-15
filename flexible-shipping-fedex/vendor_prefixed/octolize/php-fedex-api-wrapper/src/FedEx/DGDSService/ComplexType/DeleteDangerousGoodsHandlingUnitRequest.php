<?php

namespace FedExVendor\FedEx\DGDSService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * DeleteDangerousGoodsHandlingUnitRequest
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Dangerous Goods Data Service
 *
 * @property WebAuthenticationDetail $WebAuthenticationDetail
 * @property ClientDetail $ClientDetail
 * @property TransactionDetail $TransactionDetail
 * @property VersionId $Version
 * @property string $UploadId
 * @property string $HandlingUnitGroupId
 * @property string[] $TrackingNumbers
 */
class DeleteDangerousGoodsHandlingUnitRequest extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'DeleteDangerousGoodsHandlingUnitRequest';
    /**
     * Descriptive data to be used in authentication of the sender's identity (and right to use FedEx web services).
     *
     * @param WebAuthenticationDetail $webAuthenticationDetail
     * @return $this
     */
    public function setWebAuthenticationDetail(WebAuthenticationDetail $webAuthenticationDetail)
    {
        $this->values['WebAuthenticationDetail'] = $webAuthenticationDetail;
        return $this;
    }
    /**
     * Set ClientDetail
     *
     * @param ClientDetail $clientDetail
     * @return $this
     */
    public function setClientDetail(ClientDetail $clientDetail)
    {
        $this->values['ClientDetail'] = $clientDetail;
        return $this;
    }
    /**
     * Set TransactionDetail
     *
     * @param TransactionDetail $transactionDetail
     * @return $this
     */
    public function setTransactionDetail(TransactionDetail $transactionDetail)
    {
        $this->values['TransactionDetail'] = $transactionDetail;
        return $this;
    }
    /**
     * Set Version
     *
     * @param VersionId $version
     * @return $this
     */
    public function setVersion(VersionId $version)
    {
        $this->values['Version'] = $version;
        return $this;
    }
    /**
     * Set UploadId
     *
     * @param string $uploadId
     * @return $this
     */
    public function setUploadId($uploadId)
    {
        $this->values['UploadId'] = $uploadId;
        return $this;
    }
    /**
     * Set HandlingUnitGroupId
     *
     * @param string $handlingUnitGroupId
     * @return $this
     */
    public function setHandlingUnitGroupId($handlingUnitGroupId)
    {
        $this->values['HandlingUnitGroupId'] = $handlingUnitGroupId;
        return $this;
    }
    /**
     * Set TrackingNumbers
     *
     * @param string $trackingNumbers
     * @return $this
     */
    public function setTrackingNumbers($trackingNumbers)
    {
        $this->values['TrackingNumbers'] = $trackingNumbers;
        return $this;
    }
}
