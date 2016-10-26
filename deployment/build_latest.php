#!/usr/bin/env php
<?php
$theme = 'nm404';


$style = file_get_contents('../'.$theme.'/nm404.php');
preg_match ( '|Version:(.*)|i', $style, $a_version );

if(!isset($a_version[1])) { exit; }
$version = trim($a_version[1]);


$zip = new ZipArchive();


chdir("../");
system("zip -r deployment/latest.zip $theme/");