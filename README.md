<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel Task Management System

A comprehensive task management web application built with Laravel, featuring role-based access control, CRUD operations, and a modern AdminLTE interface.

## Project Overview

This Laravel application demonstrates advanced web development concepts including authentication, authorization, database relationships, and modern UI integration. The system supports two user roles with distinct capabilities and provides a complete task lifecycle management solution.

## Features

### Core Functionality
- **User Authentication** - Laravel Breeze integration with secure login/registration
- **Role-Based Access Control** - Admin and User roles with different permissions
- **Task Management** - Complete CRUD operations (Create, Read, Update, Delete)
- **Dashboard Analytics** - Visual statistics and recent activity overview
- **Search & Filtering** - Find tasks by title, status, and priority
- **Pagination** - Efficient handling of large task lists

### User Roles
- **Admin Users**
  - View and manage all tasks across the system
  - Assign tasks to regular users
  - Access comprehensive analytics dashboard
  - User management capabilities

- **Regular Users**
  - Create and manage personal tasks
  - Track task progress and deadlines
  - Personal dashboard with activity overview
  - Profile management

### Task Features
- **Status Tracking** - Pending, In Progress, Completed
- **Priority Levels** - Low, Medium, High with color coding
- **Due Date Management** - Optional deadlines with overdue indicators
- **Rich Descriptions** - Detailed task information
- **Assignment System** - Admins can assign tasks to users

## Technology Stack

- **Backend**: Laravel 11.x
- **Frontend**: AdminLTE 3.x, Bootstrap 5
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **Icons**: Font Awesome
- **Styling**: Custom CSS with AdminLTE theme

## Installation

### Requirements
- PHP 8.1 or higher
- Composer
- Node.js & NPM
- MySQL database

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/laravel-task-manager.git
   cd laravel-task-manager
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   - Create a database named `task_manager`
   - Update `.env` with your database credentials:
   ```env
   DB_DATABASE=task_manager
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations and seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

## Default Login Credentials

After running the seeders, use these credentials:

**Admin Account:**
- Email: `admin@example.com`
- Password: `password`

**Regular User Account:**
- Email: `user@example.com`
- Password: `password`



## Key Features Implementation

### Role-Based Middleware
- Custom middleware for role verification
- Protected routes based on user roles
- Dynamic dashboard redirects

### Form Validation
- Server-side validation with Laravel Form Requests
- Client-side feedback with Bootstrap styling
- Custom validation messages

### Database Relationships
- User-Task one-to-many relationship
- Proper foreign key constraints
- Efficient query optimization

### User Interface
- Responsive AdminLTE design
- Intuitive navigation structure
- Professional admin dashboard
- Color-coded priority and status indicators





## About Laravel

Laravel is a web application framework with expressive, elegant syntax. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing)
- [Powerful dependency injection container](https://laravel.com/docs/container)
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent)
- Database agnostic [schema migrations](https://laravel.com/docs/migrations)
- [Robust background job processing](https://laravel.com/docs/queues)
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting)

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks. You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

**Built with Laravel for demonstration of modern web development practices.**
