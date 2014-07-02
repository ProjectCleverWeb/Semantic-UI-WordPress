#Semantic UI for WordPress#
The [Semantic UI](https://github.com/Semantic-Org/Semantic-UI) WordPress
developer Theme.

###Current Version: 1.0.0-beta###

This project incorperates Semantic UI into a developer theme for WordPress. This
project also includes some of my favorite techniques for creating fast,
responsive, and easy-to-maintain themes for WordPress. *Please keep in mind this
theme is meant to be developed for your spcific application; and is not meant to
be used "as-is."*

####Download: [1.0.0-beta](https://github.com/ProjectCleverWeb/Semantic-UI-WordPress/archive/1.0.0-beta.zip)####

###Features###
- Semantic UI
- Google Web Fonts
- Normalize CSS
- jQuery 1.10.2 (CDN)
- Font Awesome
- Woocommerce Support
- Structured Data Markup
- Webicons
- Resonsive Design
- Highlight.js
- Theme Options Page
- Async Script Loading
- Keyboard Shortcuts
- Well Commented Code

<br>

##Table of Contents##
* [Installation](#installation)
  * [Requirements](#requirements)
  * [Install Guide](#install-guide)
* [Usage](#usage)
  * [Features](#features)
  * [Designing Pages](#designing-pages)
* [Contributing](#contributing)
  * [Contributing to Semantic UI](contributing-to-semantic-ui)
  * [Contributing to The WordPress Theme](contributing-to-the-wordpress-theme)
* [Copyright & Licensing](#copyright--licensing)

<br>



##Installation##
####Requirements####
* PHP 5.3.7 or later
* WordPress 3.9.0 or later

####Install Guide####
1. Download the theme
2. Unzip to your `wp-content/themes` directory
3. Set the theme to "active" in your WordPress dashboard

[Table of Contents](#table-of-contents)



##Usage##
This is a developer theme designed to be developed for your specific application.
The default state of this theme is meant to be plain &amp; organized; while not
being bias to any particular design. (thus everything defaults to black and
white)


####Designing Pages####
In this developer theme there are 5 important parts to generate a page:

- Templates
- Includes
- Layouts
- Contents
- Assets

**A template file** decides which layout to use based on the type of content
that is being requested. A template file will typically have no HTML or very
little HTML, but should get all the necessary includes for the page.

**A include file** adds functionality to a page and should have no output unless
a function or method is called in a template, layout, or content file. Include
files are usually used for API classes and libararies, but can be used for
anything related to functionality.

**A layout file** decides where sidebars, and the content is inserted. Layout
files should usually have a fair or large amount of HTML content, as well as a
few functionality calls; such as calling a comments thread or specific form to
be generated. The header and footer is usually inserted via the layout file.

**A content file** generates a group of elements and often has functionality
calls for specifc elements, such as dynamic text and images. Content files
typically output the most text, and usually have a large amount of HTML.

**Assets** are files that are typically static files that are commonly used.
These files are usually images, stylesheets, fonts, and javascript files, and
might also include other files that need to be precompiled before they can be
used. (such as LESS and SASS/SCSS files)

[Table of Contents](#table-of-contents)



##Contributing##
###Contributing to Semantic UI###
Visit [this page](http://semantic-ui.com/project/contributing.html#/contributing)
to learn how to contribute to Semantic UI.

###Contributing to This WordPress Theme###
**Contributing *via* Suggestions:** <br>
The best way to submit a suggestion is to open an issue on Github and prefix the
title with `[Suggestion]`. Alternatively, you can email your suggestions to
projectcleverweb (at) gmail (dot) com.

**Contributing *via* Reporting Problems:** <br>
All problems must be reported via Github's
[issue tracker](https://github.com/ProjectCleverWeb/Semantic-UI-WordPress/issues).

**Contributing *via* Code:**

1. Fork the repo on Github: [github.com/ProjectCleverWeb/Semantic-UI-WordPress](https://github.com/ProjectCleverWeb/Semantic-UI-WordPress)
2. Make your changes.
3. Send a pull request to have your changes reviewed.

[Table of Contents](#table-of-contents)



##Copyright & Licensing##
Copyright &copy; 2014 Nicholas Jordon - All Rights Reserved

Source-Code License: MIT&#42;&#42; <br>
Source-Code License URL:
[opensource.org/licenses/MIT](http://opensource.org/licenses/MIT) <br>
Displayed Content License: CC BY SA&#42;&#42; <br>
Displayed Content License URL: 
[creativecommons.org/licenses/by-sa/3.0/deed.en_US](http://creativecommons.org/licenses/by-sa/3.0/deed.en_US)

The displayed content (as appose to source-code) of this work, such as images
and documentation (including its' "readme" files), are licensed under a
[Creative Commons Attribution-ShareAlike 3.0 Unported License](http://creativecommons.org/licenses/by-sa/3.0/deed.en_US).

&#42;&#42; [Semantic UI](http://sematic-ui.com) is not subject to this work's
copyright &amp; license(s). Other works that may also be included with this work
are also not subject to this work's copyright &amp; license(s). Copyright &amp;
licensing of all included works are determined by their respective owners.


[Table of Contents](#table-of-contents)