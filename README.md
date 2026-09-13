# Ciptaju

**Ciptaju** is a school registration and information website developed as a school project. The website is designed to provide information about the school and present a frontend interface for student registration.

At this stage of development, Ciptaju focuses on the **frontend interface, page layouts, navigation, and visual presentation**. The database and backend functionality have not been implemented yet, so features such as storing registration data, authentication, and other dynamic processes are not fully functional.

The project is currently being developed as part of a **midterm school assessment**, with the completed work mainly covering the website's interface and navigation.

---

## Current Project Status

> **Development Status: Frontend / UI Prototype**

The current version of Ciptaju includes:

- Website layouts and user interface.
- Navigation between available pages.
- School information pages.
- News and achievement pages.
- Extracurricular information.
- Vision & Mission page.
- Authentication page interfaces.
- Student registration page interface.
- Responsive frontend styling.

The following features are **not implemented yet**:

- Database integration.
- Saving student registration data.
- User authentication logic.
- Login and registration processing.
- Admin dashboard and management system.
- Dynamic data management.
- CRUD functionality.

These features are planned for further development after the current frontend stage.

---

## Installation & Setup

This project is built using **Laravel**, **Laravel Blade**, and **Tailwind CSS** with Vite.

Please make sure the following software is installed on your system:

- PHP
- Composer
- Node.js
- npm

### 1. Clone the repository

```bash
git clone https://github.com/var-sama/ciptaju.git
```

### 2. Navigate into the project folder

```bash
cd ciptaju
```

### 3. Install Laravel / PHP Dependencies

```bash
composer install
```

### 4. Install Node Dependencies

Tailwind CSS and frontend dependencies are managed using npm.

```bash
npm install
```

### 5. Environment Setup

Copy the example environment file:

```bash
cp .env.example .env
```

Generate the Laravel application key:

```bash
php artisan key:generate
```

> **Note:** A database is not required for the current version because the project is still focused on frontend development. Database integration will be added in a future development stage.

---

## Usage

To run the project locally, you need to run the Laravel development server and Vite simultaneously.

### 1. Run the Laravel server

```bash
php artisan serve
```
Or
```bash
composer run dev
```

By default, Laravel will run at:

```text
http://localhost:8000
```

### 2. Run Vite

Open a new terminal tab/window, make sure you are inside the project folder, then run:

```bash
npm run dev
```

Vite is used to compile and serve the frontend assets, including Tailwind CSS.

### 3. Access the website

Open your browser and visit:

```text
http://localhost:8000/students/
```

You can navigate through the available pages and explore the current frontend interface.

---

## Available Pages / Routes

The current application contains the following main routes:

```text
/                       # Redirects to the News page
/students               # Landing page
/achievements           # Achievements page
/achievements/detail    # Achievement detail page
/extracurriculars       # Extracurricular page
/vision-mission         # Vision & Mission page
/news                   # News page
/news/detail            # News detail page
/auth/login             # Login page
/auth/register          # Register page
/auth/view              # Authentication-related view
/auth/registration      # Student registration page
/about                  # About page
/about/view             # About detail view
/about/discover         # About discover page
```

> **Note:** Some routes currently only display the frontend interface. Backend processing and database functionality have not been implemented yet.

---

## Architecture

Ciptaju uses the **Laravel MVC (Model-View-Controller)** architecture.

The project uses **Blade** as the templating engine for its frontend views and **Tailwind CSS** for styling.

