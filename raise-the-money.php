<?php
/*
Plugin Name: Raise The Money
Plugin URI: https://raisethemoney.com
Description: A WordPress plugin for embedding the Raise The Money contribution form in your website.
Version: 5.2
Author: Raise The Money
Author Email: support@raisethemoney.com
License:

  Copyright 2014 Raise The Money (support@raisethemoney.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

class RaiseTheMoney {

  /*--------------------------------------------*
   * Constants
   *--------------------------------------------*/
  const name = 'Raise The Money';
  const slug = 'raisethemoney';

  /**
   * Constructor
   */
  function __construct() {
    //Hook up to the init action
    add_action( 'init', array( &$this, 'init_raisethemoney' ) );
  }

  /**
   * Runs when the plugin is initialized
   */
  function init_raisethemoney() {

    // Register the shortcode [rtm]
    add_shortcode( 'raisethemoney', array( &$this, 'render_shortcode' ) );
  }

  function render_shortcode($atts) {
    // Extract the attributes
    extract(shortcode_atts(array(
      'form' => 'not_found',
      'type' => '',
      'site' => 'politics'
    ), $atts));

    // Output contribution form snippet
    return '<script type="text/javascript"> (function(){var scripts = document.getElementsByTagName("script"), thisScriptTag = scripts[scripts.length - 1], iframe = document.createElement("iframe"); thisScriptTag.parentNode.insertBefore(iframe, thisScriptTag); iframe.src = "https://' . $site . '.raisethemoney.com/' . $form . '/' . $type .'?iframe=true"; iframe.width = "100%"; iframe.scrolling = "no"; iframe.setAttribute("seamless", true); iframe.setAttribute("frameBorder", 0); window.addEventListener("message", function(e) {iframe.height = e.data; }); })(); </script>';
  }
} // end class
new RaiseTheMoney();

include 'raise-the-money-widget.php';
