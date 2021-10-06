<?php

/**
 * @file
 * Popup stats theme file.
 */

/**
 * Theme popup statistics table.
 */
function theme_popup_onload_statistics_table($vars) {
  $output = '';

  $stats_table = [
    'header' => [
      t('Popup'),
      t('Impressions'),
      t('Clicks'),
      t('CTR (Click-Through Rate)'),
    ],
    'rows' => [],
  ];

  foreach ($vars['stats'] as $row) {
    if (!isset($row['view'])) {
      $row['view'] = 0;
    }
    if (!isset($row['click'])) {
      $row['click'] = 0;
    }
    $rate = $row['view'] != 0 ?
      $row['click'] / $row['view'] :
      0;
    $stats_table['rows'][] = [
      l($row['name'], 'admin/structure/popup_onload/manage/' . $row['popup_id'], ['attributes' => ['target' => '_blank']]),
      isset($row['view']) ? $row['view'] : 0,
      isset($row['click']) ? $row['click'] : 0,
      sprintf('%.2f%%', $rate * 100),
    ];
  }

  $output .= theme('table', $stats_table);

  return $output;
}
