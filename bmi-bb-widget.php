<?php
/*
Plugin Name: BMI BajaBariatrics Widget
Text Domain: bmi-bb-widget
Plugin URI: https://github.com/joseayram/bmi-bb-widget
Description: Adds a widget that displays a BMI calculator.
Author: José Ayrám
Author URI: https://github.com/joseayram
Version: 1.0
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
// Version
define("BMI_BB_WIDGET_VERSION", "1.0.0");
// Translations
add_action('plugins_loaded', array('BMI_BB_WIDGET', 'load_textdomain'));
// Register Widget
add_action('widgets_init', array('BMI_BB_WIDGET', 'register_widget'));
// Register style sheet.
add_action('wp_enqueue_scripts', array('BMI_BB_WIDGET', 'register_assets'));
// Shortcode
add_shortcode('bmi-bb-widget', array('BMI_BB_WIDGET', 'frontend_form'));

Class BMI_BB_Widget extends WP_Widget
{
  /**
   * Register widget with WordPress.
   */
  public function __construct()
  {
    parent::__construct(
      'bmi_bb_widget',
      __( 'BMI BB Widget', 'text_domain' ),
      array(
        'description' => __('A simple BMI Calculator Widget.', 'bmi-bb-widget'),
      )
    );
  }

  // Register Widget
  public function register_widget()
  {
    register_widget('BMI_BB_Widget');
  }

  // Register Style Sheet.
  public function register_assets()
  {
    wp_register_style('bmi-bb-widget', plugins_url('css/styles.css', __FILE__));
    wp_enqueue_style('bmi-bb-widget');
    wp_enqueue_script('bmi-bb-widget-app', plugins_url('js/app.js', __FILE__), array('jquery'));
  }

  // Load Translations
  public function load_textdomain()
  {
    load_plugin_textdomain('bmi-bb-widget', false, basename( dirname( __FILE__ ) ) . '/languages' );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget($args, $instance)
  {
    echo $this->frontend_form();
  }

  public function frontend_form()
  {
    $form = "<form id='bmi-bb-widget-form' name='bmi-bb-widget-form' method='post'>"
          .   "<div class='container'>"
          .     "<div class='row'>"
          .       "<h4><span>".__('BODY MASS INDEX', 'bmi-bb-widget')."</span></h4>"
          .     "</div>"
          .     "<div class='row'>"
          .     "<h6 class='bmi-bb-title'>".__('HEIGHT', 'bmi-bb-widget')."</h6>"
          .     "</div>"
          .     "<div class='row'>"
          .       "<input type='text' name='height_ft' id='height_ft' placeholder='".__('ft', 'bmi-bb-widget')."' size='5' class='medicom-forms input-height'>"
          .       "<input type='text' name='height_in' id='height_in' placeholder='".__('in', 'bmi-bb-widget')."' size='5' class='medicom-forms input-height'>"
          .     "</div>"
          .     "<div class='row'>"
          .     "<h6 class='bmi-bb-title'>".__('WEIGHT', 'bmi-bb-widget')."</h6>"
          .     "</div>"
          .     "<div class='row'>"
          .       "<input type='text' name='weight_lb' id='weight_lb' placeholder='".__('pounds', 'bmi-bb-widget')."' class='medicom-forms'>"
          .     "</div>"
          .     "<div class='row'>"
          .       "<input type='submit' name='btn_bmi_submit' value='".__('Calculate', 'bmi-bb-widget')."' class='buton b_asset buton-2 buton-mini'>"
          .     "</div>"
          .     "<div class='row'>"
          .        "<span id='bmi-bb-widget-result' name='bmi-bb-widget-result' class='show-message'>".__('BMI RESULT: NO RESULT YET', 'bmi-bb-widget')."</span>"
          .        "<span id='bmi-bb-widget-error' name='bmi-bb-widget-error' class='hide-message'>".__('ERROR: ONLY NUMBERS', 'bmi-bb-widget')."</span>"
          .     "</div>"
          .   "</div>"
          . "</form>";

    return $form;
  }

}