=== Profile Field Duplicator for BuddyPress ===
Contributors: bhargavbhandari90, alkesh7
Donate link: https://www.paypal.me/BnB90/50
Tags: buddypress, profile field, duplicate
Requires at least: 4.0
Tested up to: 7.1
Requires PHP: 5.6
Stable tag: 1.3.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Make a duplicate of BuddyPress profile fields in one click.

== Description ==

Sometimes you need to add the same profile field many times. Especially for multi-select, radio, checkbox, etc. fields, that can be time consuming.

So now you don't need to add the same field again and again. It's just a matter of one click now.


== How to use? ==

* Click on "Duplicate This" in profile field section.
* And that field will be duplicated. That's it.

https://www.youtube.com/watch?v=6FUTX_OdEqo

== Installation ==
1. Upload "bp-profile-field-duplicator" to the "/wp-content/plugins/" directory using FTP or upload plugin zip using upload button.
2. Activate the plugin through the "Plugins" menu in WordPress.

== Screenshots ==
1. Duplicate any profile field by clicking on the "Duplicate This" button.

== Changelog ==
= 1.0.0 =
* Initial release.

= 1.1.0 =
* Add translation support.
* Improve code as per WP standard.

= 1.2.0 =
* Changed plugin name to Profile Field Duplicator for BuddyPress.

= 1.3.0 =
* Fix: One click created three copies of the field.
* Fix: Show the error message and stop the spinner when duplication fails.
* Security: Only users who can manage BuddyPress profile fields can duplicate them.
* Fix: Show "Field is not available." for a field ID that does not exist.
* i18n: Load translations from translate.wordpress.org language packs.
* i18n: Make the "- Copy" suffix and admin notice fully translatable.
* Add Requires Plugins, Requires at least, Requires PHP and License headers.
* Tested up to WordPress 7.1.