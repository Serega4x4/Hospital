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
- **Containerization**: Docker, Docker Compose  

## Installation
1. Clone the repository:  
```bash
git clone https://github.com/yourusername/hospital.git    
```

2. Change directory: 
```bash
cd hospital  
```

3. Set up the environment: 
```bash
cp .env.example .env  
```
4. Set up docker:  
```bash
docker-compose up -d --build  
```
5. Generate key:  
```bash
docker-compose exec app php artisan key:generate  
```  
6. Visit in your browser:  
```bash
http://localhost/  
```  
7. E-mail of superadmin:
```bash
admin@mail.com
```
8. Password of superadmin:  
```bash
password
```
