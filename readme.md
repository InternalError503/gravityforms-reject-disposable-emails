#### Forked from [ethanpil:gravityforms-reject-disposable-emails](https://github.com/ethanpil/gravityforms-reject-disposable-emails)

### Gravity Forms Reject Disposable Emails:
- __*Contributors:*__ ethanpil, Toady
- __*Tags:*__ gravity forms, gravity, disposable email, validation
- __*Requires at least:*__ 3.0
- __*Tested up to:*__ 4.4.1
- __*Stable tag:*__ 1.2
- __*License:*__ GPLv2 or later
- __*License URI:*__ http://www.gnu.org/licenses/gpl-2.0.html

Reject disposable email addresses in Gravity Forms email fields.

### Description:

Install this plugin into any WordPress system with a working Gravity Forms plugin and all known disposable email address hosts will be rejected and fail validation. This only checks the field type "email" and does not require any configuration or special settings. Its global, if its turned on, then its working.

Thanks to [adamloving](https://gist.github.com/adamloving/4401361) for the initial list.
Thanks to [wesbos](https://github.com/wesbos/burner-email-providers) for the updated list. 

This WordPress plugin is brought to you by [Los Angeles Web Design](https://www.angeleswebdesign.com "Los Angeles Web Design WordPress Experts")
This WordPress plugin was modified by [toady](https://github.com/InternalError503) from [8pecxstudios.com](https://8pecxstudios.com)

### Installation:

1. Upload `gravityforms-reject-disposable-emails.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the `Plugins` menu in WordPress

### Frequently Asked Questions:

__Question:__ I dont see any settings or options!
__Answer:__ There arent any!

__Question:__ How to I enable it?
__Answer:__ If the plugins system has it on then its working.

__Question:__ Where did you get the list of domains?
__Answer:__ Thanks to [adamloving](https://gist.github.com/adamloving/4401361) for the initial list.

__Question:__ Where did you get the updated list of domains?
__Answer:__ Thanks to [wesbos](https://github.com/wesbos/burner-email-providers) for the updated list. 

__Question:__ Screenshots
__Answer:__ There is nothing to see here.

#### Changelog:

##### 1.2
- Updated email black list from [wesbos](https://github.com/wesbos/burner-email-providers)
- Fixed root directory disclosure from null or empty email fields.

##### 1.1
- Fixed email case sensitivity bug. Thanks @jkirker

##### 1.0
- Hello World! Goodbye bad email addresses!
