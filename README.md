# teamDigital Full-Stack Development Interview Project #

This project is to assess your skills as a full-stack developer. There isn't a "correct" way to complete this project, so just do your best. This is designed for us to see how you develop code and then we will talk through your process.

### The Assignment ###

Build a small sweepstakes application. This must include:
- Backend build with Laravel
- A form to collect... 
  - First name
  - Last name
  - Email
  - Phone number
  - Accepting the rules checkbox
  - Optin to our newsletter checkbox
- Proper validation of all fields.
  - All fields should be required except the optin
- Save data to a database (mysql or sqllite)
- Allow users to enter once a day
- Create a confirmation page with basic copy saying "confirm entry" or "already entered"
- Style the page using Tailwind css
- It is preferred to use VueJs but you can use blade templates if you don't know Vue

### In this Codebase ###

We have provided a base Laravel application with some base routing to same you come time. This includes:
- Laravel 9 base code
- Vite code compiler
  - `npm run dev` will start watcher for development
  - `npm run build` will build files
- Tailwind installed in `package.json` with base `tailwind.config.js` ready to be added to
- VueJs 3 installed in  `package.json` and added to Vite setup
- Basic routes found in `routes/web.php`
- Basic controller functions found in `app/Http/Controllers/PagesController.php`

Add packages/libraries or code as you see fit to get the job done.

### Setup ###
- Copy `.env.example` to `.env`
  - Update database fields as needed
- Run `composer install` to install backend packages
- Run `npm install` to install frontend packages

