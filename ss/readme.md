  
## example

### info gathering
- phpinfo(123)
- ![phpinfo](phpinfo.png)
- php_uname()
- ![php_uname](php_uname.png)
- disk_total_space(/)
- disk_free_space(/)
-  other

### cmd
- system(ls -la)
- ![system](system.png)
- passthru(ls -la)
- exec(ls -la)
- shell_exec()

### list dir
- scandir(.) *[array]*
- ![scandir](scandir.png)
- system(ls -la)
- glob(*) *[array]*
- ![glob](glob.png)
- **print all php file** glob(*.php) *[array]*
- ![glob_php](glob_php.png)

### open file
- file_get_contents(file.php)
- ![fgc_file](file_get_contents.png)
- ![fgc_url](file_get_contents_file.png)
- readfile(file.php) *[ob]*
- ![readfile](readfile.png)
- system(cat file.php) / system(type file.php) *[windows]*
- highlight_file(file.php) / show_source(file.php)
- ![highlight_file](highlight_file.png)
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
