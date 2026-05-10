# Hamrokoseli Setup Script
# Automates the complete setup of the Hamrokoseli Laravel application on Windows.
# Run this script in PowerShell as Administrator.

# ---------------------------------------------------------------------------------
# Helpers
# ---------------------------------------------------------------------------------

function Write-Step {
    param([string]$message)
    Write-Host ""
    Write-Host "  $message" -ForegroundColor Cyan
    Write-Host "  $('-' * ($message.Length))" -ForegroundColor DarkGray
}

function Write-OK {
    param([string]$message)
    Write-Host "  [OK] $message" -ForegroundColor Green
}

function Write-Info {
    param([string]$message)
    Write-Host "  [..] $message" -ForegroundColor Gray
}

function Write-Warn {
    param([string]$message)
    Write-Host "  [!!] $message" -ForegroundColor Yellow
}

function Write-Fail {
    param([string]$message)
    Write-Host "  [XX] $message" -ForegroundColor Red
}

function Test-CommandExists {
    param([string]$command)
    return [bool](Get-Command $command -ErrorAction SilentlyContinue)
}

function Refresh-Path {
    # Reloads PATH from the registry so newly installed tools are available
    # in the current session without requiring a restart.
    $machinePath = [System.Environment]::GetEnvironmentVariable("Path", "Machine")
    $userPath    = [System.Environment]::GetEnvironmentVariable("Path", "User")
    $env:Path    = "$machinePath;$userPath"
}

function Install-WithWinget {
    param(
        [string]$packageId,
        [string]$packageName
    )
    Write-Info "Installing $packageName via winget..."
    winget install --id $packageId --accept-source-agreements --accept-package-agreements --silent 2>&1 | Out-Null
    if ($LASTEXITCODE -ne 0) {
        Write-Fail "winget could not install $packageName (exit code $LASTEXITCODE)."
        Write-Fail "Please install $packageName manually and re-run this script."
        exit 1
    }
    Write-OK "$packageName installed."
}

# ---------------------------------------------------------------------------------
# Banner
# ---------------------------------------------------------------------------------

Write-Host ""
Write-Host "  Hamrokoseli Setup" -ForegroundColor White
Write-Host "  $('=' * 50)" -ForegroundColor DarkGray
Write-Host "  This script will install dependencies, clone the" -ForegroundColor Gray
Write-Host "  repository, and configure the application for you." -ForegroundColor Gray
Write-Host ""

# ---------------------------------------------------------------------------------
# Step 1: Development folder
# ---------------------------------------------------------------------------------

Write-Step "Step 1: Preparing development folder"

$devPath = "$HOME\Development"
if (-not (Test-Path $devPath)) {
    New-Item -ItemType Directory -Path $devPath -Force | Out-Null
    Write-OK "Created folder: $devPath"
} else {
    Write-Info "Folder already exists: $devPath"
}

# ---------------------------------------------------------------------------------
# Step 2: PHP and Composer via php.new
#
# The php.new installer sets up both PHP and Composer together. After it finishes
# we refresh PATH and verify both tools are reachable. If Composer is still missing
# we fall back to the standalone Composer installer.
# ---------------------------------------------------------------------------------

Write-Step "Step 2: Installing PHP and Composer"

Write-Info "Running the php.new installer. This installs PHP and Composer together."
Write-Info "You may be prompted to accept a UAC elevation request."

