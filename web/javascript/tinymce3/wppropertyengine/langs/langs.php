<?php
/**
 * Location strings for the wppropertyengine TinyMCE 3 plugin
 * 
 * It relies on the WP filter `mce_external_languages`.
 * This late filter loads this file and adds the strings into the JS.
 * It is easier to maintain i18n with this mecanism.
 * 
 * $strings is the advocate output ; it is used as an "include", it is why.
 * 
 * @author simonc
 * @since 1.1
 * @return null
 */

$strings = 'tinyMCE.addI18n("'.$mce_locale.'.wppropertyengine",{
  propertyengine_livelist:     "'.js_escape(__('PropertyEngine LiveList', 'propertyengine')).'",
  desc:                 "'.js_escape(__('PropertyEngine Widgets Shortcodes', 'propertyengine')).'",
  zzz:                  ""
});

tinyMCE.addI18n("'.$mce_locale.'.wppropertyengine_dlg",{
  livelist_id:          "'.js_escape(__('LiveList ID', 'propertyengine')).'",
  livelist_id_help:     "'.js_escape(__('You get this ID from within your PropertyEngine account', 'propertyengine')).'",
  display_options:      "'.js_escape(__('Display Options', 'propertyengine')).'",

  view_options:         "'.js_escape(__('View', 'propertyengine')).'",
  view_options_help:    "'.js_escape(__('Toggle which views (list / map) should be enabled for the live list', 'propertyengine')).'",
  both :                "'.js_escape(__('Both', 'propertyengine')).'",
  view_list:            "'.js_escape(__('List', 'propertyengine')).'",
  view_map:             "'.js_escape(__('Map', 'propertyengine')).'",

  start_view_options:   "'.js_escape(__('Start View', 'propertyengine')).'",
  start_view_options_help:    "'.js_escape(__('Choose which view displays on intial load', 'propertyengine')).'",
  show_status_options:  "'.js_escape(__('Show Status', 'propertyengine')).'",
  unreleased:           "'.js_escape(__('Unreleased', 'propertyengine')).'",
  available:            "'.js_escape(__('Available', 'propertyengine')).'",
  sold:                 "'.js_escape(__('Sold', 'propertyengine')).'",

  hide_columns_options: "'.js_escape(__('Hide Columns', 'propertyengine')).'",
  col_sale_status:           "'.js_escape(__('Status', 'propertyengine')).'",
  col_label:            "'.js_escape(__('Label', 'propertyengine')).'",
  col_phase:            "'.js_escape(__('Phase', 'propertyengine')).'",
  col_block:            "'.js_escape(__('Block', 'propertyengine')).'",
  col_floor:            "'.js_escape(__('Floor', 'propertyengine')).'",
  col_description:      "'.js_escape(__('Description', 'propertyengine')).'",
  col_price:            "'.js_escape(__('Price', 'propertyengine')).'",
  col_plot_size:        "'.js_escape(__('Plot Size', 'propertyengine')).'",
  col_unit_size:        "'.js_escape(__('Unit Size', 'propertyengine')).'",

  share_button:         "'.js_escape(__('Share Button', 'propertyengine')).'",
  email:                "'.js_escape(__('Email', 'propertyengine')).'",
  download:             "'.js_escape(__('Download', 'propertyengine')).'",
  print:                "'.js_escape(__('Print', 'propertyengine')).'",

  show_search:          "'.js_escape(__('Show Search', 'propertyengine')).'",
  yes:                  "'.js_escape(__('Yes', 'propertyengine')).'",
  no:                   "'.js_escape(__('No', 'propertyengine')).'",

  style_options:        "'.js_escape(__('Style Options', 'propertyengine')).'",
  fontcolor:            "'.js_escape(__('Font Color', 'propertyengine')).'",
  linecolor:            "'.js_escape(__('Line Color', 'propertyengine')).'",
  align:                "'.js_escape(__('Align', 'propertyengine')).'",
  align_center:         "'.js_escape(__('centered', 'propertyengine')).'",
  align_left:           "'.js_escape(__('left', 'propertyengine')).'",
  align_right:          "'.js_escape(__('right', 'propertyengine')).'",
  alink:                "'.js_escape(__('Link Color', 'propertyengine')).'",
  alt_options:          "'.js_escape(__('Other Options', 'propertyengine')).'",
  apply_the_magic:      "'.js_escape(__('Apply the magic!', 'propertyengine')).'",
  apply_the_magic_err:  "'.js_escape(__('Could not parse PropertyEngine HTML code. It may be invalid or it is a bug of the plugin (then, please report it).', 'propertyengine')).'",
  asin:                 "'.js_escape(__('ASIN Code', 'propertyengine')).'",
  bgcolor:              "'.js_escape(__('Background Color', 'propertyengine')).'",
  bordercolor:          "'.js_escape(__('Border color', 'propertyengine')).'",
  copypaste_here:       "'.js_escape(__('Copy/paste PropertyEngine HTML\'s code right below ↓', 'propertyengine')).'",
  copypaste_rtfm:       "'.js_escape(__('Don\'t want to fill main options fields ? So just copy/paste PropertyEngine\'s HTML code and enjoy autocomplete magic!', 'propertyengine')).'",
  copypaste_tab:        "'.js_escape(__('Copy/Paste Code', 'propertyengine')).'",
  copypaste_welcome:    "'.js_escape(__('Glad you look at here!', 'propertyengine')).'",
  general_tab:          "'.js_escape(__('Main Options', 'propertyengine')).'",
  height:               "'.js_escape(__('Height', 'propertyengine')).'",
  image_source:         "'.js_escape(__('Image Source', 'propertyengine')).'",
  link_text:            "'.js_escape(__('Link text', 'propertyengine')).'",
  main_options:         "'.js_escape(__('Main Options', 'propertyengine')).'",
  pixels:               "'.js_escape(__('pixels', 'propertyengine')).'",
  plugin_setting:       "'.js_escape(__('Default Plugin Setting', 'propertyengine')).'",
  product_type:         "'.js_escape(__('Display type', 'propertyengine')).'",
  product_type_both:    "'.js_escape(__('Image and Text', 'propertyengine')).'",
  product_type_image:   "'.js_escape(__('Image only', 'propertyengine')).'",
  product_type_text:    "'.js_escape(__('Text only', 'propertyengine')).'",
  region:               "'.js_escape(__('Region', 'propertyengine')).'",
  region_ca:            "'.js_escape(__('PropertyEngine Canada', 'propertyengine')).'",
  region_de:            "'.js_escape(__('PropertyEngine Germany', 'propertyengine')).'",
  region_fr:            "'.js_escape(__('PropertyEngine France', 'propertyengine')).'",
  region_it:            "'.js_escape(__('PropertyEngine Italia', 'propertyengine')).'",
  region_jp:            "'.js_escape(__('PropertyEngine Japan', 'propertyengine')).'",
  region_uk:            "'.js_escape(__('PropertyEngine United Kingdom', 'propertyengine')).'",
  region_us:            "'.js_escape(__('PropertyEngine USA', 'propertyengine')).'",
  small:                "'.js_escape(__('Small size?', 'propertyengine')).'",
  tracking_id:          "'.js_escape(__('Activation Key', 'propertyengine')).'",
  tracking_id_help:     "'.js_escape(__('Leave empty to use automatically your default tracking ID.', 'propertyengine')).'",
  livelist_id:          "'.js_escape(__('LiveList ID', 'propertyengine')).'",
  width:                "'.js_escape(__('Width', 'propertyengine')).'",
  zzz:                  ""
});';
