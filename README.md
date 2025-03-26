# Stripe Subscription Manager

**Version:** 1.1  
**Author:** Your Name  
**Description:** A custom Stripe subscription integration for WordPress that allows scheduling, modifying, and managing subscriptions directly from the WordPress admin panel.  

## **Features**
- Schedule Stripe subscriptions with a specific start date.
- Modify existing subscriptions, including changing the trial period.
- View active subscriptions within the WordPress admin dashboard.
- Secure integration using the official Stripe PHP SDK.

## **Screenshot**
![Stripe Subscription Manager](https://prnt.sc/GxuqYWtN49Cy)

![image](https://github.com/user-attachments/assets/fbaf2ec5-6211-49c4-8cd2-9b9f0ecf259a)

![image](https://github.com/user-attachments/assets/a89398ec-004d-477c-9a59-91e527911338)


## **Installation**
1. **Download & Upload**  
   - Upload the `stripe-subscription-manager` folder to the `/wp-content/plugins/` directory.
   - OR Install via the WordPress plugin uploader.

2. **Activate Plugin**  
   - Go to **Plugins** > **Installed Plugins** and activate "Stripe Subscription Manager".

3. **Setup Stripe API Keys**  
   - Navigate to **Settings** > **Stripe API** and enter your **Stripe Secret Key**.

## **How to Use**
1. **Schedule a Subscription:**
   - Navigate to **Stripe Subscriptions** in the WordPress admin menu.
   - Enter the **customer email**, **Stripe Price ID**, and **start date**.
   - Click **Schedule**.

2. **Modify an Existing Subscription:**
   - Enter the **Subscription ID** and **New Start Date**.
   - Click **Modify** to update the trial period.

3. **View Active Subscriptions:**
   - The dashboard displays all active subscriptions, customer details, and next billing dates.

## **Requirements**
- WordPress 5.0+
- PHP 7.4+
- Stripe API Key (Live or Test Mode)
- Composer Installed (`composer install` to load dependencies)

## **Security & Best Practices**
- Always use **Live API keys** in production.
- Ensure SSL is enabled for secure transactions.
- Validate customer emails and Price IDs before scheduling subscriptions.

## **Support & Contributions**
For issues, create a ticket on GitHub or contact the author.

---
