<?php
//add to cart button text
if( WX_WOO_Tools::WX_get_setting('active_wx_tools_bt') == 'on' )
{
    add_filter( 'woocommerce_product_add_to_cart_text', 'wx_tools_button_text' );
    add_filter( 'woocommerce_product_single_add_to_cart_text', 'wx_tools_button_text' );

    function wx_tools_button_text()
    {
        return __( WX_WOO_Tools::WX_get_setting('wx_tools_bt'), WX_TEXT_DOMAIN );
    }
}

//add to cart redirect
if( WX_WOO_Tools::WX_get_setting('active_wx_tools_cr') == 'on' )
{
    add_filter( 'woocommerce_add_to_cart_redirect', 'wx_tools_add_to_cart_redirect' );
    function wx_tools_add_to_cart_redirect()
    {
        if(WX_WOO_Tools::WX_get_setting('wx_tools_cr_page') && WX_WOO_Tools::WX_get_setting('wx_tools_cr_page') != 'default')
        {
            return WX_WOO_Tools::WX_get_setting('wx_tools_cr_page');
        }
        else
        {
            return WX_WOO_Tools::WX_get_setting('wx_tools_cr_url');
        }
    }
}

//checkout redirect
if(WX_WOO_Tools::WX_get_setting('active_wx_tools_ckr')){
    add_action( 'template_redirect', 'wx_tools_ckr_thankyou' );
    function wx_tools_ckr_thankyou() {
        global $wp;
        if ( is_checkout() && ! empty( $wp->query_vars['order-received'] ) )
        {
            if(WX_WOO_Tools::WX_get_setting('wx_tools_ckr_page') != 'default')
            {
                wp_redirect(WX_WOO_Tools::WX_get_setting('wx_tools_ckr_page'));
                exit;
            }
            else if(WX_WOO_Tools::WX_get_setting('wx_tools_ckr_page') != '')
            {
                wp_redirect(WX_WOO_Tools::WX_get_setting('wx_tools_ckr_page'));
                exit;
            }
        }
    }
}

//manager related product from product detail page
if(WX_WOO_Tools::WX_get_setting('active_wx_tools_rp'))
{
    add_filter('woocommerce_related_products_args','wx_tools_manage_related_products', 10);
    function wx_tools_manage_related_products( $args ) {
        if(WX_WOO_Tools::WX_get_setting('wx_tools_rp') == 'hide')
        {
            return array(); // empty related products
        }
        else
        {
            $args['posts_per_page'] = WX_WOO_Tools::WX_get_setting('wx_tools_rp_num'); // 4 related products
            return $args;
        }

    }

}


//show/hide product tabs
if(WX_WOO_Tools::WX_get_setting('active_wx_tools_pt'))
{
    add_filter( 'woocommerce_product_tabs', 'wx_tools_remove_product_tabs', 98 );
    function wx_tools_remove_product_tabs( $tabs ) {

        if(WX_WOO_Tools::WX_get_setting('wx_tools_pt_desc') == 'hide')
        {
            unset( $tabs['description'] ); // Remove the description tab
        }
        if(WX_WOO_Tools::WX_get_setting('wx_tools_pt_rev') == 'hide')
        {
            unset( $tabs['reviews'] ); // Remove the reviews tab
        }
        if(WX_WOO_Tools::WX_get_setting('wx_tools_pt_info') == 'hide')
        {
            unset( $tabs['additional_information'] ); // Remove the additional information tab
        }

        return $tabs;
    }
}
