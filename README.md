## Laravel Evaluation Task (Laravel, Livewire, Alpine)


## Installation

git clone https://github.com/makawy7/dubisigntask.git
cd dubisigntask
`composer install`
`php artisan key:generate`
`php artisan migrate`
`php artisan serve`

## Views

The following views are available:

-   `/`: Home page.
-   `/users/create`: A view to create new user.

## API Endpoints

The following API endpoints are available:

-   `POST /user/store`: Create new user.
    - Request:
            - user_type (required): string, one of "standard", "certified", "locationed"
            - username (required): string, unique
            - email (required): string, unique, valid email format
            - bio (optional): string
            - map_location (required if user_type is "locationed"): string
            - date_of_birth (required if user_type is "locationed"): date
            - cert_name (required if user_type is "certified"): string
            - file_path (required if user_type is "certified"): string
    - Response:
        - A JSON object containing the newly created user's details.
-   `POST /user/certification`: Upload the certification file.
    - Request:
        - cert_file (required): file, allowed mime types: jpeg, jpg, png, pdf, max size: 10240 KB
    - Response:
        - A JSON object containing a success message and the file path of the uploaded certification file.

