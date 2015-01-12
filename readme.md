## Stream Randomizer

The stream randomizer will pick a random live stream on page load from twitch to display on the home page. It will also grab other random streams for the gallery.

## Libraries
* Laravel 4.2
* Sass/Scss
* Bootstrap
* jQuery 2.1.3


## Installation instructions
1. Setup nginx/apache VirtualHost + hosts file. Set ServerName variable to randomizer.dev (or whatever you want, but you have to update /app/config/local/app.php with that name)  
  * If you want a quick nginx template, check out https://bitbucket.org/joshrh88/randomizer/wiki/Nginx%20Local%20Server%20Setup  
  * I don't use apache, so you can figure out your own VirtualHost setup http://stackoverflow.com/questions/19802286/laravel-4-virtual-host-and-mod-rewrite-setup  
2. Install laravel via http://laravel.com/docs/4.2/quick -- They install a bunch of required vendor libraries that aren't in this repo that you need.
3. Grab the repo
4. Setup a mysql db. Update /app/config/local/database.php with your db details