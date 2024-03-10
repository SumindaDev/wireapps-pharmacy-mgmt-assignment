## How to run the project locally

Please use the following steps to run the project locally.

- Clone the repository using git clone - 
- Copy the ".env.example" file and rename as ".env"
- Create the database and update the database name and credentials on the env file on the local database server
- Then run "composer update" to resolve the dependancies.
- Then run "php artisan migrate" to setup the tables on the fresh database
- Run "php artisan db:seed" to seed the created tables with the predefined data (user roles, permissions, and role permission mappings will be synced)
- Then use "php artisan serve" or "php artisan serve --host <your host> --port <your port>" to run the project

Now you have been set up the project successfully. 

## Demo purpose user accounts with permissions

### Owner

- email - owner@pharmacy.com
- username - owner
- password - owner@pharma
- role - Owner

### Manager

- email - manager@pharmacy.com
- username - manager
- password - manager@pharma
- role - Manager

### Cashier

- email - cashier@pharmacy.com
- username - cashier
- password - cashier@pharma
- role - Cashier

## Used role permissions

- view_medication
- edit_medication
- add_medication
- temp_delete_medication
- delete_medication
- view_customers
- edit_customers
- add_customers
- temp_delete_customers
- delete_customers

## API Doc preview

- Please use "/endpoints" url with the base url (eg - http://localhost:8000/endpoints) to preview the document or you can get the link from the homepage once the project is up and running.