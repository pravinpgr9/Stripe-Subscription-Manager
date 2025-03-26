<?php
/*
Plugin Name: Stripe Subscription Manager
Description: Custom Stripe Subscription Integration for WordPress.
Version: 1.1
Author: Your Name
*/

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

require_once __DIR__ . '/vendor/autoload.php'; // Load Stripe SDK
use Stripe\Stripe;

class Stripe_Subscription_Manager {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'process_subscription_actions']);
    }

    public function add_admin_menu() {
        add_menu_page(
            'Stripe Subscriptions',
            'Stripe Subscriptions',
            'manage_options',
            'stripe-subscriptions',
            [$this, 'display_subscriptions_page'],
            'dashicons-money',
            25
        );
    }

    public function stripe_schedule_subscription() {
        if (isset($_POST['schedule_subscription'])) {
            $this->init_stripe();
            try {
                $customer_email = sanitize_email($_POST['customer_email']);
                $plan_id = sanitize_text_field($_POST['plan_id']);
                
                if (!preg_match('/^price_[a-zA-Z0-9]+$/', $plan_id)) {
                    throw new Exception("Invalid Price ID. Please enter a valid Stripe Price ID.");
                }
                
                $price = \Stripe\Price::retrieve($plan_id);
                if (!$price || isset($price->error)) {
                    throw new Exception("The specified Price ID does not exist.");
                }
                
                $start_date = strtotime(sanitize_text_field($_POST['start_date']));
                if ($start_date <= time()) {
                    $start_date = time() + 86400;
                }
                
                $customer = \Stripe\Customer::create(['email' => $customer_email]);
                $subscription = \Stripe\Subscription::create([
                    'customer'   => $customer->id,
                    'items'      => [['price' => $plan_id]],
                    'trial_end'  => $start_date,
                ]);

                echo "<div class='updated'><p>Subscription scheduled successfully!</p></div>";
            } catch (Exception $e) {
                echo "<div class='error'><p>Error: " . esc_html($e->getMessage()) . "</p></div>";
            }
        }
    }

    public function stripe_get_subscriptions() {
        $this->init_stripe();
        try {
            return \Stripe\Subscription::all(['limit' => 20])->data ?? [];
        } catch (Exception $e) {
            error_log("Stripe API Error: " . $e->getMessage());
            return [];
        }
    }

    public function stripe_modify_subscription() {
        if (isset($_POST['modify_subscription'])) {
            $this->init_stripe();
            try {
                $subscription_id = sanitize_text_field($_POST['subscription_id']);
                $new_start_date = strtotime(sanitize_text_field($_POST['new_start_date']));
                
                if ($new_start_date <= time()) {
                    $new_start_date = time() + 86400;
                }
                
                $subscription = \Stripe\Subscription::retrieve($subscription_id);
                $subscription->trial_end = $new_start_date;
                $subscription->save();
                
                echo "<div class='updated'><p>Subscription start date updated!</p></div>";
            } catch (Exception $e) {
                echo "<div class='error'><p>Error: " . esc_html($e->getMessage()) . "</p></div>";
            }
        }
    }

    public function display_subscriptions_page() {
        $subscriptions = $this->stripe_get_subscriptions();

        echo '<h2>Modify Scheduled Subscription</h2>';
        echo '<form method="post">'
            . '<label>Subscription ID:</label> <input type="text" name="subscription_id" required>'
            . '<label>New Start Date:</label> <input type="date" name="new_start_date" required>'
            . '<input type="submit" name="modify_subscription" value="Modify">'
            . '</form>';

        echo '<h2>Schedule a Subscription</h2>';
        echo '<form method="post">'
            . '<label>Email:</label> <input type="email" name="customer_email" required>'
            . '<label>Plan ID:</label> <input type="text" name="plan_id" required>'
            . '<label>Start Date:</label> <input type="date" name="start_date" required>'
            . '<input type="submit" name="schedule_subscription" value="Schedule">'
            . '</form>';

        echo '<h2>Stripe Subscriptions</h2>';
        echo '<table class="wp-list-table widefat fixed striped">'
            . '<thead><tr><th>ID</th><th>Customer Name</th><th>Plan</th>'
            . '<th>Status</th><th>Next Billing Date</th></tr></thead><tbody>';

        if ($subscriptions) {
            foreach ($subscriptions as $sub) {
                $customer = \Stripe\Customer::retrieve($sub->customer);
                $customer_name = $customer->name ?? $customer->email ?? 'N/A';
                $plan_name = $sub->items->data[0]->price->nickname ?? 'N/A';
                
                echo "<tr><td>" . esc_html($sub->id) . "</td>"
                    . "<td>" . esc_html($customer_name) . "</td>"
                    . "<td>" . esc_html($plan_name) . "</td>"
                    . "<td>" . esc_html($sub->status) . "</td>"
                    . "<td>" . date('Y-m-d', $sub->current_period_end) . "</td></tr>";
            }
        } else {
            echo '<tr><td colspan="5">No subscriptions found.</td></tr>';
        }

        echo '</tbody></table>';
    }

    public function process_subscription_actions() {
        $this->stripe_schedule_subscription();
        $this->stripe_modify_subscription();
    }

    private function init_stripe() {
        Stripe::setApiKey(get_option('stripe_secret_key', 'sk_test_51R6pNCDAWlyIto8u5Hrhm09HiU3dgwSzvpDiCJFkJmKrqNx5yKcg7yE0NiqcFDugN3pSxXd4q8x8K2keIYnlm8GZ00QXcVvPTm')); 
    }
}

new Stripe_Subscription_Manager();
