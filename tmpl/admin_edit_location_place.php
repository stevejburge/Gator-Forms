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

<?php echo $this->_get_field(array(
    'type' => 'radio',
    'name' => 'position',
    'label' => 'Where do you want to display your form?',
    'class' => 'pweb-related',
    'default' => 'footer',
    'required' => true,
    'options' => array(
        array(
            'value' => 'footer',
            'name' => 'On all pages',
            'class' => 'pweb-related-slidebox pweb-related-modal'
        ),
        array(
            'value' => 'shortcode',
            'name' => 'On selected pages with short code',
            'class' => 'pweb-related-slidebox pweb-related-modal pweb-related-accordion pweb-related-static pweb-related-modal-button'
        ),
        array(
            'value' => 'widget',
            'name' => 'In widget',
            'class' => 'pweb-related-accordion pweb-related-static pweb-related-modal-button'
        )
    )
)); ?>

<!--<div class="pweb-advanced-options">
    <a href="#" class="pweb-advanced-options-toggler">
        <?php _e( 'Advanced', 'pwebcontact' ); ?><i class="dashicons dashicons-arrow-down"></i>
    </a>
    <div class="pweb-advanced-options-content">
        <?php /*echo $this->_get_field(array(
            'type' => 'radio',
            'name' => 'filter_browsers',
            'label' => 'Filter browsers',
            'tooltip' => 'Select for which type of browsers you want to display contact form. Keep in mind that browser detection is not always 100% accurate. Users can setup their browser to mimic other browsers.',
            'default' => 0,
            'class' => 'pweb-radio-group',
            'options' => array(
                array(
                    'value' => 0,
                    'name' => 'No'
                ),
                array(
                    'value' => 1,
                    'name' => 'Only mobile'
                ),
                array(
                    'value' => 2,
                    'name' => 'Only desktop'
                )
            )
        ));*/ ?>
    </div>
</div>-->