<?php

namespace FedExVendor;

/**
 * WP Desk Tracker
 *
 * @class        WPDESK_Tracker
 * @version        1.3.2
 * @package        WPDESK/Helper
 * @category    Class
 * @author        WP Desk
 */
if (!\defined('ABSPATH')) {
    exit;
}
if (!\class_exists('FedExVendor\WPDesk_Tracker')) {
    class WPDesk_Tracker implements \WPDesk_Tracker_Interface
    {
        const WPDESK_TRACKER_NOTICE = 'wpdesk-tracker-notice';
        const WPDESK_TRACKER_DEACTIVATION = 'wpdesk-tracker-deactivation';
        /**
         * @var string
         */
        private $script_version = '11';
        /**
         * @var string
         */
        private $plugin_basename = '';
        /**
         * @var string
         */
        private $message_version = '4';
        /**
         * @var WPDesk_Tracker_Data_Provider[]
         */
        private $providers = [];
        /**
         * @var WPDesk_Tracker_Sender
         */
        private $sender;
        /**
         * @deprecated do not use. This is for backward compatibility only.
         */
        public static function init($foo = null)
        {
        }
        public function __construct($plugin_basename, \WPDesk_Tracker_Sender $sender)
        {
            $this->plugin_basename = $plugin_basename;
            $this->set_sender($sender);
        }
        /**
         * Setter for object that sends data.
         *
         * @param WPDesk_Tracker_Sender $sender Object that can send payloads.
         */
        public function set_sender(\WPDesk_Tracker_Sender $sender)
        {
            $this->sender = $sender;
        }
        /**
         * Hook into cron event.
         */
        public function init_hooks()
        {
            \add_action('admin_init', [$this, 'init_schedule']);
            \add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'], 100);
            \add_action('wpdesk_tracker_send_event', [$this, 'send_tracking_data']);
            \add_action('admin_menu', [$this, 'admin_menu']);
            \add_action('admin_init', [$this, 'admin_init']);
            \add_action('admin_notices', [$this, 'admin_notices']);
            \add_action('wp_ajax_wpdesk_tracker_notice_handler', [$this, 'wp_ajax_wpdesk_tracker_notice_handler']);
            \add_action('wp_ajax_wpdesk_tracker_deactivation_handler', [$this, 'wp_ajax_wpdesk_tracker_deactivation_handler']);
            \add_action('update_option_wpdesk_helper_options', [$this, 'update_option_wpdesk_helper_options'], 10, 3);
            \add_filter('option_wpdesk_helper_options', [$this, 'option_wpdesk_helper_options'], 10, 2);
            \add_filter('default_option_wpdesk_helper_options', [$this, 'default_option_wpdesk_helper_options'], 10, 3);
            \add_filter('wpdesk_tracker_data', [$this, 'wpdesk_tracker_message_version']);
            \add_action('admin_bar_menu', [$this, 'admin_bar_menu'], 999);
            \add_action('wp_head', [$this, 'wp_head'], 999);
            \add_action('admin_head', [$this, 'wp_head'], 999);
            global $pagenow;
            if ('plugins.php' === $pagenow) {
                \add_action('admin_footer', [$this, 'admin_footer']);
            }
        }
        public function add_data_provider(\WPDesk_Tracker_Data_Provider $provider)
        {
            $this->providers[] = $provider;
        }
        public function wp_head()
        {
            if (\apply_filters('wpdesk_tracker_use_testdata', \false) && \apply_filters('wpdesk_tracker_show_testdata', \false)) {
                include 'views/tracker-styles.php';
            }
        }
        /**
         * @param WP_Admin_Bar $wp_admin_bar
         */
        public function admin_bar_menu($wp_admin_bar)
        {
            if (\apply_filters('wpdesk_tracker_use_testdata', \false) && \apply_filters('wpdesk_tracker_show_testdata', \false)) {
                $args = ['id' => 'my_page', 'title' => 'WP Desk Test!', 'meta' => ['class' => 'wpdesk-tracker-test']];
                $wp_admin_bar->add_node($args);
            }
        }
        public function init_schedule()
        {
            $options = \get_option('wpdesk_helper_options');
            if (!\is_array($options)) {
                $options = [];
            }
            if (empty($options['wpdesk_tracker_agree'])) {
                $options['wpdesk_tracker_agree'] = '0';
            }
            $wpdesk_tracker_agree = $options['wpdesk_tracker_agree'];
            $wp_next_scheduled = \wp_next_scheduled('wpdesk_tracker_send_event');
            if ($wpdesk_tracker_agree == '1' && !$wp_next_scheduled) {
                \wp_schedule_event(\time(), 'daily', 'wpdesk_tracker_send_event');
            }
            if ($wpdesk_tracker_agree == '0' && $wp_next_scheduled) {
                \wp_clear_scheduled_hook('wpdesk_tracker_send_event');
            }
        }
        /**
         * @return bool
         */
        private function should_enable_wpdesk_tracker()
        {
            return \apply_filters('wpdesk_tracker_enabled', \true);
        }
        public function admin_footer()
        {
            if (!\is_network_admin() && $this->should_enable_wpdesk_tracker() && !\apply_filters('wpdesk_tracker_do_not_ask', \false)) {
                $plugins = ['wpdesk-helper/wpdesk-helper.php' => 'wpdesk-helper/wpdesk-helper.php'];
                $plugins = \apply_filters('wpdesk_track_plugin_deactivation', $plugins);
                include 'views/tracker-plugins-footer.php';
            }
        }
        public function admin_enqueue_scripts()
        {
            $screen = \get_current_screen();
            if ($screen->id === 'admin_page_wpdesk_tracker' || $screen->id === 'admin_page_wpdesk_tracker_deactivate') {
                \wp_register_style('wpdesk-helper-tracker', \plugin_dir_url(__FILE__) . 'assets/css/tracker.css', [], $this->script_version, 'all');
                \wp_enqueue_style('wpdesk-helper-tracker');
            }
        }
        public function admin_menu()
        {
            \add_submenu_page('', 'WP Desk Tracker', 'WP Desk Tracker', 'manage_options', 'wpdesk_tracker', [$this, 'wpdesk_tracker_page']);
            \add_submenu_page('', 'Deactivate plugin', 'Deactivate plugin', 'manage_options', 'wpdesk_tracker_deactivate', [$this, 'wpdesk_tracker_deactivate']);
        }
        public function wp_ajax_wpdesk_tracker_deactivation_handler()
        {
            \check_ajax_referer(self::WPDESK_TRACKER_DEACTIVATION, 'security');
            if (!\current_user_can('activate_plugins')) {
                die;
            }
            $this->send_deactivation_data();
        }
        public function wp_ajax_wpdesk_tracker_notice_handler()
        {
            \check_ajax_referer(self::WPDESK_TRACKER_NOTICE, 'security');
            if (!\current_user_can('manage_woocommerce')) {
                die;
            }
            $option = \get_option('wpdesk_helper_options');
            if (!$option) {
                \add_option('wpdesk_helper_options', []);
            }
            $type = '';
            if (isset($_REQUEST['type'])) {
                $type = \sanitize_key($_REQUEST['type']);
            }
            if ($type === 'allow') {
                $options = \get_option('wpdesk_helper_options', []);
                if (!\is_array($options)) {
                    $options = [];
                }
                \update_option('wpdesk_helper_options', $options);
                \delete_option('wpdesk_tracker_notice');
                $options['wpdesk_tracker_agree'] = '1';
                \update_option('wpdesk_helper_options', $options);
            }
            if ($type === 'dismiss') {
                $options = \get_option('wpdesk_helper_options', []);
                if (!\is_array($options)) {
                    $options = [];
                }
                \update_option('wpdesk_tracker_notice', 'dismiss_all');
                $options['wpdesk_tracker_agree'] = '0';
                \update_option('wpdesk_helper_options', $options);
            }
        }
        public function update_option_wpdesk_helper_options($old_value, $value, $option)
        {
            if (empty($old_value)) {
                $old_value = ['wpdesk_tracker_agree' => '-1'];
            }
            if (!isset($old_value['wpdesk_tracker_agree'])) {
                $old_value['wpdesk_tracker_agree'] = '-1';
            }
            if (empty($value)) {
                $value = ['wpdesk_tracker_agree' => '-1'];
            }
            if (!isset($value['wpdesk_tracker_agree'])) {
                $value['wpdesk_tracker_agree'] = '-1';
            }
            if ($old_value['wpdesk_tracker_agree'] != '1') {
                if ($value['wpdesk_tracker_agree'] == '1') {
                    $this->send_tracking_data(\true, 'agree', $this->read_context_from_request());
                }
            }
            if ($old_value['wpdesk_tracker_agree'] != '0') {
                if ($value['wpdesk_tracker_agree'] == '0') {
                    $this->send_tracking_data(\true, 'no', $this->read_context_from_request());
                    \update_option('wpdesk_tracker_notice', 'dismiss_all');
                }
            }
        }
        public function option_wpdesk_helper_options($value, $option)
        {
            if (\apply_filters('wpdesk_tracker_do_not_ask', \false)) {
                if (!\is_array($value)) {
                    $value = [];
                }
                $value['wpdesk_tracker_agree'] = 1;
            }
            return $value;
        }
        public function default_option_wpdesk_helper_options($default, $option = null, $passed_default = null)
        {
            if (\apply_filters('wpdesk_tracker_do_not_ask', \false)) {
                $default = [];
                $default['wpdesk_tracker_agree'] = 1;
            }
            return $default;
        }
        public function admin_notices()
        {
            if (!$this->should_enable_wpdesk_tracker()) {
                return;
            }
            if (!\current_user_can('manage_woocommerce')) {
                return;
            }
            $options = \get_option('wpdesk_helper_options', []);
            if (!\is_array($options)) {
                $options = [];
            }
            if (\get_option('wpdesk_tracker_notice', '0') != 'dismiss_all') {
                if (empty($options['wpdesk_tracker_agree']) || $options['wpdesk_tracker_agree'] == '0') {
                    if ($this->can_display_notice()) {
                        $user = \wp_get_current_user();
                        $username = $user->first_name ? $user->first_name : $user->user_login;
                        $terms_url = \get_locale() === 'pl_PL' ? 'https://www.wpdesk.pl/dane-uzytkowania/' : 'https://www.wpdesk.net/usage-tracking/';
                        $shop_url = \get_locale() === 'pl_PL' ? 'https://www.wpdesk.pl/' : 'https://www.wpdesk.net/';
                        $plugin = $this->plugin_basename;
                        include 'views/tracker-notice.php';
                    }
                }
            }
            if (isset($_GET['wpdesk_tracker_opt_out'])) {
                $options = \get_option('wpdesk_helper_options', []);
                if (!\is_array($options)) {
                    $options = [];
                }
                \delete_option('wpdesk_tracker_notice');
                $options['wpdesk_tracker_agree'] = '0';
                \update_option('wpdesk_helper_options', $options);
                include 'views/tracker-opt-out-notice.php';
            }
        }
        public function wpdesk_tracker_page()
        {
            $user = \wp_get_current_user();
            $username = $user->first_name ? $user->first_name : $user->user_login;
            $allow_url = \admin_url('admin.php?page=wpdesk_tracker');
            $allow_url = \add_query_arg('plugin', \sanitize_text_field(\wp_unslash($_GET['plugin'])), $allow_url);
            $skip_url = $allow_url;
            $allow_url = \add_query_arg('allow', '1', $allow_url);
            $skip_url = \add_query_arg('allow', '0', $skip_url);
            $terms_url = \get_locale() === 'pl_PL' ? 'https://www.wpdesk.pl/dane-uzytkowania/' : 'https://www.wpdesk.net/usage-tracking/';
            include 'views/tracker-connect.php';
        }
        public function wpdesk_tracker_deactivate()
        {
            $user = \wp_get_current_user();
            $username = $user->first_name;
            $plugin = \sanitize_text_field(\wp_unslash($_GET['plugin']));
            $active_plugins = \get_plugins();
            $plugin_name = $active_plugins[$plugin]['Name'];
            include 'views/tracker-deactivate.php';
        }
        public function admin_init()
        {
            if (isset($_GET['page']) && $_GET['page'] === 'wpdesk_tracker') {
                if (isset($_GET['plugin']) && isset($_GET['allow'])) {
                    $options = \get_option('wpdesk_helper_options', []);
                    if (!\is_array($options)) {
                        $options = [];
                    }
                    if ($_GET['allow'] == '0') {
                        \remove_action('update_option_wpdesk_helper_options', [$this, 'update_option_wpdesk_helper_options'], 10, 3);
                        unset($options['wpdesk_tracker_agree']);
                        \update_option('wpdesk_helper_options', $options);
                        \add_action('update_option_wpdesk_helper_options', [$this, 'update_option_wpdesk_helper_options'], 10, 3);
                        $options['wpdesk_tracker_agree'] = '0';
                        \update_option('wpdesk_helper_options', $options);
                        \update_option('wpdesk_tracker_notice', '1');
                    } else {
                        \remove_action('update_option_wpdesk_helper_options', [$this, 'update_option_wpdesk_helper_options'], 10, 3);
                        unset($options['wpdesk_tracker_agree']);
                        \update_option('wpdesk_helper_options', $options);
                        \add_action('update_option_wpdesk_helper_options', [$this, 'update_option_wpdesk_helper_options'], 10, 3);
                        \delete_option('wpdesk_tracker_notice');
                        \update_option('wpdesk_tracker_agree', '1');
                        $options['wpdesk_tracker_agree'] = '1';
                        \update_option('wpdesk_helper_options', $options);
                    }
                    \wp_safe_redirect(\admin_url('plugins.php'));
                    exit;
                }
            }
        }
        public function wpdesk_tracker_message_version($data)
        {
            $data['message_version'] = $this->message_version;
            return $data;
        }
        public function send_deactivation_data()
        {
            if (!isset($_REQUEST['plugin'], $_REQUEST['plugin_name'], $_REQUEST['reason'])) {
                return;
            }
            $params = [];
            $params['click_action'] = 'plugin_deactivation';
            $params['plugin'] = \sanitize_text_field(\wp_unslash($_REQUEST['plugin']));
            $params['plugin_name'] = \sanitize_text_field(\wp_unslash($_REQUEST['plugin_name']));
            $params['reason'] = \sanitize_text_field(\wp_unslash($_REQUEST['reason']));
            if (!empty($_REQUEST['additional_info'])) {
                $params['additional_info'] = \sanitize_text_field(\wp_unslash($_REQUEST['additional_info']));
            }
            $this->send_payload_to_wpdesk(\apply_filters('wpdesk_tracker_deactivation_data', $params));
        }
        /**
         * Decide whether to send tracking data or not.
         *
         * @param boolean $override
         */
        public function send_tracking_data($override = \false, $click_action = null, array $additional_data = [])
        {
            $options = \get_option('wpdesk_helper_options', []);
            if (empty($options)) {
                $options = [];
            }
            if (empty($options['wpdesk_tracker_agree'])) {
                $options['wpdesk_tracker_agree'] = '0';
            }
            if (empty($click_action) && $options['wpdesk_tracker_agree'] == '0') {
                return;
            }
            if (!$this->should_enable_wpdesk_tracker()) {
                return;
            }
            // Dont trigger this on AJAX Requests.
            if (\defined('DOING_AJAX') && \DOING_AJAX) {
                // return;
            }
            if (!\apply_filters('wpdesk_tracker_send_override', $override)) {
                // Send a maximum of once per week by default.
                $last_send = $this->get_last_send_time();
                if ($last_send && $last_send > \apply_filters('wpdesk_tracker_last_send_interval', \strtotime('-1 week'))) {
                    return;
                }
            } else {
                // Make sure there is at least a 1 hour delay between override sends, we dont want duplicate calls due to double clicking links.
                $last_send = $this->get_last_send_time();
                if (empty($click_action) && $last_send && $last_send > \strtotime('-1 hours')) {
                    return;
                }
            }
            // Update time first before sending to ensure it is set.
            \update_option('wpdesk_tracker_last_send', \time());
            if (empty($click_action) || $click_action === 'agree') {
                $params = $this->get_tracking_data();
                if (isset($params['active_plugins'])) {
                    foreach ($params['active_plugins'] as $plugin => $plugin_data) {
                        $option_name = 'plugin_activation_' . $plugin;
                        $activation_date = \get_option($option_name, '');
                        if ($activation_date != '') {
                            $params['active_plugins'][$plugin]['activation_date'] = $activation_date;
                        }
                    }
                }
                if (!empty($click_action)) {
                    $params['click_action'] = 'agree';
                }
            } else {
                $params = ['click_action' => 'no'];
                $params['url'] = \home_url();
            }
            $params['localhost'] = 'no';
            if (!empty($_SERVER['SERVER_ADDR']) && $_SERVER['SERVER_ADDR'] === '127.0.0.1') {
                $params['localhost'] = 'yes';
            }
            $this->send_payload_to_wpdesk(\array_merge($params, $additional_data));
        }
        /**
         * Sends payload to WPDesk servers.
         *
         * @param array $payload Payload to sent.
         *
         * @return bool If sending was successfull.
         */
        private function send_payload_to_wpdesk(array $payload)
        {
            try {
                $this->sender->send_payload($payload);
                return \true;
            } catch (WPDesk_Tracker_Sender_Exception_WpError $e) {
                return \false;
            }
        }
        /**
         * Get the last time tracking data was sent.
         *
         * @return int|bool
         */
        private function get_last_send_time()
        {
            return \apply_filters('wpdesk_tracker_last_send_time', \get_option('wpdesk_tracker_last_send', \false));
        }
        /**
         * @return array
         */
        private function get_data_from_providers()
        {
            $data = [];
            if (!empty($this->providers)) {
                foreach ($this->providers as $provider) {
                    $data = \array_merge($data, $provider->get_data());
                }
            }
            return $data;
        }
        /**
         * Get all the tracking data.
         *
         * @return array
         */
        private function get_tracking_data()
        {
            $data = $this->get_data_from_providers();
            return \apply_filters('wpdesk_tracker_data', $data);
        }
        private function read_context_from_request(): array
        {
            if (isset($_REQUEST['ctx'], $_REQUEST['plugin'])) {
                return ['source' => ['plugin' => \sanitize_key($_REQUEST['plugin']), 'ctx' => \sanitize_key($_REQUEST['ctx'])]];
            }
            return [];
        }
        private function can_display_notice(): bool
        {
            if (\has_filter('wpdesk_tracker_notice_screens') === \true) {
                $screen = \get_current_screen();
                return \in_array($screen->id, \apply_filters('wpdesk_tracker_notice_screens', []), \true);
            }
            return \true;
        }
    }
}
