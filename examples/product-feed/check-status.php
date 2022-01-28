#!/bin/bash
<?php
include __DIR__.'/../config.php';
global $sdk;
Unirest\Request::verifyPeer(false);

dd(
    $sdk->productFeed->checkStatus('c1b65742-fe63-4c2d-8198-21b9342c6012')
);