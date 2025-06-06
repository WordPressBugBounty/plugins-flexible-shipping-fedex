<?php

namespace FedExVendor\FedEx\OpenShipService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * AddPackagesToOpenShipmentReply
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  OpenShip Service
 *
 * @property \FedEx\OpenShipService\SimpleType\NotificationSeverityType|string $HighestSeverity
 * @property Notification[] $Notifications
 * @property TransactionDetail $TransactionDetail
 * @property VersionId $Version
 * @property string $JobId
 * @property string $ServiceType
 * @property CompletedShipmentDetail $CompletedShipmentDetail
 * @property ShippingDocument[] $ErrorLabels
 */
class AddPackagesToOpenShipmentReply extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'AddPackagesToOpenShipmentReply';
    /**
     * Set HighestSeverity
     *
     * @param \FedEx\OpenShipService\SimpleType\NotificationSeverityType|string $highestSeverity
     * @return $this
     */
    public function setHighestSeverity($highestSeverity)
    {
        $this->values['HighestSeverity'] = $highestSeverity;
        return $this;
    }
    /**
     * Set Notifications
     *
     * @param Notification[] $notifications
     * @return $this
     */
    public function setNotifications(array $notifications)
    {
        $this->values['Notifications'] = $notifications;
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
     * Set JobId
     *
     * @param string $jobId
     * @return $this
     */
    public function setJobId($jobId)
    {
        $this->values['JobId'] = $jobId;
        return $this;
    }
    /**
     * This field contains the service type values, like PRIORITY_OVERNIGHT and FEDEX_GROUND.
     *
     * @param string $serviceType
     * @return $this
     */
    public function setServiceType($serviceType)
    {
        $this->values['ServiceType'] = $serviceType;
        return $this;
    }
    /**
     * Provides Completed Shipment Details for PAY AS YOU GO scenarios of FXRS
     *
     * @param CompletedShipmentDetail $completedShipmentDetail
     * @return $this
     */
    public function setCompletedShipmentDetail(CompletedShipmentDetail $completedShipmentDetail)
    {
        $this->values['CompletedShipmentDetail'] = $completedShipmentDetail;
        return $this;
    }
    /**
     * Empty unless error label behavior is PACKAGE_ERROR_LABELS and one or more errors occured during transaction processing.
     *
     * @param ShippingDocument[] $errorLabels
     * @return $this
     */
    public function setErrorLabels(array $errorLabels)
    {
        $this->values['ErrorLabels'] = $errorLabels;
        return $this;
    }
}
