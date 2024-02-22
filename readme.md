# XALOT

## Introduction

The company Uster wants to create an application that manages the reservation of vehicles by customers

E-R diagram
<img width="427" alt="Captura de pantalla 2024-02-22 a la(s) 16 50 43" src="https://github.com/zaratedev/xalok/assets/29809845/e23be2b2-77b0-4613-85b6-18230adb0ea8">

## Requirement

Local environment

- PHP 8.1
- Composer
- NINGX
- Postgresql

Docker

- Install docker
- Install docker compose

## Installation

Clone this repository

```
git clone https://github.com/zaratedev/xalok.git
```

For local development, run this command:
You need to configure your local environment with nginx, php 8.1, postgresql, etc.

```
composer install
php bin/console doctrine:migrations:migrate
```

For docker development, run this command:

```
make setup
```

This command executes everything necessary to build the project in http://localhost:8080

## App

URLs the symfony aplication

#### Manage vehicles
```
http://localhost:8080/vehicles
```
#### Manage drivers
```
http://localhost:8080/drivers
```
#### List trips
```
http://localhost:8080/trip
```
#### Create a trip
```
http://localhost:8080/trip/create
```

## Decisions

#### UI Framework

I decided to use bootstrap 5 to design the CRUDs for vehicles, drivers and trips.
I use boostrap 5 version CDN loading it in the app.html.twig file, I encountered some problems when trying to use symfony encore and I didn't want to waste a lot of time on this part of the frontend

#### Backend

I know that symfony provides a command to create crud faster (make:crud), but I personally like to create most of it manually, so I generated everything needed for migrations, entities, repositories and controllers manually.

#### Create trip

To create a trip, I decided to use vue js framework because of how easy it is to work javascript with vue.
I also tried to configure it with symfony encore to use webpack and compile the .vue files but I found problems when using it with docker and so I decided to use vue js version 2 via CDN.
