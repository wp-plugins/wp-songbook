=== WP Songbook ===
Contributors: sjiamnocna
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=65SS8NS48FPFQ&lc=CZ&item_name=%c5%a0imon%20Jan%c4%8da&currency_code=CZK&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: songbook, songs, lyrics, info, music, songlist
Requires at least: 3.2
Tested up to: 4.2.2
Stable tag: 1.6
License: GPLv2 or later

Wordpress plugin, that allows people to manage song lyrics and adds many other features to edit them.

== Description ==

WP Songbook adds opportunity to manage song lyrics on your Wordpress based blog. It's simple tool to add lyrics or authors and share lyrics or other files that relates to it. For now it allows set Lyrics, Authors, Files, Youtube link and Speed.

= Songs managing =
- Custom post type "Songs"
- Using editor you can edit lyrics of your song
- Adds custom box for uploading and linking files to songs
- Adds custom box for adding video links, song tempo and duration
- Adds custom taxonomies Authors, Albums and Genres.

= Linked file manager =
- Allows to sort, lock for private or unlink files from songs
- Displays linked files under the song lyrics

= Song list =
- You can select your page, that will be used for song list in settings or you can let the plugin create one for you
- The list contents all songs and their authors with link to see whole song
- You can select how do you want songs be ordered
- Youtube link that you add to song is displayed in the list

= Song appearance =
- You can specify the wrapper element that will wrap the lyrics
- You can set to display song author or song files or not in settings

= Settings page =
If you miss something, you can use settings page

`If anything doesn't work, please visit "Support" tab, and leave a topic in forum. I'll also appreciate every idea to improve, so don't hesitate to [leave a topic in support forum]`

== Screenshots ==

1. Right after activation you will see this added in your menu
2. Editing the lyrics is the same as editing any other content on your Wordpress site
3. Its very simple to add an author name to song that will be displayed in song list (set on options page)
4. You can link some files, that are shown on the single song display page
5. Just open the media manager and choose files to link with song
6. Its the same to manage authors and manage post categories
7. If anything is not OK you can change some settings to make it better
8. This is the song list settings. Here you can specify how the song list appears on public. You can choose from existing pages or let the create one for you
9. That's all, the list is now added to page. You can add it to menu or send its link to your friends.
10. Becouse of technic beginners there's also small guide, for managing songs with WP Songbook

== Installation ==

- Unpack archive contents into plugin folder (/wp-content/plugins/) and activate it in plugin manager, the bookmark "Songs" will appear in admin menu after activation
- Click the Songs admin menu item, and choose settings. Now you can set everything, that you need for it
- In menu Songs, go to the Guide, and read some basic information about working with this plugin

== Changelog ==

= [2.0.&delta;](https://downloads.wordpress.org/plugin/wp-songbook.2.0d.zip) =
- Fixed sort order in list

= [2.0.&gamma;](https://downloads.wordpress.org/plugin/wp-songbook.2.0c.zip) =
- 
- Rebuilt song info metabox
- List may contain list of taxonomy terms linked to list of their songs
- Added meta field for song duration
- Added bones for future playlists feature

= [2.0.&alpha;](https://downloads.wordpress.org/plugin/wp-songbook.2.0a.zip) &amp; [2.0.&beta;](https://downloads.wordpress.org/plugin/wp-songbook.2.0b.zip) =
- Everything's back compatible - you shouldn't loose anything, but for safety, backup your data before updating
- Completely rebuilt code for better functionality and extensibility, replacing the old not properly working version
- Refined plugin settings page and song metaboxes
- Removed help page - basic guide is located on settings page and every field has its description
- Started archiving versions in the "Developers" tab
- Not all functions are available yet, use only for testing

= 1.6 =
- Added option to allow adding comments to lyrics
- Fixed problem with lyrics wrapper

= 1.5.3 =
- Trying to fix some bug in code, that may couse PHP error on some servers

= 1.5.2 =
- Added edit song button into song list
- Readded video link to the song list
- Fixed bug that added link back to list to song list
- Tested and improved for Wordpress 4.0
- Fixed few PHP warnings

= 1.5.1 =
- Fixed error with displaying list

= 1.5 =
- Now allows choose content displayed in the list by default
- Improved filtering archive link for custom taxonomies
- Improved creating list table to be easier to add new columns for future
- Updated language files

= 1.4.3 =
- Fixed warnings and notices shown by WP_DEBUG that may couse errors
- Updated language files

= 1.4.2 =
- Added new warnings
- Improved few functions to work better
- Removed few parts, that could be wrong and arent necessary

= 1.4.1 =
- Fixed missing files, that resulted in error

= 1.4 =
- Added taxonomy Album + enable option to settings
- Added taxonomy Genre + enable option to settings
- Now there's an option to use publish year in the songlist (you can set time in editor on right side in publication controls)
- Added options to allow of displaying song list grid new columns Album, Genre and Year
- Updated language files with few new phrases

= 1.3 =
- Now its possible to display list of author's songs
- Button for displaying Authors name was added to song list
- Added options to show or hide list header and link to list of author
- Updated language files

= 1.2.3 =
- Added warnings and messages to inform if something is wrong
- Fixed saving the options

= 1.2.2 =
- Language files revision
- Added new screenshots and improved readme file to contain important informations
- Updated Screenshots

= 1.2.1 =
- Fixed readme.txt to give relevant informations about this plugin
- If theres any file to display (and not blocked by any private rule), is displayed
- Removed Fancybox for license troubles

= 1.2 =
- At first, the files are now working, Im sorry for all troubles
- You can choose song lyrics wrap element to improve look of the page
- Fixed icons to fit new WP admin lookup
- If installing, default settings are automatically added
- Auto creating new page for song list is now option of song list page select
- If any file is removed from Wordpress, appears as broken in editor and is no more linked to song after saving
- Option to show Go Back to song list button in all songs
- Added second column to plugin settings page
- Removed list of added files from song list - it only caused errors
- All styles are now external

= 1.1.2 =
- When removing plugin, all settings are removed from database
- Fixed: If no author is set to song, nothing will appear in song list

= 1.1.1 =
- Fixed bugs with attaching files - didn't save value when no file is chosen
- Fixed bug with listing files and songs
- Files no more appears in song when they were deleted from Wordpress
- Improved admin script and style including
- Since this version automatically adds default settings after install

= 1.1 =
- Many key core changes
- Changed song listing system
- Now existing page with songs is detected by exist, not by option
- Updated language files
- Added option to show files to logged/unlogged users

= 1.0.3 =
- Fixed some language bugs
- Added settings and guide links to the plugins page

= 1.0.2 =
- Im very sorry for that troubles I made you. Now it shouldn't happen anymore. Hope :)

= 1.0.1 =
- Bug: last version, after wordpress installation on some hostings causes error

= 1.0 =
- Its great to tell, all basic things are working well :)
- After saving settings you know what was changed.
- If you have any problem or idea, let me know.

= 0.9.3 =

- Finally added songbook settings page and fixed troubles with metaboxes

= 0.9.2 =
- Added filebox for adding files to songs and other to add aditional info about song. Now you can define song tempo or add link to video on internet.

= 0.9.1 =
- Solved trouble with displaying, shortcodes and added new feature - Widget for displaying newest songs

= 0.9 =
- Added to repository, still not finished but stable. Adds CPT Song, Taxonomy Author and some plugin "guide of use" to Wordpress installation