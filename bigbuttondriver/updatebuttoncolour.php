<?php
$red   = $_POST['red'];
$green = $_POST['green'];
$blue  = $_POST['blue'];

echo $red . " " . $green . " " . $blue;

chdir(__DIR__ . "/../Hardware");

$command = "python colour_client.py " . $red . " " . $green . " " . $blue;
shell_exec($command);
