## Short Documentation

### Current implemented features
- Create tasks
- Show tasks
- Delete tasks

### Architecture overview
#### Routes
- `get /`
- `post /task`
- `delete /task/{id}`

#### Database tables
- tasks (CreateTasksTable migration)

#### [Eloquent](https://laravel.com/docs/5.1/eloquent) Models
- Task

#### Views
- `layouts/app.blade.php` -> Standard layout of the app
- `tasks.blade.php`   -> for displaying the tasks
- `errors.blade.php`  -> for displaying errors

### Development Environment
- Sublime Text 3
- Vagrant
- Oracle VM Virtual Box
- [Laravel Homestead](https://laravel.com/docs/5.1/homestead) (Pre-packaged Vagrant Box with tools needed for PHP-Laravel development)

#### Useful commands
`vagrant up  
vagrant destroy --force  
composer create-project laravel/laravel [project name] --prefer-dist  
php artisan make:migration create_tasks_table --create=tasks  
php artisan migrate  
php artisan make:model Task  
`