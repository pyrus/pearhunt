
# PEAR channel *information* aggregator

This DOES NOT AGGREGATE PACKGES! It only aggregates information about packages.

At php|tek, I was chatting with MWOP, Ed, and Helgi about adding a `search` command to pyrus. This command
would search some service that aggregates PEAR package information, and would make it easier for people to 
discover PEAR channels and packages.


I hacked this together at php|tek, and this is my response to that discussion.  

There's no admin interface, only CLI scripts to add channels and update channels.

I just used what I knew... so it's a mysql db using the mysqi ext and a stupid active record implementation.

## Setup!

Clone the repo!

There's a Config class in `etc/` with the default configuration in it.
Just copy it to `config.inc.php` and adjust paths.

You'll need a checkout of PEAR2_Pyrus as well: https://github.com/pyrus/Pyrus

Create a DB that can be connected using `mysqli://pearhunt:pearhunt@localhost/pearhunt`

If you want to use your own mysql credentials, copy `etc/config.sample.php` to `config.inc.php` and add the following:

    Config:setDbSettings(array(
        'host'     => 'example.org',
        'username' => 'mysql user',
        'password' => 'super secret password'
        'dbname'   => 'my_database',
    ));

Finally:

 * run `./scripts/upgrade.php` from cli to create and setup the DB
 * run `./scripts/addChannel.php pear.php.net` to add a channel to the db.

## Indexing PEAR channels

Add a channel and discover all packages:

 * `./scripts/addChannel.php pear.example.com`

Update a channel:

 * `./scripts/updateChannel.php pear.example.com`

## Searching!

 * Search using the form which comes up from `www/index.php`
 * It'll issue an ajax request to `www/index?q=foo`

Content type is determined by the client's `Accept` header.

## TODO

When scanning the channels, also scan the packages and index all the classes each package provides...
this would allow us to build a really dangerous autoloader that would install vendor dependencies 
automatically   B-)

