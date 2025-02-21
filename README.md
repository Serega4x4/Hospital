# Hospital Management System

Management of patients, doctors, and appointments in a medical facility with a role-based access control system.

## Project Description

The application is developed on Laravel 11 and provides functionality for:
- **Patients**: Appointment scheduling, viewing medical history, and prescriptions.
- **Doctors**: Managing appointments, issuing prescriptions, and accessing patient history.
- **Administrators**: Creating doctors/patients, managing appointments, and editing data.
- **Superadmins**: Full control over the system, including creating administrators.

## Key Features

### User Roles
| Role          | Capabilities                                                                 |
|---------------|-----------------------------------------------------------------------------|
| Patient       | Registration, appointment scheduling, viewing medical history and prescriptions |
| Doctor        | Viewing schedules, issuing prescriptions, accessing patient history         |
| Administrator | Creating doctors/patients, managing appointments, editing data              |
| Superadmin    | Full system control, creating administrators                                |

### Technologies
- **Backend**: PHP 8.3.11, Laravel 11.42.1  
- **Frontend**: Bootstrap 5  
- **Database**: MySQL  
- **Security**: RBAC via spatie/laravel-permission  
- **Testing**: PHPUnit  
- **Authentication**: Laravel Breeze  

## Installation

**1. **Clone the repository:
```git clone https://github.com/yourusername/hospital-management-system.git
cd hospital-management-system ```;  

**2. **  Install dependencies:  
```composer install
npm install && npm run build```  

**3. **Set up the environment:  
```cp .env.example .env
# Configure DB_* parameters in .env```  

**4. **Run migrations with seeds:  
```php artisan migrate --seed```  

**5. **Create the first superadmin:  
```php artisan db:seed --class=SuperadminSeeder```  
