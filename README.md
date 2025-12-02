# Tasky - Task Manager Application

A modern task management application built with Laravel and Livewire, featuring a Kanban board interface for organizing tasks across multiple lists. This application fulfills all requirements for a comprehensive task management system.

## Project Requirements Compliance

This application meets all specified requirements:

### Core Functionality ✅
- ✅ **Task Manager**: Registered users can create and manage lists and tasks
- ✅ **Multiple Lists**: Users can have multiple lists, each with multiple tasks
- ✅ **Task Ownership**: Each task belongs to a single list
- ✅ **User Isolation**: Users can only view and edit their own lists and tasks
- ✅ **List Customization**: Users can change list appearance (color) and reorder tasks
- ✅ **Task Features**: Tasks support due dates and priority levels (low, medium, high)

### Technical Requirements ✅
- ✅ **Laravel Framework**: Built with Laravel 12
- ✅ **Livewire Framework**: Uses Livewire 3 for dynamic interfaces
- ✅ **User Authentication**: Complete registration and login system
- ✅ **CRUD Operations**: Full Create, Read, Update, Delete functionality with authentication
- ✅ **Data Validation**: All user inputs are validated with error messages
- ✅ **Professional Design**: Clean, modern UI with responsive layout
- ✅ **Branding**: Custom logo and brand colors (purple theme)

### Features

- **Task Management**: Create, edit, and delete tasks with priorities and due dates
- **Kanban Board**: Organize tasks in three columns: Todo, In Work, and Done
- **Drag & Drop**: Reorder tasks within columns and reorder lists
- **Multiple Lists**: Create and manage multiple task lists with custom colors
- **User Authentication**: Secure user registration and login
- **Task Search**: Search functionality to quickly find tasks
- **Calendar View**: View tasks in a calendar format
- **Profile Management**: User profile with avatar support
- **Responsive Design**: Works seamlessly on desktop, tablet, and mobile devices

## Technologies Used

- **Laravel 12**: PHP framework
- **Livewire 3**: Full-stack framework for dynamic interfaces
- **SQLite**: Database
- **Tailwind CSS**: Styling
- **Laravel Breeze**: Authentication scaffolding

## Installation

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```
3. Set up environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Run migrations:
   ```bash
   php artisan migrate
   ```
5. Build assets:
   ```bash
   npm run build
   ```
6. Start the server:
   ```bash
   php artisan serve
   ```

## Database Design

The application uses the following database structure:

- **users**: User accounts with authentication
- **lists**: Task lists belonging to users (with color and order_position)
- **tasks**: Tasks belonging to lists (with status, priority, due_date, order_position)

All relationships are properly defined with foreign keys and user ownership is enforced at the database query level.

## Validation & Error Handling

All forms include comprehensive validation:
- Required field validation
- Data type validation (dates, strings, enums)
- Existence validation (list IDs, user ownership)
- Custom error messages displayed inline with form fields
- Session flash messages for success/error notifications

## Security Features

- Authentication required for all CRUD operations
- User ownership verification on all queries
- CSRF protection on all forms
- SQL injection prevention through Eloquent ORM
- XSS protection through Blade templating

## AI Usage

This project utilized AI assistance for development and debugging:

- **Code Generation**: AI was used to generate initial component structures and boilerplate code
- **Bug Fixing**: AI assistance helped identify and resolve errors, such as undefined array key issues
- **Code Refactoring**: AI tools were used to improve code structure and fix logical errors
- **Database Management**: AI helped with database queries and data cleanup operations
- **Requirement Compliance**: AI assisted in ensuring all project requirements were met

**AI Tools Used**: 
- ChatGPT
- GitHub Copilot


## License

This project is open-sourced software.

