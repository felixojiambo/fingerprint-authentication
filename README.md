Project Setup Documentation:

1. Overview:

This project is a Laravel web application that implements user registration with fingerprint authentication.
It utilizes Laravel's authentication system along with custom logic for fingerprint authentication.
2. Project Structure:

app/: Contains application logic including controllers, models, and middleware.
resources/views/: Holds Blade templates for UI views.
routes/web.php: Defines web routes for the application.
public/: Contains publicly accessible assets like CSS, JavaScript, and image files.
database/migrations/: Contains database migration files for defining database schema.

3. Installation:

Clone the project repository from GitHub: git clone https://github.com/felixojiambo/fingerprint-authentication.git
Navigate to the project directory: cd <project_directory>
Install composer dependencies: composer install
Copy .env.example to .env: cp .env.example .env
Generate application key: php artisan key:generate

Migrate database tables: php artisan migrate
Serve the application: php artisan serve
1. Usage Instructions:

Access the application in your browser at http://localhost:8000
Navigate to the registration page and fill in the required details.
Upload an image of your fingerprint when prompted.
Upon successful registration, you will be redirected to the login page.
Use your email and password for standard login or choose the fingerprint authentication option.