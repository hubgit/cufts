1. Edit fetch.sh to use the URL for the latest version of the CUFTS database.
1. In the data directory, run fetch.sh to download the CUFTS database, extract the individual files, and convert them to UTF-8.
1. Open Google Refine, create a new project and import all the cufts/*-utf8 files.
1. Export all rows from Google Refine to a CSV file called "all.tsv" in the data directory.
1. Edit config.ini - set the path to the data directory ("dir").
1. Run titles.php to sum up all the titles for items with (e)ISSNs - outputs a CSV file called titles.csv.
1. (optional) Add a MongoDB url to config.ini ("mongo_url"). Run mongo.php to insert each item into a MongoDB collection.