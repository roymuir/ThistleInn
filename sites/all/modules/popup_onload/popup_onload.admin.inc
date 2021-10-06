<?php

/**
 * @file
 * Administrative interface callbacks of the Popup On Load module.
 */

/**
 * Popup add/edit form.
 */
function popup_onload_form($form, &$form_state, $popup_onload, $op = 'edit') {

  if ($op == 'clone') {
    $popup_onload->name .= ' (cloned)';
  }

  $form['name'] = [
    '#title' => t('Name'),
    '#type' => 'textfield',
    '#default_value' => $popup_onload->name,
    '#description' => t('The human-readable name of the popup.'),
    '#required' => TRUE,
  ];

  $form['body'] = [
    '#title' => t('Popup content'),
    '#type' => 'text_format',
    '#default_value' => $popup_onload->body,
    '#description' => t('The content of the popup.'),
    '#required' => TRUE,
    '#format' => !empty($popup_onload->format) ? $popup_onload->format : filter_default_format(),
  ];

  $form['width'] = [
    '#title' => t('Width'),
    '#type' => 'textfield',
    '#default_value' => $popup_onload->width,
    '#description' => t('The width of the popup, given in pixels. "0" defaults to auto-detection.'),
    '#required' => TRUE,
  ];

  $form['height'] = [
    '#title' => t('Height'),
    '#type' => 'textfield',
    '#default_value' => $popup_onload->height,
    '#description' => t('The height of the popup, given in pixels. "0" defaults to auto-detection.'),
    '#required' => TRUE,
  ];

  $form['fixed_position'] = [
    '#title' => t('Fixed position'),
    '#type' => 'checkbox',
    '#default_value' => $popup_onload->fixed_position,
    '#description' => t('Whether the popup is fixed in the browser window.'),
  ];

  $form['active_popup'] = [
    '#title' => t('Active'),
    '#type' => 'checkbox',
    '#default_value' => $popup_onload->active_popup,
    '#description' => t('Activate or deactivate a popup.'),
  ];

  $form['cookie_lifetime_single_checkbox'] = [
    '#title' => t('Specify popup cookie lifetime'),
    '#type' => 'checkbox',
    '#default_value' => !empty($popup_onload->cookie_lifetime_single),
  ];

  $form['cookie_lifetime_single'] = [
    '#title' => t('Popup cookie lifetime'),
    '#type' => 'textfield',
    '#states' => [
      'visible' => [
        'input[name="cookie_lifetime_single_checkbox"]' => [
          'checked' => TRUE,
        ],
      ],
    ],
    '#description' => t('Override this only if your server configuration filters out cookies with certain pattern.'),
    '#default_value' => isset($popup_onload->cookie_lifetime_single) ? $popup_onload->cookie_lifetime_single : '',
  ];

  $form_state['popup_onload'] = $popup_onload;
  field_attach_form('popup_onload', $popup_onload, $form, $form_state);

  $submit = [];

  if (!empty($form['#submit'])) {
    $submit += $form['#submit'];
  }

  $form['actions'] = ['#type' => 'actions'];
  $form['actions']['submit'] = [
    '#type' => 'submit',
    '#value' => t('Save'),
    '#weight' => 40,
  ];

  return $form;
}

/**
 * Submit callback for the popup form.
 */
function popup_onload_form_submit(&$form, &$form_state) {
  $popup_onload = entity_ui_controller('popup_onload')->entityFormSubmitBuildEntity($form, $form_state);
  // Save and go back.
  $popup_onload->save();
  $form_state['redirect'] = 'admin/content/popup_onload';
}

/**
 * Popup On Load admin settings form.
 */
function popup_onload_admin_settings_form($form, &$form_state) {
  // Check if colorbox library is installed.
  $library_colorbox = libraries_detect('colorbox');

  if (!$library_colorbox['installed']) {
    $error_message = $library_colorbox['error message'];
    $error_message .= '<br />' .
      t('You can download the colorbox library !here',
        ['!here' => l(t('here'), $library_colorbox['download url'])]);
    drupal_set_message(filter_xss($error_message), 'error', FALSE);
  }

  // Create the list of all sorting methods to be used in the form.
  $methods = popup_onload_sort_methods();

  $form['sort_methods'] = [
    '#type' => 'fieldset',
    '#title' => t('Popup sort methods'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
    '#description' => t('How to determine the popup, displayed to the user.'),
  ];

  $form['sort_methods'][POPUP_ONLOAD_VAR_SORT_METHOD] = [
    '#type' => 'radios',
    '#options' => $methods,
    '#default_value' => variable_get(POPUP_ONLOAD_VAR_SORT_METHOD, POPUP_ONLOAD_DEFAULT_SORT_METHOD),
  ];

  $form['misc'] = [
    '#type' => 'fieldset',
    '#title' => t('Miscellaneous'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
    '#description' => t('Misc settings.'),
  ];

  $form['misc'][POPUP_ONLOAD_VAR_COOKIE_NAME] = [
    '#type' => 'textfield',
    '#title' => t('Popup cookie name'),
    '#description' => t('Override this only if your server configuration filters out cookies with certain pattern.'),
    '#default_value' => variable_get(POPUP_ONLOAD_VAR_COOKIE_NAME, POPUP_ONLOAD_DEFAULT_COOKIE_NAME),
  ];

  $form['misc'][POPUP_ONLOAD_VAR_COOKIE_LIFETIME] = [
    '#type' => 'textfield',
    '#title' => t('Popup cookie lifetime'),
    '#description' => t('How many seconds popups will not be displayed to the user after the first display.'),
    '#default_value' => variable_get(POPUP_ONLOAD_VAR_COOKIE_LIFETIME, POPUP_ONLOAD_DEFAULT_COOKIE_LIFETIME),
  ];

  $form['misc'][POPUP_ONLOAD_VAR_DISPLAY_DELAY] = [
    '#type' => 'textfield',
    '#title' => t('Popup display delay'),
    '#description' => t('Delay in milliseconds before the popup is displayed to the user.'),
    '#default_value' => variable_get(POPUP_ONLOAD_VAR_DISPLAY_DELAY, POPUP_ONLOAD_DEFAULT_DELAY),
  ];

  $form['misc'][POPUP_ONLOAD_VAR_USE_RULES] = [
    '#type' => 'checkbox',
    '#title' => t('Disable normal popup processing'),
    '#description' => t('If set, popup_onload module will stay enabled, but popup display will be invoked only as a Rules module action.'),
    '#default_value' => variable_get(POPUP_ONLOAD_VAR_USE_RULES, FALSE),
  ];

  $form['misc'][POPUP_ONLOAD_VAR_INCLUDE_PATHS] = [
    '#type' => 'textarea',
    '#title' => t('Display only at specified paths'),
    '#description' => t('Specify pages by using their paths. Enter one path per line. Use the "*" character as a wildcard. Leave empty to include all pages, except admin ones. %front is the front page.', ['%front' => '<front>']),
    '#default_value' => variable_get(POPUP_ONLOAD_VAR_INCLUDE_PATHS, ''),
  ];

  return system_settings_form($form);
}

/**
 * Popup On Load admin settings form validation callback.
 */
function popup_onload_admin_settings_form_validate($form, &$form_state) {
  $numeric_values = [
    POPUP_ONLOAD_VAR_COOKIE_LIFETIME,
    POPUP_ONLOAD_VAR_DISPLAY_DELAY,
  ];
  foreach ($numeric_values as $form_field) {
    if (!is_numeric($form_state['values'][$form_field])) {
      form_set_error($form_field, t('Please specify numeric value.'));
    }
  }
}
