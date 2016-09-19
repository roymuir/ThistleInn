<?php

/**
 * @file
 * Theme settings for the thistleinn
 */
function thistleinn_form_system_theme_settings_alter(&$form, &$form_state) {

  /**
   * Breadcrumb settings
   */
  $form['thistleinn_breadcrumb'] = array(
    '#type' => 'fieldset',
    '#title' => t('Breadcrumb'),
  );
  
  $form['thistleinn_breadcrumb']['thistleinn_breadcrumb_display'] = array(
   '#type' => 'select',
   '#title' => t('Display breadcrumb'),
   '#default_value' => theme_get_setting('thistleinn_breadcrumb_display'),
   '#options' => array(
     'yes' => t('Yes'),
     'no' => t('No'),
   ),
  );
  
  $form['thistleinn_breadcrumb']['thistleinn_breadcrumb_hideonlyfront'] = array(
    '#type' => 'checkbox',
    '#title' => t('Hide the breadcrumb if the breadcrumb only contains the link to the front page.'),
    '#default_value' => theme_get_setting('thistleinn_breadcrumb_hideonlyfront'),
  );
  
  $form['thistleinn_breadcrumb']['thistleinn_breadcrumb_showtitle'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show page title on breadcrumb.'),
    '#default_value' => theme_get_setting('thistleinn_breadcrumb_showtitle'),
  );

  $form['thistleinn_breadcrumb']['thistleinn_breadcrumb_separator'] = array(
    '#type' => 'textfield',
    '#title' => t('Breadcrumb separator'),
    '#default_value' => theme_get_setting('thistleinn_breadcrumb_separator'),
  );
}