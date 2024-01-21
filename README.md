# HOME Finder 360

## Project definition

Homefinder360 is a web-based application developed using
Laravel, designed to assist
people, especially students in finding suitable housing options. The platform offers a
user-friendly interface accessible from any device with internet access. Users can easily
sign up and log in to explore a variety of posted homes in different locations. The primary
focus is on helping students find quality accommodation, particularly in challenging
situations. The web application also features a communication system, allowing users and
house owners to discuss property details seamlessly. With a commitment to simplifying the
housing search process, Homefinder360 aims to enhance the overall experience for both
tenants and property owners.


## How to run this project?
- Open your `terminal`
- clone this project by `git clone https://github.com/AbdulKhaliq59/Home-Finder-360.git`
- change directory to `cd Home-Finder-360`
- run `composer install` to install all dependencies
- configure your db like `mysql` refer to `.env` file
- run admin  seeds by `php artisan db:seed --class=AdminSeeder`
- run landlord seed by  `php artisan db:seed --class=LandlordSeeder`
- run Tenant seed by `php artisan db:seed --class=TenantSeeder`
- run `php artisan serve`
- go to your browser type `localhost:8000`
