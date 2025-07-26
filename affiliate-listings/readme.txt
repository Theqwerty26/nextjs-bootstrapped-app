=== Affiliate Listings Manager ===
Contributors: yourname
Tags: affiliate, listings, bonus, marketing, elementor
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A comprehensive WordPress plugin for managing and publishing affiliate listings with bonus management, scheduling, statistics, and modern UI.

== Description ==

Affiliate Listings Manager is a powerful WordPress plugin designed for affiliate marketers and bonus listing websites. It provides a complete solution for managing affiliate listings with advanced features including:

**Core Features:**
* Custom post type for affiliate listings
* Bonus management system with categories and tags
* Scheduling system for auto-publishing/unpublishing
* Statistics dashboard for tracking clicks and impressions
* Super Banner system for highlighted listings
* Google/ChatGPT-style search functionality
* Full Elementor integration
* AMP compatibility
* Responsive design with device-specific controls

**Search Functionality:**
* Modern search bar with Google/ChatGPT styling
* Custom search trigger ("Listeyi Ver" by default)
* Action buttons for WhatsApp, Telegram, and Advertise
* AJAX-powered search results

**Bonus Management:**
* Complete bonus entry system
* Multiple bonus types (Welcome, Deposit, No Deposit, Free Spins, etc.)
* Bonus amount formatting with currency support
* Expiry date management
* Manual ranking system

**Statistics & Analytics:**
* Click and impression tracking
* Monthly statistics dashboard
* Top performing listings
* Export functionality
* Admin dashboard widgets

**Elementor Integration:**
* Bonus Listings Widget
* Search Bar Widget  
* Super Banner Widget
* Full design customization in Elementor
* Live preview in editor

**Developer Features:**
* Template override system
* Hooks and filters for extensibility
* REST API endpoints
* Custom CSS/JS injection
* Bulk actions and quick edit

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/affiliate-listings` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Affiliate Listings->Settings screen to configure the plugin
4. Create your first affiliate listing from Affiliate Listings->Add New

== Frequently Asked Questions ==

= How do I display the search bar? =

Use the shortcode `[arama_bari]` to display the search bar anywhere on your site, or use the Elementor widget if you're using Elementor.

= How do I show bonus listings? =

Use the shortcode `[bonus_liste]` to display bonus listings, or use the Elementor Bonus Listings widget.

= Can I customize the design? =

Yes! The plugin includes extensive styling options in the settings, and if you're using Elementor, you can customize everything directly in the Elementor editor.

= How does the search functionality work? =

Users need to type the exact trigger phrase (default: "Listeyi Ver") to see the bonus listings. This can be customized in the settings.

= Is it compatible with my theme? =

Yes, the plugin is designed to work with any WordPress theme. It includes template override functionality for advanced customization.

== Screenshots ==

1. Admin dashboard with affiliate listings
2. Search bar with Google/ChatGPT styling
3. Bonus listings grid display
4. Elementor widget integration
5. Settings panel with customization options
6. Statistics dashboard

== Changelog ==

= 1.0.0 =
* Initial release
* Core affiliate listings functionality
* Bonus management system
* Search bar with custom trigger
* Statistics tracking
* Super Banner system
* Elementor integration
* AMP compatibility
* Responsive design

== Upgrade Notice ==

= 1.0.0 =
Initial release of Affiliate Listings Manager.

== Shortcodes ==

**[arama_bari]** - Displays the search bar
Parameters:
* placeholder - Search input placeholder text
* show_buttons - Show action buttons (yes/no)
* whatsapp_url - WhatsApp button URL
* telegram_url - Telegram button URL  
* advertise_url - Advertise button URL

**[bonus_liste]** - Displays bonus listings grid
Parameters:
* posts_per_page - Number of listings to show
* columns - Number of columns (1-4)
* category - Filter by category slug
* tag - Filter by tag slug
* orderby - Order by (manual_rank, date, title)
* show_excerpt - Show excerpt (yes/no)
* show_bonus_amount - Show bonus amount (yes/no)

== Hooks & Filters ==

**Actions:**
* `alm_before_listing_display` - Fired before displaying a listing
* `alm_after_listing_display` - Fired after displaying a listing
* `alm_search_performed` - Fired when search is performed
* `alm_affiliate_click` - Fired when affiliate button is clicked

**Filters:**
* `alm_listing_html` - Filter listing HTML output
* `alm_search_results` - Filter search results
* `alm_bonus_amount_display` - Filter bonus amount display
* `alm_affiliate_url` - Filter affiliate URLs
* `alm_button_text` - Filter button text

== Support ==

For support and documentation, please visit the plugin's GitHub repository or contact the developer.

== Privacy Policy ==

This plugin may collect and store:
* Click and impression statistics
* Search queries (if logging is enabled)
* User IP addresses for analytics (anonymized)

All data is stored locally in your WordPress database and is not shared with third parties.
