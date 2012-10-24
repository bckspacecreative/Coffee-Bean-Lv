=== WP Email Capture ===
Tags: email, marketing, capture, form, affiliates, mailing lists, email marketing, widget ready
Requires at least: 3.0
Tested up to: 3.3.1
Version: 2.3.1
Stable tag: 2.3.1
Contributors: rhyswynne
Donate link: http://www.wpemailcapture.com/donations/

Double opt-in form for building your email list. Define landing pages to distribute your ebooks & software.

== Description ==
This creates a 2 field form (Name & Email) for capturing emails. Email is double opt in, and allows you to forward opt in to services such as ebooks or software. When you are ready to begin your email marketing campaign, simply export the list into your chosen email marketing software or service.

Features:-

* Widget Ready.
* Uses Wordpress' internal wp_mail function for sending mail.
* Easily integrated with posts & pages.
* Dashboard Widget.
* Export data into CSV files, compatible with most major Email Marketing Programmes (including Aweber, Mailchimp, Groupmail, Constant Contact)
* Double opt in, so compatible with CAN-SPAM act.
* And completely free!

For more details please visit the official site of [WP Email Capture](http://www.wpemailcapture.com/)

Keep in Contact:-

* [WP Email Capture on Facebook](http://www.facebook.com/wpemailcapture)
* [@WPEmailCapture](http://www.twitter.com/wpemailcapture) on Twitter

Translation Credits:-

Translations have been done by the following parties. Thank you!

* French: Olivier - http://www.ticket-system.net/
* German: Stephan - http://www.computersniffer.com/
* Brazilian Portugese: Nick Lima (@nick_linux) - http://cotidianolinux.com.br
* Dutch Translation: Sander - http://www.zanderz.net/

== Installation ==
Upload the plugin (unzipped) into `/wp-content/plugins/`.

Activate the plugin under the "Plugins" menu.

This plugin requires a lot of set up before using. You need the following:-

* A page for "Half Registration" (this page will be forwarded to when the form is just filled in, informs the users that they need to click on a link in the email.

* A page for "complete registration" (thanking them for their enquiry, links to download etc).

After having these, please then fill in the settings in the "Settings > WP Email Capture" form.

The form can be inserted into the site at any location. However, to put the form anywhere, insert the following code into your template

`<?php if (function_exists('wp_email_capture_form')) { wp_email_capture_form(); } ?>` 

If you want to insert the form within a page, insert into any post or page the string `[wp_email_capture_form]`. It will be replaced with a simple form.

== Stylings ==
To style your form, you need to add to your CSS file the following ID declarations. `wp_email_capture` is for sidebar & template widgets, `wp_email_capture_2` is for on page forms.

`#wp_email_capture
{

}
#wp_email_capture label.wp-email-capture-name
{

}
#wp_email_capture label.wp-email-capture-email
{

}
#wp_email_capture input.wp-email-capture-name
{

}
#wp_email_capture input.wp-email-capture-email
{

}
#wp_email_capture_2
{

}
#wp_email_capture_2 label.wp-email-capture-name
{

}
#wp_email_capture_2 label.wp-email-capture-email
{

}
#wp_email_capture_2 input.wp-email-capture-name
{

}
#wp_email_capture_2 input.wp-email-capture-email
{

}`

== Screenshots ==
1. The Dashboard Widget
2. The Options Page
3. It's appearance within the template

== Frequently Asked Questions ==
= I am Upgrading to WP Email Capture 2.3+, why has my WP Email Capture Sidebar Widget disappeared? =
The WP Email Capture version 2.3 saw the introduction of multiple sidebar widgets. This was coded differently to the pre 2.3 WP Email Capture sidebar widget. As such you will have to recreate the sidebar widget. It's easy to do, but apologies for this - I am working on a fix!

= Can I see/export/autoconfirm “Unverified” Email Addresses? =
No.

= Why Not? =
In accordance with the CANSPAM act, I have hidden Unverified emails from view. They can not be seen. Sorry, but the temptation is too big to spam unverified emails. Hence the removal.

= Does this piece of software send out email? =
No. I feel that to do so would be counter productive, as sending out email could have a detrimental effect on your server. There are a number of services we recommend, such as Aweber, to send out lists built on WP Email Capture.

= Does it work with Wordpress MU? =
This plugin is unsupported for Wordpress MU. Some people have reported success in using it. Others haven't. I have been unable to figure out why (I've been unable to get it working for Wordpress MU).

= Does it work with [theme_name]? =
This plugin does use widgets, so probably yes :)

= How do I include the name in my emails I send to people? =
Wherever you put in %NAME% (spelt exactly like that, uppercase as well), it will be replaced with the name given by the user.

== Bugs/Suggestions/Support == 
Please report any bugs, support and suggestions to the [WP Email Capture Support Page](http://www.wpemailcapture.com/support/)

== Donate ==
To donate to this plugin, please visit the [WP Email Capture Donations Page](http://www.wpemailcapture.com/donations/)

== Change Log ==
= 2.3.1 (22/5/12) =
* Bug fixes so notices shouldn't appear in debug mode.
* Added a for attribute to the form for accessibility.

= 2.3 (09/5/12) =
* Added support to multiple widgets.
* Added language support for the Dutch language.

= 2.2 (17/4/12) =
* The [Jemjabella](http://www.jemjabella.co.uk) update, after the individual who supplied most of the bug fixes, cheers!
* Added language support for Brazilian Portugese & German.

= 2.1.1 (03/02/12) =
* Actually fixed the display bug talked about in 2.1
* Edited the Dashboard widget so that it's only displayed to user admins.

= 2.1 (30/01/12) =
* Internationalisation Completed - with French Language Pack
* Fixed a Small Display bug with the Plugin that occured in latest version of Wordpress.

= 2.0.1 (28/10/10) =
* Fixed a small security bug which occurred in the previous version.

= 2.0 (3/10/10) =
* Switched functions to use the non depreciated functions
* Compatible with Spam Free
* Added a "Delete entire list" button in Wordpress.

= 1.9 (20/01/10) =
* Fixed a small bug that resulted in the display for [The plugin does not have a valid header.] 
* Fixed a small phpmail bug

= 1.8.1 (13/01/10) =
* Included more information in sent mail including IP, Date & Referral Page

= 1.6 (18/10/09) =
* You can now delete people from the confirmed members list (requested update!)

= 1.5 (04/10/09) =
* Fixed small error on the error checking form.

= 1.4 (03/10/09) =
* Added a check for duplicate emails.

= 1.3 (30/09/09) =
* Added a new feature where you can mention the name of the recipient of the email within the email by using the %NAME% string.
* Better default title & text for the WP Email Capture Widget.
* Fixed a bug that dropped the last character of the "From" name.

= 1.2 (27/09/09) =
* Fixed errors with the programme when using non pretty permalinks (they now work now)
* Compatible with windows based PHP configurations (1.1 introduced a function that didn't work on windows boxes).

= 1.1 revision 2 (24/09/09) =
* Fixed compatability issue with All in One SEO.
* Blogs which are on a subdomain now can use the plugin (http://www.domian.com/wordpress/)

= 1.1 revision 1 (23/09/09)  =
* Fixed small upgrade bug

= 1.1 (22/09/09) =
* Fixed short tag problem in tempdata.php
* Emails that are not valid emails aren't processed

= 1.0 RC 1 (17/09/09) =
* First Release!
* Dashboard Widget added.

= 0.4 (14/09/09) =
* Used more secure internal wp_mail class for sending out mail
* Implemented [wp_email_form] class for implementing plugin on form

= 0.3 (12/09/09) =
* Switch to headers, rather than meta refreshes for updating the page

= 0.2 (09/09/09) =
* Fixed small error in the plugin when using permalinks
* Implemented more security to the plugin

= 0.1 (07/09/09) =
* Plugin Launched