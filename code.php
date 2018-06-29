<?php

echo sprintf('File %s.', __FILE__);

// TEST-1
//$x = 1/0;

// TEST-2
// sdffdf

// TEST-3
//function(test) {
//
//};

// TEST-4
// Test Monolog
//$log = new Monolog\Logger('name');
//$log->pushHandlerr(new Monolog\Handler\StreamHandler('app.log', Monolog\Logger::WARNING));
//if ($log->addWarning('Foo')) {
//    echo "Monolog works.";
//} else {
//    echo printf("Monolog does not work. Something went wrong... Check the code inside %s file.", __FILE__);
//}

// TEST-5
// Test curl
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, "https://www.atlassian.com/software/jira");
//curl_setopt($ch, CURLOPT_TIMEOUT, 1); //timeout in seconds
////curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
////curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
//curl_setopt($ch, CURLOPT_FAILONERROR, true);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //return the transfer as a string
//$output = curl_exec($ch);
//$error = curl_error($ch);
//curl_close($ch);
//if(!$output || $error) {
//    throw new \RuntimeException($error);
//}

// TEST-6
//throw new \Exception('Simply test Rollbar. Rand #' . date('Y-m-d H:i:s - ') . time());

// TEST-7 (NOT WORKING! See shutdown function...)
//function curl_setopt() {
//    echo "I want this function to be working!";
//}

echo '<br>';
echo 'Success.';