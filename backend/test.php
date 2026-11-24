<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<pre>";

$script = realpath(__DIR__ . "/../ai_model/predict.py");
$image = realpath(__DIR__ . "/../uploads/1780657081_screenshot_2026-06-03_150821.png");

echo "SCRIPT:\n";
var_dump($script);

echo "\nIMAGE:\n";
var_dump($image);

echo "\nCOMMAND:\n";

$command = "python \"$script\" \"$image\" 2>&1";

echo $command;

echo "\n\nOUTPUT:\n";

$output = shell_exec($command);

var_dump($output);

echo "</pre>";

?>