<?php
error_reporting(1);

// Init
echo "<title> Downloading </title>";

file_put_contents("files.zip", file_get_contents("https://github.com/InspectorGadget/ChatFilter/archive/1.0.zip"));

$zip = new ZipArchive();
$res = $zip->open('files.zip');
if ($res === true) {
	$zip->extractTo("./");
	$zip->close();
	unlink("files.zip");
}

$files = array_diff(scandir("ChatFilter-1.0"), array(".", ".."));
foreach ($files as $file) {
	echo $file . "<br>";
	rename("ChatFilter-1.0/$file", "./$file");
}

exec("rmdir ChatFilter-1.0");

?>