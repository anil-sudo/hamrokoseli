# Hamrokoseli

A Laravel web application built with modern tools and technologies.

## Table of Contents
- [Quick Setup (Automated)](#quick-setup-automated)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Setup](#setup)
- [Running the Application](#running-the-application)

---

## Quick Setup (Automated)

For Windows users, we've created an automated PowerShell script that handles the entire setup process:

### Option 1: Automated Setup (Recommended)

1. **Download and run the setup script:**
   ```powershell
   # Download the setup script
   Invoke-WebRequest -Uri "https://raw.githubusercontent.com/anil-sudo/hamrokoseli/main/setup.ps1" -OutFile "setup.ps1"

   # Run the setup script (as Administrator)
   .\setup.ps1
   ```

   **Note:** The setup script is also available in the repository as `setup.ps1` if you prefer to download it manually.

   The script will automatically:
   - Create a `Development` folder in your user directory
   - Install PHP using the official installer
   - Install Composer
   - Check and install Node.js (if not present)
   - Check and install Git (if not present)
   - Clone the repository
   - Install all dependencies
   - Configure the environment
   - Build frontend assets
   - Run tests
   - Optionally start the development server

### Troubleshooting Automated Setup

- **Script won't run?** Make sure you're running PowerShell as Administrator
- **Winget not available?** The script will fall back to manual installation prompts
- **Internet issues?** Ensure you have a stable internet connection for downloads
- **Permission errors?** Run PowerShell as Administrator

### Option 2: Manual Setup

If you prefer to set up manually or the automated script fails, follow the steps below.

---

## Prerequisites

### Step 1: Install PHP

Choose the installation method based on your operating system:

#### **Windows**
Run the following command in PowerShell (as Administrator):

```bash
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows'))
```


### Additional Requirements
- **Node.js** and **npm** - [Download here](https://nodejs.org/)
- **Composer** - [Download here](https://getcomposer.org/)
- **Git** - [Download here](https://git-scm.com/)

Verify your installations:
```bash
php --version
npm --version
composer --version
git --version
```

---

## Installation

### Step 2: Clone the Repository

```bash
git clone https://github.com/anil-sudo/hamrokoseli.git
```

Navigate to the project directory:

```bash
cd hamrokoseli
```

---

## Setup

### Step 3: Install Dependencies

Install both Node.js and PHP dependencies, then configure the environment:

```bash
npm install
```

```bash
composer install
```

Copy the environment configuration file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Build the frontend assets:

```bash
npm run build
```

Run database migrations:

```bash
php artisan migrate
```
By default `sqlite` will be in used. However in production `mySql` or `PostgreSQL` will be used. Make sure to run migrations &  seeders.
---

## Running the Application

**Note:** If you used the automated setup script, all dependencies are already installed and configured. You can skip directly to starting the development server below.

### Step 4: Start the Development Server

Start the Laravel development server:

```bash
composer run dev
```

The application will be available at `http://localhost:8000` (or the port specified in your configuration).

### Alternative: Using npm for development

If you prefer to run the development server with npm:

```bash
npm run dev
```

---

## Project Structure

- **app/** - Application logic (Controllers, Models, Actions)
- **resources/** - Frontend assets (CSS, JavaScript, Blade templates)
- **routes/** - Application routes
- **database/** - Migrations and seeders
- **tests/** - Test files
- **config/** - Configuration files
- **storage/** - Application storage (logs, cache, uploads)

---

## Troubleshooting

- **Port already in use?** - Change the port in your `.env` file or use: `php artisan serve --port=3000`
- **Permission errors?** - Ensure `storage/` and `bootstrap/cache/` directories are writable
- **Node/Composer not found?** - Make sure they're properly installed and added to your PATH

---

## Contributing

For contributing guidelines, please refer to the project's contribution policy.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for detailed licensing information.