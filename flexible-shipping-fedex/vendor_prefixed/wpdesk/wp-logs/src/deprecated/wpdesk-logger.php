<?php

namespace FedExVendor;

if (!\defined('ABSPATH')) {
    exit;
}
if (!\class_exists('FedExVendor\WPDesk_Logger')) {
    /**
     * @deprecated Only for backward compatibility. Please use injected Logger compatible with PSR
     */
    class WPDesk_Logger
    {
        /** @var \Psr\Log\LoggerInterface */
        static $logger;
        const EMERGENCY = 'emergency';
        const ALERT = 'alert';
        const CRITICAL = 'critical';
        const ERROR = 'error';
        const WARNING = 'warning';
        const NOTICE = 'notice';
        const INFO = 'info';
        const DEBUG = 'debug';
        public function __construct()
        {
            if (!self::$logger) {
                $loggerFactroy = new \FedExVendor\WPDesk\Logger\WPDeskLoggerFactory();
                self::$logger = $loggerFactroy->createWPDeskLogger();
            }
        }
        /**
         * Level strings mapped to integer severity.
         *
         * @var array
         */
        protected $level_to_severity = [self::EMERGENCY => 800, self::ALERT => 700, self::CRITICAL => 600, self::ERROR => 500, self::WARNING => 400, self::NOTICE => 300, self::INFO => 200, self::DEBUG => 100];
        /**
         * Attach hooks
         *
         * @return void
         */
        public function attach_hooks()
        {
            \add_action('plugins_loaded', [$this, 'plugins_loaded']);
            \add_filter('wpdesk_logger_level_options', [$this, 'wpdesk_logger_level_options']);
        }
        public function plugins_loaded()
        {
            if (\defined('WC_VERSION')) {
                if (\version_compare(\WC_VERSION, '3.0', '<')) {
                    \add_action('wpdesk_log', [$this, 'wpdesk_log'], 10, 4);
                } else {
                    \add_action('wpdesk_log', [$this, 'wpdesk_log_30'], 10, 4);
                }
            }
        }
        public function wpdesk_logger_level_options(array $options)
        {
            return ['disabled' => \__('Disabled', 'flexible-shipping-fedex'), 'emergency' => \__('Emergency', 'flexible-shipping-fedex'), 'alert' => \__('Alert', 'flexible-shipping-fedex'), 'critical' => \__('Critical', 'flexible-shipping-fedex'), 'error' => \__('Error', 'flexible-shipping-fedex'), 'warning' => \__('Warning', 'flexible-shipping-fedex'), 'notice' => \__('Notice', 'flexible-shipping-fedex'), 'info' => \__('Info', 'flexible-shipping-fedex'), 'debug' => \__('Debug', 'flexible-shipping-fedex')];
        }
        /**
         * @param string $level
         * @param string $source
         * @param string $message
         * @param string $settings_level
         */
        public function wpdesk_log($level, $source, $message, $settings_level = 'debug')
        {
            if (!isset($this->level_to_severity[$settings_level]) || !isset($this->level_to_severity[$level])) {
                return;
            }
            if ($this->level_to_severity[$settings_level] > $this->level_to_severity[$level]) {
                return;
            }
            if (\is_array($message) || \is_object($message)) {
                $message = \print_r($message, \true);
            }
            self::$logger->log($level, $message, ['source' => $source]);
        }
        public function wpdesk_log_30($level, $source, $message, $settings_level = 'debug')
        {
            if (!isset($this->level_to_severity[$settings_level]) || !isset($this->level_to_severity[$level])) {
                return;
            }
            if ($this->level_to_severity[$settings_level] > $this->level_to_severity[$level]) {
                return;
            }
            if (\is_array($message) || \is_object($message)) {
                $message = \print_r($message, \true);
            }
            self::$logger->log($level, $message, ['source' => $source]);
        }
    }
}
