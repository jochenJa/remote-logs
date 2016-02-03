<?php
var_dump(date('H:i:s', time()));
require_once('runtime.php');
session_start();
SH::load();

__('prepare script execution ...');
sleep(1);
__('done');

__('Execute script ...');
sleep(4);
__('done');

__('Execute script ...');
sleep(4);
__('done');
SH::finish();
var_dump(date('H:i:s', time()));

