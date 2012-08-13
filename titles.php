<?php

// 965,556 rows; 616,872 rows with ISSNs or eISSNs; 76,082 distinct items with ISSN or E-ISSN.

if (!file_exists('config.ini')) {
    exit('config.ini file not found' . "\n");
}

$config = parse_ini_file('config.ini');

$input = fopen($config['dir'] . 'all.tsv', 'r');
if (!$input) {
    exit('Couldn\'t open input file ' . "\n");
}

$output = fopen($config['dir'] . 'titles.csv', 'w');
if (!$output) {
    exit('Couldn\'t open output file' . "\n");
}

$items = array();
$total = 0;

$fields = fgetcsv($input, null, "\t");

while (($row = fgetcsv($input, null, "\t")) !== false) {
    $item = array_combine($fields, $row);

    if (!$item['title']) {
        continue;
    }

    $title = $item['title'];

    foreach (array('issn', 'e_issn') as $field) {
        if (!$item[$field]) {
            continue;
        }

        $issn = $item[$field];

        if (isset($items[$issn][$title])) {
            $items[$issn][$title]++;
        } else {
            $items[$issn][$title] = 1;
        }

        if (++$total % 10000 === 0) {
            print "$total\n";
        }
    }
}

print $total . ' rows' . "\n";
print count($items) . ' items' . "\n";

fputcsv($output, array('issn', 'title', 'count'));

foreach ($items as $issn => $titles) {
    arsort($titles);
    foreach ($titles as $title => $count) {
        fputcsv($output, array($issn, $title, $count));
    }
}
