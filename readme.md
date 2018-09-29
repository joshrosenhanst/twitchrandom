# TwitchRandom

TwitchRandom is a Laravel project that finds random video games streams to watch using the Twitch.tv API.

## Libraries

- Laravel 5.2
- Twitch.tv API v5
- [TwitchTV SDK for PHP](https://github.com/jofner/Twitch-SDK)
- jQuery 2.2.4
- jquery.history
- jquery.nicescroll
- Boostrap 3.3.7
- Sass

## Dev Setup
1. Get a Twitch.tv API key
1. Install all Laravel requirements
1. Clone repo
1. Create Mysql DB "twitchrandom" and import the `twitchrandom.sql` file into it: `mysql -u root -p twitchrandom < twitchrandom.sql` (issue: database needs to exist before the artisan runs)
1. Copy .env.default to .env and set values
1. `composer install`
1. `npm install`
1. Set group permissions for Laravel folders (`storage/` and `bootstrap/cache/`) to your server (`www-data`). You may need to create internal storage folders: https://stackoverflow.com/questions/38483837/please-provide-a-valid-cache-path