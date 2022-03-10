# Bizmates Weather Web App

## About

This Web Application aims to provide travel information of Japan for foreign tourists visiting Japan for the first time.
The traveller has the possibility of going to the following cities.
Tokyo, Yokohama, Kyoto, Osaka, Sapporo, Nagoya.

## Key Features
- Search City
- View Forecast for Selected City and Nearby Places
- Displays City's Current Weather

## Framework - Laravel

Laravel is a free, open-source PHP web framework, created by Taylor Otwell and intended for the development of web applications following the model–view–controller architectural pattern.

## Other Technologies Used
- Javascript Framework(JQuery)
- OpenWeatherMap API (https://openweathermap.org/api)
- Foursquare Places API (https://developer.foursquare.com)

## UI and UX Implementation

The UI and UX implementation of the Web App is inspired with the **K.I.S.S (Keep it Simple, Stupid)Principle**.
An application has to be Simple and Easy enought to be understood even by those who are not well versed in technology. The application was built with minimal UI libraries and components thus, giving better loading times for better performance. The aforementioned matters are the reasons why it has the best UI and UX Implementation.

## Code Implementation

The code for the Application was built with High Regards and Respect to the Principles of OOP. It was ensured that the architecture is designed properly. Meaning it's going to be easier to maintain, refactor, and extend over time as required. It was designed with the priority of long term maintenance.

## Installation

### Requirements
- PHP 7.4+

1. Clone the from the github repository.
```
$ git clone https://github.com/kmgbarroga/weatherapp
```

2. Move into the directory.

```
$ cd weatherapp
```

3. Install PHP and Javascript Dependencies

```
$ composer install
$ npm install
```

4. Set up .env file (API Keys are found in the .env.example). Copy .env.example to .env .

```
$ cp .env.example .env
```

5. Create APP Key and Run The Application.
```
$ php artisan key:generate
$ php artisan serve
```
