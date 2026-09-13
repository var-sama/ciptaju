# Ciptaju

Web-In is a class discussion website designed to facilitate communication and knowledge sharing among students. Through this platform, users can ask questions, share ideas, and engage in discussions related to school subjects or other relevant topics.

This website helps students interact without needing face-to-face meetings, making discussions more flexible, efficient, and accessible anytime and anywhere.

---

## Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/var-sama/ciptaju.git
    ```

2. Navigate into the project folder:
    ```bash
    cd ciptaju
    ```

3. Install Dependencies (for Tailwind CSS):
    ```bash
    npm install
    ```

4. Set up the database:
   - Open your database tool (phpMyAdmin, MySQL Workbench, or command line).
   - Create a new database "ta_pwl_k6".
   - Import the provided SQL file into the database:
    ```bash
    mysql -u root -p ta_pwl_k6 < ta_pwl_k6.sql
    ```
   (Alternatively, use phpMyAdmin → Import → Choose the SQL file).

---

## Usage

To run this project properly, you need to run both the PHP server and the Tailwind CSS compiler simultaneously.

1. Run a local PHP server using PHP built-in server:
   ```bash
    php -S localhost:5000 -t public
   ```
2. **Run Tailwind CSS (in a new tab)**:
Open a new terminal tab/window, make sure you are in the project folder (cd STS_kelompok_6), and run:
   ``` bash
    npm run dev
   ```
3. **Access the website:**
   - Open your browser and go to http://localhost:5000
   - Click the Register button on the sidebar to create a new account.
   - Complete the registration form and Login to access your dashboard or profile page.

5. **Role-Based Access:**
After login, users will be automatically redirected to their respective dashboard or landing page depending on their role (Admin or Regular User).

### Default Accounts (Testing)
For testing and demonstration purposes, all user accounts in the seeded database use the exact same password.
- Admin Account:
  - Username: madakono
  - Password: 111
- Regular Users: (Any existing user)
  - Password: 111

### Available Routes / Pages
Based on the application's routing system, here are the accessible user-facing URL paths:
   ```bash
    /                 # Landing page (Main feed)
    /login            # Login page
    /register         # Register page
    /Problemcreate    # Create a new problem/post page
    /problem-detail   # Problem discussion detail page
    /bookmark         # User's bookmarked problems page
    /teams            # List of joined teams
    /teams-create     # Form to create a new team
    /teams-detail     # Specific team detail view
    /tags             # List of available tags
    /tag-result       # Search results filtered by tag
    /profile          # User profile page
    /dashboard        # Admin analytics & management dashboard
   ```
> (Note: System actions like /add-comment, /logout, /toggle-like, and /admin/... are handled via POST/GET requests behind the scenes).

---

## Architecture

```Project structure
STS_kelompok_6/
├── package.json                        # NPM dependencies & scripts (Tailwind)
├── README.md                           # Project documentation
├── ta_pwl_k6.sql                       # Database file
├── app/
│   ├── config/
│   │   └── app.php                     # App configurations
│   ├── controllers/                    # Application Logic (MVC Controllers)
│   │   ├── AdminController.php         # Handle admin dashboard & features
│   │   ├── AuthController.php          # Handle authentication (login/register/logout)
│   │   ├── landingController.php       # Handle main feed & user actions (likes, bookmarks)
│   │   ├── ProblemController.php       # Handle problem feature, creation & detailed views
│   │   ├── profileController.php       # Handle user profile & image uploads
│   │   └── TeamController.php          # Handle team creation & team details
│   ├── core/
│   │   ├── database.php                # Database connection setup
│   │   └── Router.php                  # Simple routing system
│   ├── models/                         # Database Interactions (MVC Models)
│   │   ├── admin.php                   # Admin-related queries
│   │   ├── problem.php                 # Post/Problem-related queries
│   │   └── Team.php                    # Team-related queries
│   ├── resources/
│   │   └── css/
│   │       └── input.css               # Tailwind source CSS file
│   └── views/                          # User Interface (MVC Views)
│       ├── bookmark.php                # Bookmarked posts view
│       ├── create team.php             # Form to create a new team
│       ├── dashboard.php               # Admin dashboard layout
│       ├── detail.php                  # Detailed discussion view
│       ├── landing.php                 # Main timeline/feed view
│       ├── Problemcreate.php           # Form to post a new problem
│       ├── profile.php                 # User profile view
│       ├── tag_result.php              # Search results by tag view
│       ├── Tags.php                    # List of available tags view
│       ├── teams detail.php            # Inside a specific team view
│       ├── teams.php                   # List of joined teams view
│       ├── auth/
│       │   ├── login.php               # Login page UI
│       │   └── register.php            # Register page UI
│       └── components/
│           └── navbar.php              # Reusable navigation bar
└── public/                             # Publicly accessible files (Document Root)
    ├── index.php                       # Entry point (Main routing file)
    ├── css/                            # Compiled & custom CSS files
    │   ├── Login.css
    │   ├── Navbar.css
    │   ├── output.css                  # Compiled Tailwind CSS output
    │   ├── Problem.css
    │   ├── profile.css
    │   ├── Register.css
    │   └── tag.css
    ├── icons/                          # Static icon assets
    ├── js/                             # JavaScript files for interactivity
    │   ├── createteams.js
    │   ├── detail.js
    │   ├── detailtim.js
    │   ├── landing.js
    │   └── tim.js
    └── uploads/                        # Directory for user uploaded images (Profiles, Teams)
```

---

## Contributing

We welcome contributions from anyone who wants to help improve Web-In school problem discusion Website!
Whether you are fixing bugs, adding new features, enhancing the design, or improving documentation, your contributions are highly appreciated.

### How to Contribute

1. Fork this repository.
2. Create a new branch for your feature or bugfix.
3. Commit your changes with a clear and descriptive message.
4. Push your branch and open a Pull Request.
5. Wait for review and feedback before merging.

### Contribution Guidelines
- Keep your code clean, structured, and well-documented.
- Ensure that any new features or fixes are properly tested.
- Maintain consistency with the existing project structure.
- Be respectful, collaborative, and constructive in discussions.

> Together, we can make Web-In a more accessible and user-friendly platform for school discusion! 

---

## License
This project is licensed under the MIT License.
You are free to use, modify, and redistribute it as long as proper credit is given.

---

## Team Members
1. Gervasio Velasques
2. Edwin Jonathan
3. Michael Leo Nardo
4. Willyansen Alexander Jonathan
