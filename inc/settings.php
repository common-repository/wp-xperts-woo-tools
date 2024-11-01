<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if(isset($_POST['wx-woo-tools-settings']) ){
    if ( ! wp_verify_nonce( $_POST['wx_woo_tools_nonce_settings'], plugin_basename( __FILE__ ) ) ) {
        die( 'Security check failed' );
    }
    else
    {
        $WX_opetions_array  =   array();
        foreach ($_POST as $key => $val):
            $WX_options_arr[$key]    =   esc_html(sanitize_text_field($val));
        endforeach;

        $WX_options_arr_serialized   =   serialize($WX_options_arr);
        update_option('WX_woo_tools_options', $WX_options_arr_serialized);

        $WX_success     =   'Settings update successfully';
    }
}
$pages  =   get_pages();
?>
<div class="woo-tools-settings">
    <div class="woo-tools-settings-left">
        <?php
        if(isset($WX_success))
        {
            echo '<div class="notice notice-success"><p>Settings updated successfully!</p></div>';
        }
        ?>
        <form action="" name="wx-woo-tools-setting" id="wx-woo-tools-setting" method="post">
            <input type="hidden" name="wx-woo-tools-settings">
            <?php echo wp_nonce_field( plugin_basename( __FILE__ ), 'wx_woo_tools_nonce_settings',true,false); ?>
            <div class="wx-tools-section">
                <div class="wx-tools-arrow"><br></div>
                <h3><?php echo  _e( 'Add to cart text', WX_TEXT_DOMAIN ); ?></h3>
                <div class="wx-tools-section-fields">
                    <div class="wx-settings-field wx-text-settings">
                        <label for="active_wx_tools_bt" class="wx-switch">
                            <input type="checkbox" id="active_wx_tools_bt" name="active_wx_tools_bt" <?php if( WX_WOO_Tools::WX_get_setting('active_wx_tools_bt') ): echo 'checked'; endif; ?>>
                            <div class="wx-switch-slider"></div>
                        </label>
                        <div class="clearfix"></div>
                    </div>
                    <div class="wx-settings-field wx-text-settings">
                        <label for="wx_tools_bt"><?php echo _e('Button Text', WX_TEXT_DOMAIN); ?></label>
                        <input type="text" id="wx_tools_bt" name="wx_tools_bt" value="<?php if( WX_WOO_Tools::WX_get_setting('wx_tools_bt') ): echo WX_WOO_Tools::WX_get_setting('wx_tools_bt'); endif; ?>" class="widefat">
                        <p class="tool-desc"><?php echo _e('here you can replace the ADD TO CART button text', WX_TEXT_DOMAIN); ?>.</p>
                        <div class="clearfix"></div>
                    </div>
                    <?php echo submit_button('Save'); ?>
                </div>
            </div>
            <div class="wx-tools-section">
                <div class="wx-tools-arrow"><br></div>
                <h3><?php echo  _e( 'add to cart redirect', WX_TEXT_DOMAIN ); ?></h3>
                <div class="wx-tools-section-fields">
                    <div class="wx-settings-field wx-text-settings">
                        <label for="active_wx_tools_cr" class="wx-switch">
                            <input type="checkbox" id="active_wx_tools_cr" name="active_wx_tools_cr" <?php if( WX_WOO_Tools::WX_get_setting('active_wx_tools_cr') ): echo 'checked'; endif; ?>>
                            <div class="wx-switch-slider"></div>
                        </label>
                        <div class="clearfix"></div>
                    </div>
                    <div class="wx-settings-field wx-text-settings">
                        <label for="wx_tools_cr_page"><?php echo _e('Select Page', WX_TEXT_DOMAIN); ?></label>
                        <select name="wx_tools_cr_page" id="wx_tools_cr_page" class="widefat">
                            <option value="default"> -- Select Page -- </option>
                            <?php
                            foreach($pages as $page):
                            ?>
                            <option value="<?php echo get_page_link($page->ID); ?>"
                                <?php
                                if( WX_WOO_Tools::WX_get_setting('wx_tools_cr_page') == get_page_link($page->ID))
                                {
                                    echo 'selected="selected"';
                                }
                                ?>
                            ><?php echo $page->post_title; ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <div class="clearfix"></div>
                    </div>
                    <div class="wx-settings-field wx-text-settings">
                        <label for="wx_tools_cr_url"><?php echo _e('Direct URL', WX_TEXT_DOMAIN); ?></label>
                        <input type="text" id="wx_tools_cr_url" name="wx_tools_cr_url" value="<?php if( WX_WOO_Tools::WX_get_setting('wx_tools_cr_url') ): echo WX_WOO_Tools::WX_get_setting('wx_tools_cr_url'); endif; ?>" class="widefat">
                        <p class="tool-desc"><?php echo _e('here you can manage the redirect after the product added to cart. you can either choose from dropdown or give an external URL.', WX_TEXT_DOMAIN); ?>.</p>
                        <div class="clearfix"></div>
                    </div>
                    <?php echo submit_button('Save'); ?>
                </div>
            </div>
            <div class="wx-tools-section">
                <div class="wx-tools-arrow"><br></div>
                <h3><?php echo  _e( 'checkout redirect', WX_TEXT_DOMAIN ); ?></h3>
                <div class="wx-tools-section-fields">
                    <div class="wx-settings-field wx-text-settings">
                        <label for="active_wx_tools_ckr" class="wx-switch">
                            <input type="checkbox" id="active_wx_tools_ckr" name="active_wx_tools_ckr" <?php if( WX_WOO_Tools::WX_get_setting('active_wx_tools_ckr') ): echo 'checked'; endif; ?>>
                            <div class="wx-switch-slider"></div>
                        </label>
                        <div class="clearfix"></div>
                    </div>
                    <div class="wx-settings-field wx-text-settings">
                        <label for="wx_tools_ckr_page"><?php echo _e('Select Page', WX_TEXT_DOMAIN); ?></label>
                        <select name="wx_tools_ckr_page" id="wx_tools_ckr_page" class="widefat">
                            <option value="default"> -- Select Page -- </option>
                            <?php
                            foreach($pages as $page):
                                ?>
                                <option value="<?php echo get_page_link($page->ID); ?>"
                                    <?php
                                    if( WX_WOO_Tools::WX_get_setting('wx_tools_ckr_page') == get_page_link($page->ID))
                                    {
                                        echo 'selected="selected"';
                                    }
                                    ?>
                                ><?php echo $page->post_title; ?></option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                        <div class="clearfix"></div>
                    </div>
                    <div class="wx-settings-field wx-text-settings">
                        <label for="wx_tools_ckr_url"><?php echo _e('Direct URL', WX_TEXT_DOMAIN); ?></label>
                        <input type="text" id="wx_tools_ckr_url" name="wx_tools_ckr_url" value="<?php if( WX_WOO_Tools::WX_get_setting('wx_tools_ckr_url') ): echo WX_WOO_Tools::WX_get_setting('wx_tools_cr_url'); endif; ?>" class="widefat">
                        <p class="tool-desc"><?php echo _e('here you can manage the redirect after the product added to cart. you can either choose from dropdown or give an external URL.', WX_TEXT_DOMAIN); ?>.</p>
                        <div class="clearfix"></div>
                    </div>
                    <?php echo submit_button('Save'); ?>
                </div>
            </div>
            <div class="wx-tools-section">
                <div class="wx-tools-arrow"><br></div>
                <h3><?php echo  _e( 'related products', WX_TEXT_DOMAIN ); ?></h3>
                <div class="wx-tools-section-fields">
                    <div class="wx-settings-field wx-text-settings">
                        <label for="active_wx_tools_rp" class="wx-switch">
                            <input type="checkbox" id="active_wx_tools_rp" name="active_wx_tools_rp" <?php if( WX_WOO_Tools::WX_get_setting('active_wx_tools_rp') ): echo 'checked'; endif; ?>>
                            <div class="wx-switch-slider"></div>
                        </label>
                        <div class="clearfix"></div>
                    </div>
                    <div class="wx-settings-field wx-text-settings">
                        <label for="wx_tools_rp"><?php echo _e('Related Products', WX_TEXT_DOMAIN); ?></label>
                        <select name="wx_tools_rp" id="wx_tools_rp" class="widefat">
                            <option value="show" <?php if(WX_WOO_Tools::WX_get_setting('wx_tools_rp') == 'show' || empty(WX_WOO_Tools::WX_get_setting('wx_tools_rp'))){echo 'selected="selected"';}?>>Show</option>
                            <option value="hide" <?php if(WX_WOO_Tools::WX_get_setting('wx_tools_rp') == 'hide'){echo 'selected="selected"';}?>>Hide</option>
                        </select>
                        <p class="tool-desc"><?php echo _e('here you can show/hide related products on product detail page', WX_TEXT_DOMAIN); ?>.</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="wx-settings-field wx-text-settings">
                        <label for="wx_tools_rp_num"><?php echo _e('Number of Related Products To Show', WX_TEXT_DOMAIN); ?></label>
                        <input type="text" id="wx_tools_rp_num" name="wx_tools_rp_num" value="<?php if( WX_WOO_Tools::WX_get_setting('wx_tools_rp_num') ): echo WX_WOO_Tools::WX_get_setting('wx_tools_rp_num'); endif; ?>" class="widefat">
                        <p class="tool-desc"><?php echo _e('here you can manage the number of related products to show.', WX_TEXT_DOMAIN); ?></p>
                        <div class="clearfix"></div>
                    </div>
                    <?php echo submit_button('Save'); ?>
                </div>
            </div>
            <div class="wx-tools-section">
                <div class="wx-tools-arrow"><br></div>
                <h3><?php echo  _e( 'remove product tabs', WX_TEXT_DOMAIN ); ?></h3>
                <div class="wx-tools-section-fields">
                    <div class="wx-settings-field wx-text-settings">
                        <label for="active_wx_tools_pt" class="wx-switch">
                            <input type="checkbox" id="active_wx_tools_pt" name="active_wx_tools_pt" <?php if( WX_WOO_Tools::WX_get_setting('active_wx_tools_pt') ): echo 'checked'; endif; ?>>
                            <div class="wx-switch-slider"></div>
                        </label>
                        <div class="clearfix"></div>
                    </div>
                    <div class="wx-settings-field wx-text-settings">
                        <label for="wx_tools_pt_desc"><?php echo _e('Description', WX_TEXT_DOMAIN); ?></label>
                        <select name="wx_tools_pt_desc" id="wx_tools_pt_desc" class="widefat">
                            <option value="show" <?php if(WX_WOO_Tools::WX_get_setting('wx_tools_pt_desc') == 'show' || empty(WX_WOO_Tools::WX_get_setting('wx_tools_pt_desc'))){echo 'selected="selected"';}?>>Show</option>
                            <option value="hide" <?php if(WX_WOO_Tools::WX_get_setting('wx_tools_pt_desc') == 'hide'){echo 'selected="selected"';}?>>Hide</option>
                        </select>
                        <p class="tool-desc"><?php echo _e('here you can show/hide DESCRIPTION product tab on product detail page', WX_TEXT_DOMAIN); ?>.</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="wx-settings-field wx-text-settings">
                        <label for="wx_tools_pt_rev"><?php echo _e('Reviews', WX_TEXT_DOMAIN); ?></label>
                        <select name="wx_tools_pt_rev" id="wx_tools_pt_rev" class="widefat">
                            <option value="show" <?php if(WX_WOO_Tools::WX_get_setting('wx_tools_pt_rev') == 'show' || empty(WX_WOO_Tools::WX_get_setting('wx_tools_pt_desc'))){echo 'selected="selected"';}?>>Show</option>
                            <option value="hide" <?php if(WX_WOO_Tools::WX_get_setting('wx_tools_pt_rev') == 'hide'){echo 'selected="selected"';}?>>Hide</option>
                        </select>
                        <p class="tool-desc"><?php echo _e('here you can show/hide Reviews product tab on product detail page', WX_TEXT_DOMAIN); ?>.</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="wx-settings-field wx-text-settings">
                        <label for="wx_tools_pt_info"><?php echo _e('Additional Information', WX_TEXT_DOMAIN); ?></label>
                        <select name="wx_tools_pt_info" id="wx_tools_pt_info" class="widefat">
                            <option value="show" <?php if(WX_WOO_Tools::WX_get_setting('wx_tools_pt_info') == 'show' || empty(WX_WOO_Tools::WX_get_setting('wx_tools_pt_desc'))){echo 'selected="selected"';}?>>Show</option>
                            <option value="hide" <?php if(WX_WOO_Tools::WX_get_setting('wx_tools_pt_info') == 'hide'){echo 'selected="selected"';}?>>Hide</option>
                        </select>
                        <p class="tool-desc"><?php echo _e('here you can show/hide ADDITIONAL INFORMATION product tab on product detail page', WX_TEXT_DOMAIN); ?>.</p>
                        <div class="clearfix"></div>
                    </div>
                    <?php echo submit_button('Save'); ?>
                </div>
            </div>
        </form>
    </div>
    <div class="woo-tools-settings-right"><?php require 'wp-xperts-info.php'; ?></div>
</div>