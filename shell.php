<?php

var_dump(date('H:i:s', time()));
require_once('runtime.php');
var_dump(date('H:i:s', time()));
session_start();
var_dump(date('H:i:s', time()));
SH::log('trying to fetch new lines ..');
var_dump(date('H:i:s', time()));
echo SH::flush();
var_dump(date('H:i:s', time()));
exit;