<?php
session_start();

date_default_timezone_set('America/Argentina/Buenos_Aires');

const ENVIRONMENT_DEV = 0;
const ENVIRONMENT_PROD = 1;
const ENVIRONMENT_MAINTENANCE = 2;

$environmentState = ENVIRONMENT_DEV;