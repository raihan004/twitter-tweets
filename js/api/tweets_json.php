<?php
require 'tmhOAuth.php'; // Get it from: https://github.com/themattharris/tmhOAuth

// Use the data from http://dev.twitter.com/apps to fill out this info
// notice the slight name difference in the last two items)

$connection = new tmhOAuth(array(
  'consumer_key' => 'cUkBFZRvQyditw24ixzQnJnky',
	'consumer_secret' => 'llaZ5Iisb29kso1AvwBREv7nO53HunNmTKJYe20LuljTfdd2dj',
	'user_token' => '82626441-dBywqPr2hMINGWLzB62bQxg3qiVGYI0A64iCKnTxv', //access token
	'user_secret' => 'QOYyJood3TbjqSE4NdO5vjlCkx226NJKyy7q69FHnzqbJ' //access token secret
));

// set up parameters to pass
$parameters = array();

if (isset($_GET['count'])) {
	$parameters['count'] = strip_tags($_GET['count']);
}

if (isset($_GET['screen_name'])) {
	$parameters['screen_name'] = strip_tags($_GET['screen_name']);
}

if (isset($_GET['twitter_path'])) { $twitter_path = $_GET['twitter_path']; }  else {
	$twitter_path = '1.1/statuses/user_timeline.json';
}

$http_code = $connection->request('GET', $connection->url($twitter_path), $parameters );

if ($http_code === 200) { // if everything's good
	$response = strip_tags($connection->response['response']);

	if (isset($_GET['callback'])) { // if we ask for a jsonp callback function
		echo $_GET['callback'],'(', $response,');';
	} else {
		echo $response;	
	}
} else {
	echo "Error ID: ",$http_code, "<br>\n";
	echo "Error: ",$connection->response['error'], "<br>\n";
}

// You may have to download and copy http://curl.haxx.se/ca/cacert.pem