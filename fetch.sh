#!/bin/bash

mkdir cufts

wget --continue 'http://cufts2.lib.sfu.ca/knowledgebase/CUFTS_complete_20120801.tgz' --output-document=cufts.tar.gz
tar -xvzf cufts.tar.gz --directory cufts
rm cufts/update.xml

find cufts/ -type f -exec iconv -f iso-8859-1 -t utf-8 "{}" -o "{}-utf8" \;
