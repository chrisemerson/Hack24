<?php
$red   = $_POST['red'];
$green = $_POST['green'];
$blue  = $_POST['blue'];

chdir(__DIR__ . "/../Hardware/PythonInterface/");

$command = "C:\\Python34\\python.exe colour_client.py " . $red . " " . $green . " " . $blue;
shell_exec($command);
