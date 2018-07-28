  
## example

### info gathering
- phpinfo(123)
- ![phpinfo](ss/phpinfo.png)
- php_uname()
- ![php_uname](ss/php_uname.png)
- disk_total_space(/)
- disk_free_space(/)
-  other

### cmd
- system(ls -la)
- ![system](ss/system.png)
- passthru(ls -la)
- exec(ls -la)
- shell_exec()

### list dir
- scandir(.) *[array]*
- ![scandir](ss/scandir.png)
- system(ls -la)
- glob(*) *[array]*
- ![glob](ss/glob.png)
- **print all php file** glob(*.php) *[array]*
- ![glob_php](ss/glob_php.png)

### open file
- file_get_contents(file.php)
- ![fgc_file](ss/file_get_contents.png)
- ![fgc_url](ss/file_get_contents_file.png)
- readfile(file.php) *[ob]*
- ![readfile](ss/readfile.png)
- system(cat file.php) / system(type file.php) *[windows]*
- highlight_file(file.php) / show_source(file.php)
- ![highlight_file](ss/highlight_file.png)
- php_strip_whitespace(file.php)
- file(file.php) *[array]*

### file handling
- **delete file** unlink(file.php)
- **handling from command** system(mv file.php to_file.php)
- **make dir** mkdir(newfolder)
- **delete dir** rmdir(foldername)
-  **touch** touch(file.php)

###  other
- function_exist(exec)
- is_writeable(.)
- is_dir(file)
- is_file(file)
