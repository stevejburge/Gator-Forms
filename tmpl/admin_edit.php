<?php
/**
 * @version 1.0.0
 * @package Perfect Ajax Popup Contact Form
 * @copyright © 2014 Perfect Web sp. z o.o., All rights reserved. http://www.perfect-web.co
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 * @author Piotr Moćko
 */

// No direct access
function_exists('add_action') or die;

?>
<form name="edit" method="post" action="<?php echo esc_attr(admin_url( 'admin.php?page=pwebcontact&task=save' )); ?>">
    
    <div id="pweb-adminbar">
        
        <div class="pweb-toolbar pweb-clearfix">
            <h2><?php _e( 'Edit' ); ?></h2>

            <input type="text" name="title" value="<?php echo esc_attr($this->data->title); ?>" placeholder="<?php esc_attr_e( 'Form name', 'pwebcontact' ); ?>">

            <button type="submit" class="button button-primary" id="pweb-save-button">
                <i class="icomoon-disk"></i> <span><?php _e( 'Save' ); ?></span>
            </button>
            <button type="button" class="button" id="pweb-close-button" onclick="document.location.href='<?php echo admin_url( 'admin.php?page=pwebcontact' ); ?>'">
                <i class="icomoon-close"></i> <span><?php _e( 'Close' ); ?></span>
            </button>

            <span class="pweb-save-status"></span>

            <a class="button button-primary right" id="pweb-buy-button" href="<?php echo $this->buy_support_url; ?>" target="_blank">
                <i class="icomoon-cart"></i> <?php _e( 'Buy Pro', 'pwebcontact' ); ?>
                <span>&amp; <?php _e( 'Get Support', 'pwebcontact' ); ?></span>
            </a>
            <a class="button button-primary right" id="pweb-docs-button" href="<?php echo $this->documentation_url; ?>" target="_blank">
                <i class="icomoon-support"></i> <span><?php _e( 'Documentation' ); ?></span>
            </a>
        </div>

        <h2 class="nav-tab-wrapper" id="pweb-tabs">
            <a href="#pweb-tab-location" class="nav-tab nav-tab-active"><?php esc_html_e( 'Location & Effects', 'pwebcontact' ); ?></a>
            <a href="#pweb-tab-fields" class="nav-tab"><?php esc_html_e( 'Fields', 'pwebcontact' ); ?></a>
            <a href="#pweb-tab-layout" class="nav-tab"><?php esc_html_e( 'Layout', 'pwebcontact' ); ?></a>
            <a href="#pweb-tab-submitted" class="nav-tab"><?php esc_html_e( 'After submitting', 'pwebcontact' ); ?></a>
            <a href="#pweb-tab-email" class="nav-tab"><?php esc_html_e( 'Email settings', 'pwebcontact' ); ?></a>
            <a href="#pweb-tab-advanced" class="nav-tab"><?php esc_html_e( 'Advanced', 'pwebcontact' ); ?></a>
        </h2>
    </div>
    
    <div id="pweb-tabs-content">
        
        <div id="pweb-tab-location" class="nav-tab-content nav-tab-content-active pweb-clearfix">
            <?php $this->_load_tmpl('location', __FILE__); ?>
        </div>
        
        <div id="pweb-tab-fields" class="nav-tab-content pweb-clearfix">
            <?php $this->_load_tmpl('fields', __FILE__); ?>
        </div>
        
        <div id="pweb-tab-layout" class="nav-tab-content pweb-clearfix">
            <?php $this->_load_tmpl('layout', __FILE__); ?>
        </div>
        
        <div id="pweb-tab-submitted" class="nav-tab-content pweb-clearfix">
            <?php $this->_load_tmpl('submitted', __FILE__); ?>
        </div>
        
        <div id="pweb-tab-email" class="nav-tab-content pweb-clearfix">
            <?php $this->_load_tmpl('email', __FILE__); ?>
        </div>
        
        <div id="pweb-tab-advanced" class="nav-tab-content pweb-clearfix">
            <?php $this->_load_tmpl('advanced', __FILE__); ?>
        </div>
    </div>
    

    <input type="hidden" name="id" value="<?php echo (int)$this->id; ?>">
    <?php wp_nonce_field( 'save-form_'.$this->id ); ?>
    
</form>