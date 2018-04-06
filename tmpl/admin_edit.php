<?php
/**
 * @version 2.0.14
 * @package Gator Forms
 * @copyright (C) 2018 Gator Forms, All rights reserved. https://gatorforms.com
 * @license GNU/GPL http://www.gnu.org/licenses/gpl-3.0.html
 * @author Piotr Moćko
 */

// No direct access
function_exists('add_action') or die;

?>
<form name="edit" method="post" action="<?php echo esc_attr(admin_url( 'admin.php?page=pwebcontact&task=save' )); ?>" id="pweb_form">

    <div id="pweb-adminbar">

        <div class="pweb-toolbar pweb-clearfix">

            <!-- header for displaying update and error messages after -->
            <h2 style="display:none"></h2>
            <?php $this->_display_messages(); ?>

            <div class="pweb-c-navbar pweb-u-flex-row">
                <label>
                    <h2><?php _e('Form title', 'pwebcontact'); ?></h2>
                    <input type="text" name="title" value="<?php echo esc_attr($this->data->title); ?>" placeholder="<?php esc_attr_e( 'Form name', 'pwebcontact' ); ?>">
                </label>

                <div class="pweb-u-flex-row">
                    <div>
                        <button type="submit" class="button button-primary" id="pweb-save-button">
                            <i class="glyphicon glyphicon-floppy-disk"></i> <span><?php _e( 'Save' ); ?></span>
                        </button>
                        <button type="button" class="button" id="pweb-close-button" onclick="document.location.href='<?php echo admin_url( 'admin.php?page=pwebcontact' ); ?>'">
                            <i class="glyphicon glyphicon-remove"></i> <span><?php _e( 'Close' ); ?></span>
                        </button>
                    </div>
                    <div>
                        <!-- FREE START -->
                        <button class="button button-primary right pweb-buy" id="pweb-buy-button" data-href="<?php echo $this->buy_url; ?>" data-role="anchor">
                            <i class="glyphicon glyphicon-shopping-cart"></i> <?php _e( 'Buy Pro', 'pwebcontact' ); ?>
                            <span>&amp; <?php _e( 'Get Support', 'pwebcontact' ); ?></span>
                        </button>
                        <!-- FREE END -->
                        <a class="button button-primary right" id="pweb-docs-button" href="<?php echo $this->documentation_url; ?>" target="_blank">
                            <i class="glyphicon glyphicon-question-sign"></i> <span><?php _e( 'Documentation' ); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="nav-tab-wrapper" id="pweb-tabs">
            <a href="#pweb-tab-location" id="pweb-tab-location" class="nav-tab nav-tab-active">
                <i class="glyphicon glyphicon-th-large"></i>
                <?php esc_html_e( 'Location', 'pwebcontact' ); ?>
            </a>
            <a href="#pweb-tab-fields" id="pweb-tab-fields" class="nav-tab">
                <i class="glyphicon glyphicon-th-list"></i>
                <?php esc_html_e( 'Fields', 'pwebcontact' ); ?>
            </a>
            <a href="#pweb-tab-theme" id="pweb-tab-theme" class="nav-tab">
                <i class="glyphicon glyphicon-tint"></i>
                <?php esc_html_e( 'Theme', 'pwebcontact' ); ?>
            </a>
            <a href="#pweb-tab-email" id="pweb-tab-email" class="nav-tab">
                <i class="glyphicon glyphicon-envelope"></i>
                <?php esc_html_e( 'Email', 'pwebcontact' ); ?>
            </a>
            <a href="#pweb-tab-check" id="pweb-tab-check" class="nav-tab">
                <?php esc_html_e( 'Configuration check', 'pwebcontact' ); ?>
            </a>
            <a href="#pweb-tab-advanced" id="pweb-tab-advanced" class="nav-tab">
                <i class="glyphicon glyphicon-cog"></i>
                <?php esc_html_e( 'Advanced', 'pwebcontact' ); ?>
            </a>
        </h2>
    </div>

    <div id="pweb-tabs-content">

        <div id="pweb-tab-location-content" class="nav-tab-content nav-tab-content-active pweb-clearfix">
            <?php $this->_load_tmpl('location', __FILE__); ?>
        </div>

        <div id="pweb-tab-fields-content" class="nav-tab-content pweb-clearfix">
            <?php $this->_load_tmpl('fields', __FILE__); ?>
        </div>

        <div id="pweb-tab-theme-content" class="nav-tab-content pweb-clearfix">
            <?php $this->_load_tmpl('theme', __FILE__); ?>
        </div>

        <div id="pweb-tab-email-content" class="nav-tab-content pweb-clearfix">
            <?php $this->_load_tmpl('email', __FILE__); ?>
        </div>

        <div id="pweb-tab-check-content" class="nav-tab-content pweb-clearfix">
            <?php $this->_load_tmpl('check', __FILE__); ?>
        </div>

        <div id="pweb-tab-advanced-content" class="nav-tab-content pweb-clearfix">
            <?php $this->_load_tmpl('advanced', __FILE__); ?>
        </div>
    </div>


    <input type="hidden" name="id" value="<?php echo (int)$this->id; ?>">
    <?php wp_nonce_field( 'save-form_'.$this->id ); ?>

</form>
