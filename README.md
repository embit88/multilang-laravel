<p align="center"><a href="#" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## MultiLang Laravel routing

### Установка
###

- composer require embit88/multilang-laravel

- php artisan vendor:publish --tag=multilang --force

- php artisan migrate --seed

- Добавьте в prefix route MultiLanguage::url()

#### Дополнительные методы
###

- MultiLanguage::id() - ID языка
- MultiLanguage::title() - Название языка
- MultiLanguage::code() - Код языка
- MultiLanguage::encoding() - Encoding языка
- MultiLanguage::locale() - Локаль языка
- MultiLanguage::url() - URL языка
####
- MultiLanguage::getLanguages() - Получить все языки
- MultiLanguage::getBaseLanguage() - Получить язык по-умолчанию
- MultiLanguage::getCurrentLanguage() - Получить текущий язык