try {
    Set-ExecutionPolicy Bypass -Scope Process -Force
    [System.Net.ServicePointManager]::SecurityProtocol = `
        [System.Net.ServicePointManager]::SecurityProtocol -bor 3072
    Invoke-Expression ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows'))
} catch {
    Write-Fail "The php.new installer failed: $_"
    Write-Fail "Check your internet connection and try again, or install PHP manually."
    exit 1
}

Refresh-Path

if (Test-CommandExists php) {
    $phpVersion = php --version | Select-Object -First 1
    Write-OK "PHP is available: $phpVersion"
} else {
    Write-Fail "PHP was not found on PATH after installation."
    Write-Fail "Restart your terminal and re-run, or install PHP manually from https://windows.php.net/"
    exit 1
}

if (Test-CommandExists composer) {
    $composerVersion = composer --version
    Write-OK "Composer is available: $composerVersion"
} else {
    Write-Warn "Composer was not found after the php.new installer. Installing standalone Composer..."
    try {
        $composerInstaller = "$env:TEMP\Composer-Setup.exe"
        Invoke-WebRequest -Uri "https://getcomposer.org/Composer-Setup.exe" -OutFile $composerInstaller
        Start-Process -FilePath $composerInstaller -ArgumentList "/SILENT /NORESTART" -Wait
        Remove-Item $composerInstaller -Force
        Refresh-Path
    } catch {
        Write-Fail "Standalone Composer installation failed: $_"
        Write-Fail "Please install Composer manually from https://getcomposer.org/ and re-run."
        exit 1
    }

    if (Test-CommandExists composer) {
        $composerVersion = composer --version
        Write-OK "Composer is available: $composerVersion"
    } else {
        Write-Fail "Composer is still not reachable on PATH."
        Write-Fail "Close this terminal, open a new one as Administrator, and re-run the script."
        exit 1
    }
}

# ---------------------------------------------------------------------------------
# Step 3: Node.js (optional, needed for frontend asset builds)
# ---------------------------------------------------------------------------------

Write-Step "Step 3: Checking Node.js"

if (Test-CommandExists node) {
    $nodeVersion = node --version
    Write-Info "Node.js is already installed ($nodeVersion). Skipping."
} else {
    Write-Info "Node.js was not found."
    $installNode = Read-Host "  Node.js is needed to build frontend assets. Install it now? (y/n)"
    if ($installNode -eq 'y' -or $installNode -eq 'Y') {
        Install-WithWinget "OpenJS.NodeJS.LTS" "Node.js LTS"
        Refresh-Path
        if (Test-CommandExists node) {
            Write-OK "Node.js is now available: $(node --version)"
        } else {
            Write-Warn "Node.js was installed but is not yet on PATH."
            Write-Warn "You may need to restart your terminal before running npm commands."
        }
    } else {
        Write-Warn "Skipping Node.js. You will not be able to run 'npm install' or 'npm run build'."
        Write-Warn "Install Node.js later from https://nodejs.org/ and run those commands manually."
    }
}

# ---------------------------------------------------------------------------------
# Step 4: Git (optional, needed to clone the repository automatically)
# ---------------------------------------------------------------------------------

Write-Step "Step 4: Checking Git"

if (Test-CommandExists git) {
    $gitVersion = git --version
    Write-Info "Git is already installed ($gitVersion). Skipping."
} else {
    Write-Info "Git was not found."
    $installGit = Read-Host "  Git is needed to clone the repository. Install it now? (y/n)"
    if ($installGit -eq 'y' -or $installGit -eq 'Y') {
        Install-WithWinget "Git.Git" "Git"
        Refresh-Path
        if (Test-CommandExists git) {
            Write-OK "Git is now available: $(git --version)"
        } else {
            Write-Warn "Git was installed but is not yet on PATH. Restart your terminal if cloning fails."
        }
    } else {
        Write-Warn "Skipping Git. You will need to clone the repository manually."
        Write-Warn "Download Git later from https://git-scm.com/"
    }
}

# ---------------------------------------------------------------------------------
# Step 5: Clone the repository
# ---------------------------------------------------------------------------------

Write-Step "Step 5: Cloning the repository"

$repoPath = "$devPath\hamrokoseli"

if (-not (Test-CommandExists git)) {
    Write-Warn "Git is not available, so the repository cannot be cloned automatically."
    Write-Warn "Please clone or copy the project to: $repoPath"
    Write-Warn "Then re-run this script, or continue the remaining steps manually."
    exit 0
}

if (Test-Path $repoPath) {
    Write-Warn "A folder already exists at $repoPath"
    $overwrite = Read-Host "  Remove it and clone fresh? (y/n)"
    if ($overwrite -eq 'y' -or $overwrite -eq 'Y') {
        Remove-Item $repoPath -Recurse -Force
        Write-Info "Removed existing folder."
    } else {
        Write-Info "Keeping existing folder. Proceeding with what is there."
    }
}

if (-not (Test-Path $repoPath)) {
    Set-Location $devPath
    git clone https://github.com/anil-sudo/hamrokoseli.git
    if ($LASTEXITCODE -ne 0) {
        Write-Fail "git clone failed. Check your internet connection and try again."
        exit 1
    }
    Write-OK "Repository cloned to $repoPath"
}

Set-Location $repoPath

# ---------------------------------------------------------------------------------
# Step 6: Install PHP dependencies
# ---------------------------------------------------------------------------------

Write-Step "Step 6: Installing PHP dependencies"

composer install
if ($LASTEXITCODE -ne 0) {
    Write-Fail "composer install failed."
    Write-Fail "Check the output above, resolve any issues, and re-run 'composer install' in $repoPath"
    exit 1
}
Write-OK "PHP dependencies installed."

# ---------------------------------------------------------------------------------
# Step 7: Install Node.js dependencies (skipped if Node is unavailable)
# ---------------------------------------------------------------------------------

Write-Step "Step 7: Installing Node.js dependencies"

if (Test-CommandExists npm) {
    npm install
    if ($LASTEXITCODE -ne 0) {
        Write-Fail "npm install failed. Check the output above and re-run 'npm install' manually."
        exit 1
    }
    Write-OK "Node.js dependencies installed."
} else {
    Write-Warn "npm is not available. Skipping Node.js dependency installation."
    Write-Warn "Install Node.js and run 'npm install' in $repoPath when ready."
}

# ---------------------------------------------------------------------------------
# Step 8: Environment configuration
# ---------------------------------------------------------------------------------

Write-Step "Step 8: Configuring environment"

if (Test-Path ".env") {
    Write-Info ".env already exists. Leaving it untouched."
} elseif (Test-Path ".env.example") {
    Copy-Item ".env.example" ".env" -Force
    Write-OK "Created .env from .env.example"
} else {
    Write-Warn ".env.example was not found. You will need to create .env manually."
}

Write-Info "Generating application key..."
php artisan key:generate
if ($LASTEXITCODE -ne 0) {
    Write-Fail "php artisan key:generate failed."
    Write-Fail "Ensure .env exists and is writable, then run 'php artisan key:generate' manually."
    exit 1
}
Write-OK "Application key generated."

# ---------------------------------------------------------------------------------
# Step 9: Build frontend assets (skipped if Node is unavailable)
# ---------------------------------------------------------------------------------

Write-Step "Step 9: Building frontend assets"

if (Test-CommandExists npm) {
    npm run build
    if ($LASTEXITCODE -ne 0) {
        Write-Warn "npm run build reported errors. The app may still work; check the output above."
    } else {
        Write-OK "Frontend assets built."
    }
} else {
    Write-Warn "npm is not available. Skipping asset build."
    Write-Warn "Run 'npm run build' in $repoPath after installing Node.js."
}

# ---------------------------------------------------------------------------------
# Step 10: Run database migrations
# ---------------------------------------------------------------------------------

Write-Step "Step 10: Running database migrations"

php artisan migrate --force
if ($LASTEXITCODE -ne 0) {
    Write-Fail "php artisan migrate failed."
    Write-Fail "Check your database settings in .env, then run 'php artisan migrate' manually."
    exit 1
}
Write-OK "Database migrations completed."

# ---------------------------------------------------------------------------------
# Step 11: Seed the database
#
# The default DatabaseSeeder calls all other seeders internally so no additional
# seeder arguments are needed here.
# ---------------------------------------------------------------------------------

Write-Step "Step 11: Seeding the database"

php artisan db:seed --force
if ($LASTEXITCODE -ne 0) {
    Write-Warn "php artisan db:seed reported errors."
    Write-Warn "The application may still work. Run 'php artisan db:seed' manually to retry."
} else {
    Write-OK "Database seeded successfully."
}

# ---------------------------------------------------------------------------------
# Step 12: Run tests (optional)
# ---------------------------------------------------------------------------------

Write-Step "Step 12: Running tests (optional)"

$pestBin = ".\vendor\bin\pest"
if (Test-Path $pestBin) {
    Write-Info "Running Pest test suite..."
    & $pestBin
    if ($LASTEXITCODE -ne 0) {
        Write-Warn "Some tests did not pass. Review the output above before going further."
    } else {
        Write-OK "All tests passed."
    }
} else {
    Write-Warn "Pest was not found at $pestBin. Skipping tests."
    Write-Warn "You can run tests later with: ./vendor/bin/pest"
}

# ---------------------------------------------------------------------------------
# Done
# ---------------------------------------------------------------------------------

Write-Host ""
Write-Host "  $('=' * 50)" -ForegroundColor DarkGray
Write-Host "  Setup complete. You are ready to go." -ForegroundColor White
Write-Host ""
Write-Host "  Start the development server by running:" -ForegroundColor Gray
Write-Host ""
Write-Host "    cd $repoPath" -ForegroundColor White
Write-Host "    composer run dev" -ForegroundColor White
Write-Host ""
Write-Host "  The application will be available at: http://localhost:8000" -ForegroundColor Gray
Write-Host "  $('=' * 50)" -ForegroundColor DarkGray
Write-Host ""