# Edit config.ini - set the path to the data directory ("dir").

# Edit fetch.sh to use the URL for the latest version of the CUFTS database.
# In the data directory, run fetch.sh to download the CUFTS database, extract the individual files, and convert them to UTF-8.
# Open Google Refine, create a new project and import all the cufts/*-utf8 files.
# Export all rows from Google Refine to a CSV file called "all.csv" in the data directory.

# Run titles.php to sum up all the titles for items with (e)ISSNs - outputs a CSV file called titles.csv in the same folder as the input CSV file.
# (optional) Add a MongoDB url to config.ini ("mongo_url"). Run mongo.php to insert each item into a MongoDB collection. At the moment, it's hard-coded to use a database called "CUFTS".