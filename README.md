<div align="center">

<img src="https://media.retroachievements.org/UserPic/Cheke.png" width="100" alt="RetroAchievements">

# `gboquizosanchez/retroachievements`

**RetroAchievements.org API client for Laravel**

[![Latest Stable Version](https://img.shields.io/packagist/v/gboquizosanchez/retroachievements.svg)](https://packagist.org/packages/gboquizosanchez/retroachievements)
[![Total Downloads](https://img.shields.io/packagist/dt/gboquizosanchez/retroachievements.svg)](https://packagist.org/packages/gboquizosanchez/retroachievements)
[![PHP](https://img.shields.io/badge/PHP-%5E8.3-777BB4?logo=php&logoColor=white)](https://packagist.org/packages/gboquizosanchez/retroachievements)
[![Laravel](https://img.shields.io/badge/Laravel-11%20%7C%2012-FF2D20?logo=laravel&logoColor=white)](https://packagist.org/packages/gboquizosanchez/retroachievements)
[![License: MIT](https://img.shields.io/badge/License-MIT-22C55E.svg)](LICENSE.md)

---

*Fetch achievements, user stats, and game data from RetroAchievements.org directly in your Laravel app.*

</div>

---

## Overview

A Laravel package that wraps the full [RetroAchievements API](https://api-docs.retroachievements.org/getting-started.html), giving you access to game data, user profiles, achievement lists, and more — with optional DTO mapping via [spatie/laravel-data](https://github.com/spatie/laravel-data).

> **Note:** You need a [RetroAchievements account](https://retroachievements.org/createaccount.php) and a Web API key from your [control panel](https://retroachievements.org/controlpanel.php) to use this package.

---

## 📦 Installation

```bash
composer require gboquizosanchez/retroachievements
```

Add your credentials to `.env`:

```env
RA_USERNAME=your_username
RA_WEB_API_KEY=your_api_key
```

Optionally, publish the configuration file:

```bash
php artisan vendor:publish --provider="RetroAchievements\RetroAchievementsServiceProvider"
```

---

## 🚀 Usage

### Via facade

The facade reads credentials directly from your `.env`:

```php
use Retroachievements\RetroClient;

RetroClient::getGame(gameId: 1);
```

### Via the client directly

Useful when working with multiple accounts or custom credentials:

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

You can also use the default credentials from config:

```php
$auth = new AuthData(...config('retro-achievements.credentials'));
```

---

## 🗺️ Response mapping

By default, the package maps responses to typed DTOs. You can switch to raw responses via `.env`:

```env
# Default — typed DTOs via spatie/laravel-data
RA_DTO_MAPPING=true
RA_RAW_MAPPING=false

# Raw responses — disable DTO mapping first
RA_DTO_MAPPING=false
RA_RAW_MAPPING=true
```

> `RAW` mapping only works when `RA_DTO_MAPPING` is set to `false`.

---

## 📚 Available methods

This package covers all endpoints from the [RetroAchievements API](https://api-docs.retroachievements.org/getting-started.html). See [`RetroClient`](src/RetroClient.php) for the full method list.

---

## 🧪 Testing

```bash
composer test
```

---

## Contributing

Contributions are welcome!

- 🐛 **Report bugs** via [GitHub Issues](https://github.com/gboquizosanchez/retroachievements/issues/new)
- 💡 **Suggest features** or improvements
- 🔧 **Submit pull requests** with fixes or enhancements

---

## Credits

- **Author**: [Germán Boquizo Sánchez](mailto:germanboquizosanchez@gmail.com)
- **Contributors**: [View all contributors](../../contributors)

---

## 📄 License

This package is open-source software licensed under the [MIT License](LICENSE.md).
