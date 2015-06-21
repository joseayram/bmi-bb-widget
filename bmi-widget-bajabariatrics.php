<?php
/*
Plugin Name: BMI BajaBariatrics Widget
Plugin URI: https://github.com/joseayram/bmi-bb-widget
Description: Adds a widget that displays a BMI calculator.
Author: José Ayrám
Author URI: https://github.com/joseayram
Version: 1.0
*/

// Version
define("BMI_BB_WIDGET_VERSION","1.0.0");
// Register Widget
add_action('widgets_init', 'bmi_bb_register_widget');
// Register style sheet.
add_action('wp_enqueue_scripts', 'bmi_bb_register_assets');

// Register Widget
function bmi_bb_register_widget()
{
  register_widget('BMI_BB_Widget');
}

// Register Style Sheet.
function bmi_bb_register_assets()
{
  wp_register_style('bmi-bb-widget', plugins_url('css/styles.css', __FILE__));
  wp_enqueue_style('bmi-bb-widget');
  wp_enqueue_script('bmi-bb-widget-app', plugins_url('js/app.js', __FILE__), array('jquery'));
}

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
            'description' => __( 'A simple BMI Calculator Widget.', 'text_domain'),
      )
    );
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
          .       "<h4 class='titleBorder'>BODY MASS INDEX</h4>"
          .     "</div>"
          .     "<div class='row'>"
          .       "<input type='text' name='height_ft' id='height_ft' placeholder='ft' size='5' class='medicom-forms input-height'>"
          .       "<input type='text' name='height_in' id='height_in' placeholder='in' size='5' class='medicom-forms input-height'>"
          .     "</div>"
          .     "<div class='row'>"
          .       "<input type='text' name='weight_lb' id='weight_lb' placeholder='pounds' class='medicom-forms'>"
          .     "</div>"
          .     "<div class='row'>"
          .       "<input type='submit' name='btn_bmi_submit' value='Calculate' class='buton b_asset buton-2 buton-mini'>"
          .     "</div>"
          .     "<div class='row'>"
          .        "<span id='bmi-bb-widget-result' name='bmi-bb-widget-result'>BMI RESULT:</span>"
          .     "</div>"
          .   "</div>"
          . "</form>";

    return $form;
  }

}