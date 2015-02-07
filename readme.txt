=== Gravity Forms - Data Persistence Add-On Reloaded - Save Button ===
Contributors: ovann86
Donate link: http://www.itsupportguides.com/
Tags: Gravity Forms, Gravity Forms Data Persistence Add-On Reloaded, addon
Requires at least: 4.0
Tested up to: 4.1
Stable tag: 1.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A save button for Gravity Forms.

== Description ==

This plugin requires the [Gravity Forms](http://www.gravityforms.com/ "Gravity Forms website") and [Gravity Forms Data Persistence Add-On Reloaded plugins](https://wordpress.org/plugins/gravity-forms-data-persistence-add-on-reloaded/ "Gravity Forms Data Persistence Add-On Reloaded") plugins.

With Gravity Forms Data Persistence Add-On Reloaded, when 'Save data with ajax' is enabled a form is automatically saved every ten seconds if a field has been changed. This leaves a gap of ten seconds where a users data may not be saved if they leave the page, it also doesnt provide any feedback to the user so they know their form has been saved successfully.

This plugin adds a 'Save' button to the bottom of the form when 'Save data with ajax' is enabled for the form. Allowing logged on users to instantly save their form, and provides the reassurance that the form has been saved.

To enable the 'Save' button, install and activate the plugin, open the form settings and under 'Persistence' choose 'Save data with ajax'.

== Installation ==

1. Install plugin from WordPress administration or upload folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in the WordPress administration
1. Open the Gravity Forms 'Forms' menu
1. Open the settings page for the form you want to add the 'Save' button to
1. Under 'Persistence' choose 'Save data with ajax'
1. The save button will now be added to the bottom of the form, along with the next, previous and submit buttons.

== Screenshots ==

1. Shows the 'Persistence' options found in the forms settings page. These options are provided by the Gravity Forms Data Persistence Add-On Reloaded plugin.
2. Shows the 'Save' button on a single page form.
3. Shows the 'Save' button on the first page of a multi-page form. The 'Save' and 'Next' buttons are displayed.
4. Shows the 'Save' button on second page of a multi-page form. The 'Previous', 'Save' and 'Next' buttons are displayed.
5. Shows the 'Save' button on third and final page of a multi-page form. The 'Previous', 'Save' and 'Submit' buttons are displayed.
6. Shows the 'Save' button when the saving ajax is running. Whilst the form is being saved the button will display 'Saving ...'. In normal circumstances it is unlikely a user will see this, as the save command usually completes very quickly.
7. After the form has been saved, the 'Save' button will display 'Saved'. The 'Saved' message is held for three seconds before returning to 'Save'.

== Changelog ==

= 1.1 =
* Changed how 'Save' button and JavaScript is called into the form
* Added function to ensure 'Save' button does not appear on user registration forms (Create an account or Maintain account)

= 1.0 =
* First public release.

== Upgrade Notice ==

= 1.0 =
First public release.