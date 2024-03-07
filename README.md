<p align="center"><a href="#" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## MultiLanguage Laravel routing

### Installation

- composer require embit88/multilang-laravel

- php artisan vendor:publish --tag=multilang --force

- php artisan migrate --seed

- Add in prefix route "MultiLanguage::url()"

#### Methods

- MultiLanguage::id() - ID language

- MultiLanguage::title() - Title language

- MultiLanguage::code() - Code language

- MultiLanguage::encoding() - Encoding language

- MultiLanguage::locale() - Locale language

- MultiLanguage::url() - URL language


- MultiLanguage::getLanguages() - Get all languages

- MultiLanguage::getBaseLanguage() - Get base language

- MultiLanguage::getCurrentLanguage() - Get current language
