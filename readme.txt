=== PropertyEngine Widgets Shortcodes ===
Contributors: PropertyEngine
Tags: propertyengine, affiliate, shortcode, shortcodes, monetization, property, estate,development, links, product, preview, documentation, plugin, admin, post, page, tinymce, wysiwyg, wpmu
Requires at least: 2.5
Tested up to: 3.5
Stable tag: 1.2.5

Bringing PropertyEngine functionality into your Wordpress site widgets shortcodes. Standard compliants, easy to use and so on !


== Description ==

The Live Property Map/List Wordpress plugin was designed specifically for real estate developers who would like to include always up-to-date pricing and availability within their website.  The plugin allows the users of PropertyEngine, a third party service, to imbed live property information within Wordpress websites by means of a shortcode.  The information displayed via the plugin includes a real estate map view showing availability, size, price and other information which would be of interest to clients. Alternatively, users are able to switch to a table or list view showing up to date property information in a familiar spreadsheet format.

Unlike the majority of plugins, which are focussed upon single suburban homes, the Live Property Map/List plugin is geared specifically towards projects that involve the administration of many units in one geographic area, including estates, housing projects, apartments, condos, security complexes and other developments.

The unique benefits of the plugin is the ability to update a record, and see this propagate immediately to the client website, in other words,  a dynamic relationship is maintained between the database of stored information and the information displayed on the public site.

The dual list and map view caters for two unique ways of viewing and interpreting real estate information.  The ability to change a map symbolisation based upon a database entry is a further distinguishing feature, providing an immediately apparent view of property availability.

The Live Property Map/List Wordpress plugin makes it possible to forego the tedious tasks of trying to match sales reports from various agents, and does so by presenting a unified view in an ultra-accessible format.

We have a live demo for those interested in how it looks and works : [Demo](http://wordpress.propertyplugins.com/propertyengine-standard-view/)

**Hot Features**

* switch from TinyMCE to HTML without loosing anything!
* easy insertion from TinyMCE
* autoconfigure from copy/paste code
* minimal shortcodes (1 option and it runs)
* inline documentation for people who want to manually write PropertyEngine Shortcodes

**Available PropertyEngine Widgets**

* LiveList Widget

**Built-in Translations**

* English

Don't forget to look at the [screenshots](http://wordpress.org/extend/plugins/propertyengine-real-estate/screenshots/) if you are not convinced.

== Installation ==

The plugin is very basic and is primarily made for my own usage.

1. Simply upload the `propertyengine-real-estate` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go in the `Settings` admin panel to customize at least your PropertyEngine Tracking ID

Now you use PropertyEngine functionality directly in your own site!


== Changelog ==
= Version 1.2.5 =
* JS Alert Bug

= Version 1.2.4 =
* Authorisation was hitting old API

= Version 1.2.3 =
* Now correctly works with PE API v2

= Version 1.2.2 =
* Fixes null price breaking the filters
* Made styling adjustments to the table

= Version 1.2.1 =
* Reserve status displays on the map and can be filtered by in the table

= Version 1.2.0 =
* Fixed app breaking js bugs

= Version 1.1.9 =
* Sold units will no longer be effected by filter and prices will no longer be displayed
* UI fixes

= Version 1.1.8 =
* Conflict with AWS resolved

= Version 1.1.7 =
* JS and CSS bug fixes forcing version upgrade, hence forcing version updates on wordpress

= Version 1.1.6.1 =
* Datatables was not correctly minified, removed 400kb's of junk

= Version 1.1.6 =
* All JS and CSS was incorrectly pointing to the wrong Plugin Directory

= Version 1.1.5.1 =
* Units with no lat/lng co-ords were showing up in the middle of the ocean

= Version 1.1.5 =
* Sold unit prices no longer display on the map view.
* Unit data will correct be posted across to PE
* Remote key is now passed through to the unit

= Version 1.1.4.2 =
*Amazon still attempting to pull data from testing servers
= Version 1.1.4.1 =
*Removed hard coded links to staging server in auth controller

= Version 1.1.4 =
* Fixed bug where leads where firing off to staging server
* Added the ability for developments to display phase outlines on the map view
* Status buttons will now correctly toggle when clicked
* Readme file is now correct
* Leads are now correctly configured to work with the new PE API
* Units on the Map now correctly align to dot to indicate true center point
* Unit pop no longer adds # tag
* Fixed styling for popup box

= Version 1.1.3 =
 * Enquiries now correctly fire's off to PropertyEngine's lead management system

= Version 1.1.2 =
 * Shortcode setting page now successfully calls home to the propertyengine server for authentication
 * Removed search button toggle
 * Fixed bug where filtering by specific status didn't filter the data only the view components

= Version 1.1.1 =
 * Removed all obfuscated code (backbone, underscore, slider)
 * Added support for the Shortcode setting page to call home (though currently it calls home locally)

= Version 1.1.0 =
 * The setting hide columns works correctly again
 * List view will no longer be activated when view is set to map only (which was throwing a JS error)
 * Remote Keys are now read from the short code instead of the hard coded version
 * Removed the injection of JS settings via wordpress. All settings are now passed through via the init function
 * Removed Table Styling until. This will be re-introduced for version 1.1.1

= Version 1.0.0 =
 * No real changes. Went from alpha to live with some minor bug fixes and speed improvements

= Version 1.0 alpha 2=
 * Added ability to pull map data from PropertyEngine
 * Added map support
 * Add js DataTable support

= Version 1.0 alpha 1 =
 * LiveList short code
 * WYSIWYG functionality

== Frequently Asked Questions ==

= What are those shortcodes? =
It is a bundled Wordpress feature. It looks like this : `[shortcode]sample value[/shortcode]`.
It looks like nothing but it is an expandable feature so we can plug our own shortcodes ... like with this widget.

== Screenshots ==

1. Widget selection via Rich Text Editor (with TinyMCE)
2. Widget configuration via Rich Text Editor (TinyMCE)
3. Unit List view
4. Google Map Unit View