```text
ciptaju/
├── app/
│   ├── Http/
│   │   └── Controllers/                         # Application logic and page controllers
│   │       ├── AboutController.php              # Handles About page and related views
│   │       ├── AchievementController.php        # Handles achievement pages and detail views
│   │       ├── AuthController.php               # Handles login, register, and authentication views
│   │       ├── ExtracurricularController.php    # Handles extracurricular page
│   │       ├── NewsController.php               # Handles news pages and detail views
│   │       ├── StudentController.php            # Handles student-related pages
│   │       └── VisionMissionController.php      # Handles Vision & Mission page
│   │
│   ├── Models/                                  # Database models
│   │   └── User.php                             # Laravel user model
│   │
│   ├── Providers/
│   │   └── AppServiceProvider.php               # Application service configuration
│   │
│   └── View/
│       └── Components/                          # Reusable Blade view components
│
├── bootstrap/                                   # Laravel application bootstrap files
│
├── config/                                      # Laravel application configuration
│
├── database/                                    # Database migrations, seeders, and factories
│                                                 # Reserved for future database development
│
├── public/                                      # Publicly accessible files and assets
│
├── resources/                                   # Frontend resources
│   ├── css/                                     # CSS and Tailwind CSS resources
│   ├── js/                                      # JavaScript files for frontend interactions
│   │   └── app.js                               # Main JavaScript entry point
│   │
│   └── views/                                   # Blade templates and website pages
│       ├── about/                               # About page views
│       ├── achievements/                        # Achievement page views
│       ├── auth/                                # Login and registration views
│       ├── extracurriculars/                    # Extracurricular page views
│       ├── layouts/                             # Shared layouts such as navbar and footer
│       ├── news/                                # News page and detail views
│       ├── students/                            # Student-related views
│       └── vision-mission/                      # Vision & Mission page views
│
├── routes/                                      # Application route definitions
│   ├── console.php                              # Laravel console routes
│   └── web.php                                  # Main website routes and navigation
│
├── storage/                                     # Application storage, logs, and cache
│
├── tests/                                       # Automated application tests
│
├── vendor/                                      # PHP dependencies installed by Composer
│
├── .editorconfig                                # Code formatting configuration
├── .env                                         # Environment configuration
├── .gitattributes                               # Git attribute configuration
├── .gitignore                                   # Files and folders ignored by Git
├── .npmrc                                       # NPM configuration
├── AGENTS.md                                    # Project development guidelines
├── artisan                                      # Laravel command-line interface
├── boost.json                                   # Laravel Boost configuration
├── composer.json                                # PHP and Laravel dependency configuration
├── composer.lock                                # Locked PHP dependency versions
├── package.json                                 # Node.js dependencies and scripts
├── package-lock.json                            # Locked Node.js dependency versions
├── phpunit.xml                                  # PHPUnit testing configuration
├── vite.config.js                               # Vite frontend build configuration
└── README.md                                    # Project documentation
```

### Main Components

- **app/Http/Controllers/** — Contains controllers responsible for handling each section of the website and returning the appropriate views.
- **resources/views/** — Contains the Blade templates used to build the website interface.
- **resources/css/** — Contains CSS and Tailwind CSS resources used for styling.
- **resources/js/** — Contains JavaScript used for frontend interactions.
- **routes/web.php** — Contains the main routes used to navigate between pages.
- **public/** — Contains files that can be accessed directly by the browser.
- **database/** — Reserved for future database implementation. The current project does not yet use a database for its main functionality.
- **storage/** — Used by Laravel for application storage, logs, and cache.
- **vendor/** — Contains PHP dependencies installed through Composer.
- **composer.json** — Defines the PHP and Laravel dependencies used by the project.
- **package.json** — Defines frontend dependencies and npm scripts such as `npm run dev`.
- **vite.config.js** — Configures Vite for frontend asset development.

---

## Contributing

This project is currently being developed as a school project. Contributions and suggestions for improving the interface, navigation, code structure, and future functionality are welcome.

### Contribution Guidelines

1. Keep the code clean and structured.
2. Maintain consistency with the existing Laravel project structure.
3. Make sure new pages and components follow the existing design.
4. Test frontend changes before committing them.
5. Use clear and descriptive commit messages.

---

## Future Development

After the frontend stage is completed, the following features are planned for future development:

- Database integration.
- Functional student registration.
- User authentication.
- Login and logout functionality.
- Admin dashboard.
- Student data management.
- CRUD functionality.
- Dynamic news and achievement management.
- Dynamic extracurricular information.
- Form validation and data processing.

---

## License

This project is currently developed for educational purposes as part of a school project.

---

## Team Members

1. Gervasio Velasques
2. Edwin Jonathan
3. Louis Garcia
4. Wilson Christian
