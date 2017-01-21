#!/bin/bash

wget 'http://cufts2.lib.sfu.ca/knowledgebase/CUFTS_complete_20170101.tgz' --output-document='cufts.tar.gz'

mkdir cufts
tar -xvzf cufts.tar.gz --directory cufts
rm cufts/update.xml

#find cufts/ -type f -exec iconv -f iso-8859-1 -t utf-8 "{}" -o "{}-utf8.tsv" \;

find cufts/ -type f -exec mv "{}" "{}.tsv" \;
