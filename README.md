# Semantic UI for WordPress: Developer Edition

<p align="center">
	<img src="http://i.imgur.com/AEYUA4Q.png" alt="Semantic UI for WordPress: Developer Edition Logo"><br>
	The Semantic UI starter/developer theme for WordPress.
</p>

This project incorporates Semantic UI into a starter (aka developer) theme for WordPress. This project also includes some useful techniques for creating fast, responsive, and easy-to-maintain themes for WordPress. *Please keep in mind this theme is meant to be developed for your specific application; and is not meant to be used "as-is."*

#### Download:

[![Sheild](http://img.shields.io/badge/release-1.0.0--beta2-yellow.svg?style=flat-square)](https://github.com/ProjectCleverWeb/Semantic-UI-WordPress/archive/master.zip) [![Sheild](http://img.shields.io/badge/branch-develop-brightgreen.svg?style=flat-square)](https://github.com/ProjectCleverWeb/Semantic-UI-WordPress/archive/develop.zip)

#### Screenshots

[![Screenshots](http://i.imgur.com/467EKwk.png)](http://i.imgur.com/467EKwk.png)

&nbsp;

Copyright &copy; 2014 Nicholas Jordon &mdash; All Rights Reserved

## Features

<p align="center">
	<a target="_blank" href="http://semantic-ui.com/">Semantic UI</a><br>
	<a target="_blank" href="http://en.wikipedia.org/wiki/Responsive_web_design">Responsive Design</a> | <a target="_blank" href="https://www.google.com/fonts">Google Web Fonts</a><br>
	<a target="_blank" href="https://github.com/firetix/gulp-image-optimization">Image Optimization</a> | <a target="_blank" href="http://codex.wordpress.org/Theme_Development#Theme_Options">Theme Options Page</a> | <a target="_blank" href="http://docs.woothemes.com/document/third-party-custom-theme-compatibility/">Woocommerce Support</a><br>
	<a target="_blank" href="http://fortawesome.github.io/Font-Awesome/">Font Awesome</a> | <a target="_blank" href="https://github.com/adamfairhead/webicons">Webicons</a> | <a target="_blank" href="http://sass-lang.com/">LESS/SASS Support</a> | <a target="_blank" href="http://necolas.github.io/normalize.css/">Normalize CSS</a><br>
	<a target="_blank" href="https://developers.google.com/speed/libraries/devguide">jQuery</a> | <a target="_blank" href="http://gulpjs.com/">Gulp</a> | <a target="_blank" href="https://support.google.com/webmasters/answer/176035?hl=en&amp;ref_topic=4600447">Google Microdata</a> | <a target="_blank" href="https://travis-ci.org/ProjectCleverWeb/Semantic-UI-WordPress">Unit Testing</a><br>
	<a target="_blank" href="https://highlightjs.org/">Highlight.js</a> | <a target="_blank" href="http://craig.is/killing/mice">Keyboard Shortcuts</a><br>
	Well Commented Code
</p>

## Installation

#### Requirements

* PHP 5.4 or later
* WordPress 3.9.0 or later

#### Install Guide

1. Download the release version of the theme
2. Unzip to your `wp-content/themes` directory
3. Set the theme to "active" in your WordPress dashboard

#### Building From Source

To build from source you need to have [Node.js](http://nodejs.org/) installed
and in your `$path` ([win](http://www.computerhope.com/issues/ch000549.htm)/[mac](http://apple.stackexchange.com/questions/119125/mac-os-x-mavericks-add-to-path)/[unix](http://unix.stackexchange.com/questions/26047/how-to-correctly-add-a-path-to-path)).
You should also have [PHPUnit](https://phpunit.de/) and
[Composer](https://getcomposer.org/) installed and in your `$path` as well.

&#42;&#42;Please note that when building from source, the `/dist` directory
should be renamed and then put in your `/wp-content/themes` directory

**Mac &amp; Unix:**

1. Download or clone the master branch
2. Open your command line and navigate to where you deployed the code
3. Run `npm install && sudo npm install -g gulp` enter your password and then wait for it to finish.
4. Run `gulp` to see a list of available tasks. Running `gulp build` will regenerate `/dist` from scratch.

**Windows:**

1. Download or clone the master branch
2. Open your command line and navigate to where you deployed the code
3. Run `npm install && npm install -g gulp` and then wait for it to finish.
4. Run `gulp` to see a list of available tasks. Running `gulp build` will regenerate `/dist` from scratch.

## Usage

This is a developer theme designed to be developed for your specific application. The default state of this theme is meant to be minimal &amp; organized; while not being bias to any particular design.

## Designing Pages

In this developer theme there are 4 important parts to generate a page:

- Templates
- Includes
- Contents
- Assets

**A template file** generates the general layout of a page. They generally call
the header and footer functions, get content files, and should call any includes
the page will need.

**A include file** adds functionality to a page and should have no output unless
a function or method is called in a template or content file. Include files are 
usually used for API classes and libraries, but can be used for any kind of
functionality.

**A content file** generates a group of elements and often has functionality
calls for specific elements, such as dynamic text and images. Content files
typically output the most HTML.

**Assets** are typically static files that are commonly used. These files are
usually images, stylesheets, fonts, and javascript files, and might also
include other files that need to be pre-compiled before they can be used. (such
as LESS and SASS/SCSS files)

## Contributing

#### Contributing to Semantic UI

Visit [this page](http://semantic-ui.com/project/contributing.html#/contributing)
to learn how to contribute to Semantic UI.

#### Contributing to This WordPress Theme

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

## License

**NOTICE:** All included works (aka libraries) are licensed under the MIT license
**OR** are compatible with the MIT License.

The Semantic UI for WordPress documentation by Nicholas Jordon is licensed
under the Creative Commons Attribution-ShareAlike 4.0 International License.
To view a copy of this license, visit http://creativecommons.org/licenses/by-sa/4.0/

The Semantic UI for WordPress source code by Nicholas Jordon is licensed under
the MIT License. To view a copy of this license, visit http://opensource.org/licenses/MIT

Semantic UI is not subject to this work's copyright &amp; license(s). Other
works that may also be included with this work are also not subject to this
work's copyright &amp; license(s). Copyright &amp; licensing of all included
works are determined by their respective owners.
