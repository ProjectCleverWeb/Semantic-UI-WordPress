If you add a PHP file to this directory, it is magically included via the
theme's bootstrap file.

PLEASE ONLY ADD PHP FILES WITH 1 FUNCTION CONTAINED WITHIN THEM, AND NAME THEM
AFTER THEIR CONTAINED FUNCTION.

Do not add any additional logic to the file, and ensure that each file has only
1 function within it. If you would like to group functions, please prefix BOTH
the file name and the function name.

================================================================================

Using the file-system to organize functions is a lot simpler than trying to
search a single "functions" file, which can easily reach 5000+ lines. This way,
we would only have to search through function names, and if we are using a file
explorer we can even sort them by different criteria.
