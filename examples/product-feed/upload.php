#!/bin/bash
<?php
include __DIR__.'/../config.php';
global $sdk;
Unirest\Request::verifyPeer(false);

dd(
    $sdk->productFeed->upload(__DIR__.'/test-product-feed.json')
);