<?php
/**
 * Search Bar Template
 * 
 * This template can be overridden by copying it to yourtheme/affiliate-listings/search-bar.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get settings
$whatsapp_url = $atts['whatsapp_url'] ?: get_option( 'alm_whatsapp_url', '' );
$telegram_url = $atts['telegram_url'] ?: get_option( 'alm_telegram_url', '' );
$advertise_url = $atts['advertise_url'] ?: get_option( 'alm_advertise_url', '' );
$search_trigger = get_option( 'alm_search_trigger_text', 'Listeyi Ver' );
?>

<div class="alm-search-container" data-trigger="<?php echo esc_attr( $search_trigger ); ?>">
    <div class="alm-search-wrapper">
        <input type="text" 
               id="alm-search-input" 
               class="alm-search-input" 
               placeholder="<?php echo esc_attr( $atts['placeholder'] ); ?>"
               autocomplete="off"
               aria-label="<?php _e( 'Search for bonus listings', 'affiliate-listings' ); ?>">
        
        <div class="alm-search-icon" aria-hidden="true">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
        </div>
    </div>
    
    <?php if ( $atts['show_buttons'] === 'yes' ) : ?>
    <div class="alm-action-buttons" role="group" aria-label="<?php _e( 'Contact and advertising options', 'affiliate-listings' ); ?>">
        <?php if ( $whatsapp_url ) : ?>
        <a href="<?php echo esc_url( $whatsapp_url ); ?>" 
           class="alm-action-button alm-whatsapp-button" 
           target="_blank" 
           rel="nofollow noopener"
           aria-label="<?php _e( 'Contact us on WhatsApp', 'affiliate-listings' ); ?>">
            <?php echo esc_html( $atts['whatsapp_text'] ); ?>
        </a>
        <?php endif; ?>
        
        <?php if ( $telegram_url ) : ?>
        <a href="<?php echo esc_url( $telegram_url ); ?>" 
           class="alm-action-button alm-telegram-button" 
           target="_blank" 
           rel="nofollow noopener"
           aria-label="<?php _e( 'Contact us on Telegram', 'affiliate-listings' ); ?>">
            <?php echo esc_html( $atts['telegram_text'] ); ?>
        </a>
        <?php endif; ?>
        
        <?php if ( $advertise_url ) : ?>
        <a href="<?php echo esc_url( $advertise_url ); ?>" 
           class="alm-action-button alm-advertise-button"
           aria-label="<?php _e( 'Learn about advertising opportunities', 'affiliate-listings' ); ?>">
            <?php echo esc_html( $atts['advertise_text'] ); ?>
        </a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    
    <div class="alm-search-hint" style="display: none;">
        <p><?php printf( __( 'Type "%s" to see bonus listings', 'affiliate-listings' ), esc_html( $search_trigger ) ); ?></p>
    </div>
</div>

<div id="alm-bonus-results" class="alm-bonus-results" style="display: none;" aria-live="polite">
    <!-- Bonus listings will be loaded here via AJAX -->
</div>

<?php
// Add inline script for search functionality
if ( ! wp_script_is( 'alm-search-inline', 'done' ) ) :
    wp_add_inline_script( 'alm-front-script', '
        jQuery(document).ready(function($) {
            var searchTrigger = "' . esc_js( $search_trigger ) . '";
            
            $(document).on("input", ".alm-search-input", function() {
                var $input = $(this);
                var $container = $input.closest(".alm-search-container");
                var $results = $("#alm-bonus-results");
                var $hint = $container.find(".alm-search-hint");
                var searchValue = $input.val().trim();
                
                if (searchValue === searchTrigger) {
                    $hint.hide();
                    ALM.loadBonusListings($results);
                } else if (searchValue.length > 0) {
                    $results.hide();
                    $hint.show();
                } else {
                    $results.hide();
                    $hint.hide();
                }
            });
        });
    ', 'after' );
    wp_script_add_data( 'alm-search-inline', 'done', true );
endif;

// Hook for additional content after search bar
do_action( 'alm_after_search_bar', $atts );
?>
