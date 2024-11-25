<p align="center" dir="auto"><a href="https://retroachievements.org" rel="nofollow"><img src="https://media.retroachievements.org/UserPic/Cheke.png" width="100" alt="RetroAchievements Logo" style="max-width: 100%;"></a></p>
<h1 align="center">RetroAchievements.org API Container for Laravel</h1>

<hr />

## Summary
A library that lets you get achievement, user, and game data from RetroAchievements.org directly in your Laravel application.

## Starting 🚀

### Prerequisites 📋
- Composer.
- PHP version 8.3 or higher.

## Running 🛠️

Install the package via composer:

```shell
composer require gboquizosanchez/retroachievements
```

Establish the configuration in the `.env` file:

```dotenv
RA_USERNAME=your_username
RA_WEB_API_KEY=your_api_key
```

You can also publish the configuration file to customize the package:

```shell
php artisan vendor:publish --provider="RetroAchievements\RetroAchievementsServiceProvider"
```
**Note**: You need to have a RetroAchievements account to use the API. If you don't have one, you can create one [here](https://retroachievements.org/createaccount.php). And also, you need to have a web API key. You can get one in your [control panel](https://retroachievements.org/controlpanel.php).

## Basic Usage 👷

You can use two different methods:

### Using the facade

This method provides directly from ```.env``` file the username and the web API key.

```php
use Retroachievements\RetroClient;

RetroClient::getGame(gameId: 1);
```

### Using the RetroAchievements model directly

You can provide a custom username and web API key if you want to use different credentials.

Or, you can use the default ones from the ```.env``` using  ```config('retro-achievements.credentials')```.

```php
use Retroachievements\Data\AuthData;
use RetroAchievements\Models\RetroAchievements;

$auth = new AuthData(
    username: 'your_username',
    webApiKey: 'your_api_key',
);

$client = new RetroAchievements($auth);

$client->getGame(gameId: 1);
```

### Mapping the response 🗺️

There are two ways to map the response. By default, the package uses the DTO mapping.

```dotenv
RA_DTO_MAPPING=true
RA_RAW_MAPPING=false
```

**Note**: If you want to use the raw mapping, you need to set the ```RA_DTO_MAPPING``` to ```false``` and the ```RA_RAW_MAPPING``` to ```true```. RAW only works with DTO mapping disabled.


## Available methods 📚

This package provides all methods available in the [RetroAchievements API](https://api-docs.retroachievements.org/getting-started.html).

See the [RetroClient facade](src/RetroClient.php) for more information.

## Working with ⚙️
### PHP dependencies 📦
- Spatie Laravel Data [![Latest Stable Version](https://img.shields.io/badge/stable-4.11.1-blue)](https://packagist.org/packages/spatie/laravel-data)
#### Develop dependencies 🔧
- Friendsofphp Php Cs Fixer [![Latest Stable Version](https://img.shields.io/badge/stable-v3.64.0-blue)](https://packagist.org/packages/friendsofphp/php-cs-fixer)
- Larastan Larastan [![Latest Stable Version](https://img.shields.io/badge/stable-v2.9.11-blue)](https://packagist.org/packages/larastan/larastan)
- Orchestra Testbench [![Latest Stable Version](https://img.shields.io/badge/stable-v9.6.1-blue)](https://packagist.org/packages/orchestra/testbench)
- Pestphp Pest [![Latest Stable Version](https://img.shields.io/badge/stable-v3.5.1-blue)](https://packagist.org/packages/pestphp/pest)

## Testing ✅

```shell
composer test
```

## Problems? 🚨

Let me know about yours by [opening an issue](https://github.com/gboquizosanchez/retroachievements/issues/new)!

## Credits 🧑‍💻

- [Germán Boquizo Sánchez](mailto:germanboquizosanchez@gmail.com)
- [All Contributors](../../contributors)

## License 📄

MIT License (MIT). See [License File](LICENSE.md).
