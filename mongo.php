<?php

if (!file_exists('config.ini')) {
    exit('config.ini file not found' . "\n");
}

$config = parse_ini_file('config.ini');

if (!isset($config['mongo_url'])) {
    exit('mongo_url not set in config file' . "\n");
}

$csv = fopen($config['dir'] . 'titles.csv', 'r');
if (!$csv) {
    exit('Couldn\'t open input file' . "\n");
}

preg_match('/(\w+)\/?$/', $config['mongo_url'], $matches);

if (!$matches) {
    exit('Couldn\'t read db name from mongo_url parameter' . "\n");
}

$db = $matches[1];

$m = new Mongo($config['mongo_url']); // connect

$collection = $m->{$db}->{'titles'};
$collection->drop();

$fields = array('issn', 'title', 'count');

while (($row = fgetcsv($csv)) !== false) {
    $data = array_combine($fields, $row);
    $collection->insert($data, array('safe' => true));
}
