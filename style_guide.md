#Style Guide

###PHP

#####Rules:

- Tabs not spaces.
- Spaces before/after curly brackets and language operators when next to other code on same line.
- Curly brackets do not get a dedicated line unless they are closing brackets.
- Objects get their own file with an appropriate suffix.
- Minified filoe must have a "min" suffix.
- Namespaces are reflected in filenames.
- <kbd>\\</kbd> and <kbd>/</kbd> are replaced with <kbd>-</kbd> in filenames &amp; string identifiers.
- Variable, constant, function, method, namespace, class, and interface names **must** be snake_case.
- All constants, including bool and magic constants, **must** be all caps.
- When defining multiple variables, the <kbd>=</kbd>'s should all line up.
- Comma seperated values should have a space after each comma.
- Lines should not end with a space.
- Language constructs should include parentheses.

#####Example:

```php
/**
 * index.php
 */
$my_var = TRUE;
$dir    = __DIR__;

if ($my_var) {
	define('MY_CONST', $dir, 1);
} else {
	define('MY_CONST', FALSE, 1);
}

while (get_my_files(MY_CONST)) {
	include($files.'/example-my_class.class.min.php');
}

$obj = new \example\my_class;
$obj->test();

/**
 * example-my_class.class.php
 */
namespace example; class my_class{function test(){echo('success');}}

```

#####Architecture:

The framework is designed so that it can easily be ported to other CMS's (not just WordPress). Keep this in mind when programming, and avoid CMS specific options.

In many ways this is solved by the $data_class; as it is specifically meant for this purpose. In many cases 1 CMS will have functionlity that is not available in another. This can be solved 2 ways: 1) recreate the functionality yourself 2) disable the functionality, and ensure no error result from the disabled functionality in any CMS.
