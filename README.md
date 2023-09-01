<div align="center">
  <h2><b>🕹️🕹️ Resplify API 🕹️🕹️</b></h2>
  <br/>
</div>

<a name="readme-top"></a>

<!-- TABLE OF CONTENTS -->

# 📗 Table of Contents

- [📖 About the Project](#about-project)
  - [🛠 Built With](#built-with)
    - [Tech Stack](#tech-stack)
    - [Key Features](#key-features)
  - [🚀 Link to Api Docs](#api-docs)
  - [🚀 Link to React Frontend](#front-end)
  - [🚀 Kaban Board](#Kaban-Board)
    - [Kaban Board Initial State](#initial-state)
  - [ERD Diagram](#erd)
- [💻 Getting Started](#getting-started)
  - [Setup](#setup)
  - [Prerequisites](#prerequisites)
  - [Usage](#usage)
- [🔭 Future Features](#future-features)
- [🤝 Contributing](#contributing)
- [⭐️ Show your support](#support)
- [📝 License](#license)

<!-- PROJECT DESCRIPTION -->

# 📖 Resplify API <a name="about-project"></a>

**[Resplify API]** is the backend application designed for resplify, a web application for jobseekers who need to update their portfolio and set up their online presence and everything they need to be job ready. You come to the platform to update your resume, LinkedIn profile and generate a cover letter for every job application.


### Tech Stack <a name="tech-stack"></a>

- <a href="https://www.php.net/">PHP</a>
- <a href="https://laravel.com/">Laravel</a>
- <a href="https://www.mysql.com/">MySQL</a>

<!-- Features -->

### Key Features <a name="key-features"></a>

- **[User Registration and Authentication]**
- **[resume generator and review]**

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- Link to Api Documentation -->

## 🚀 Link to Api Documentation <a name="api-docs"></a>

To access the documentation, run the server using `php artisan serve` and goto the above link

- [Link to api documentation](https://localhost:8000/docs/)

<br/>


<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- Link to frontend -->

## 🚀 Link to Front-end <a name="front-end"></a>

- [Link to Front-end](https://github.com/mrprotocoll/resplify)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- GETTING STARTED -->

## 💻 Getting Started <a name="getting-started"></a>

To get a local copy up and running, follow these steps.

### Prerequisites

In order to run this project you need:

1. git <br>
use the following link to setup `git` if you dont have it already installed on your computer
<p align="left">(<a href="https://git-scm.com/book/en/v2/Getting-Started-Installing-Git">install git</a>)</p>

2. PHP ^8.1 <br>
use the following link to setup `PHP` if you dont have it already installed on your computer
<p align="left">(<a href="https://www.php.net/manual/en/install.php">install PHP</a>)</p>

3. Composer <br>
use the following link to Download `Composer` if you dont have it already installed on your computer
<p align="left">(<a href="https://getcomposer.org/download/">install Composer</a>)</p>

4. MySQL <br>
use the following link to setup `MySQL` if you dont have it already installed on your computer
<p align="left">(<a href="https://dev.mysql.com/doc/mysql-getting-started/en/">install MySQL</a>)</p>

## Install

Clone repo:

```
git clone https://github.com/mrprotocoll/resplify.git
```

Install dependencies:

```
composer install
```

## Setup

create a .env file change using the .env.example file and update the Database and Email credentials. Then setup some configuration with your own credentials

Run the migration:

```
php artisan migrate
```

Or run the migration with seeder if you want seeding the related data:

```
php artisan migrate --seed
```

Generate a New Application Key:

```
php artisan key:generate
```

Create a symbolic link:

```
php artisan storage:link
```

### Usage

The following command can be used to run the application.

```sh
  php artisan serve
```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## 🔭 Future Features <a name="future-features"></a>

- [ ] **[Automate Job Search]**
- [ ] **[Track jobs]**

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- CONTRIBUTING -->

## 🤝 Contributing <a name="contributing"></a>

Contributions, issues, and feature requests are welcome!

Feel free to check the [issues page](../../issues/).

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- SUPPORT -->

## ⭐️ Show your support <a name="support"></a>

If you like this project, please don't forget to follow the contributors and give it a star.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- LICENSE -->

## 📝 License <a name="license"></a>

This project is [MIT](./LICENSE) licensed.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

