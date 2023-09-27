# Weaver MVC Framework Documentation

Welcome to the documentation for the Weaver MVC Framework. This guide will help you understand the architecture, components, and usage of the framework.

## Table of Contents

- [Weaver MVC Framework Documentation](#weaver-mvc-framework-documentation)
  - [Table of Contents](#table-of-contents)
  - [Introduction](#introduction)
  - [Installation](#installation)
  - [Directory Structure](#directory-structure)
  - [Configuration](#configuration)
  - [Routing](#routing)
  - [Controllers](#controllers)
  - [Models](#models)
  - [Views](#views)
  - [Assets](#assets)
  - [Libraries](#libraries)
  - [Helpers](#helpers)
  - [Core](#core)
  - [Environment Variables](#environment-variables)
  - [Error Handling](#error-handling)
  - [Extensions and Customization](#extensions-and-customization)
  - [Contributing](#contributing)
  - [License](#license)

## Introduction

Weaver is a PHP-based MVC (Model-View-Controller) Framework designed to simplify web application development. It provides a structured approach to building web applications while maintaining flexibility and efficiency.

## Installation

To get started with Weaver, follow these steps:

1. Clone or download this repository.
2. Configure the `.env` file in the `Configurations` directory with your project's environment variables.
3. Build your controllers, models, and views to create your web application.

## Directory Structure

Weaver follows a well-defined directory structure to organize your project:

```
/
├── Configurations/
│ ├── Routes.php
│ └── .env
├── Controllers/
│ ├── MyController.php
│ └── ...
├── Models/
│ ├── MyModel.php
│ └── ...
├── Views/
│ │  Error/
│    └── ...
│ │ └── Lab/
│    └── ...
│ │ └── Layout/
│    └── ...
│ └── Welcome.php
├── Assets/
│ ├── CSS/
│ │ ├── Master.css
│ ├── JS/
│ │ ├── Master.js
│ └── Uploads/
├── Libraries/
│ └── Mail.py
├── Routes/
│ └── Lab.php
│ └── Portal.php
├── Helpers/
│ ├── TimeDate.php
│ ├── FileOperation.php
│ ├── Generic.php
│ ├── Metadata.php
│ └── Validation.php
├── Core/
│ ├── Controller.php
│ ├── Cookie.php
│ ├── File.php
│ ├── Exception_.php
│ ├── Request.php
│ ├── Response.php
│ ├── Mailer.php
│ ├── MySQL.php
│ ├── Router.php
│ ├── Session.php
│ └── System.php
├── .gitignore
├── .htaccess
├── CODE_OF_CONDUCt.md
├── CONTRIBUTING.md
├── index.php
├── LICENSE
└── README.md
```

## Configuration

The `.env` file in the `Configurations` directory stores environment-specific configuration settings. You can define variables for your database, mailer, and other project-specific details here.

## Routing

Routing is defined in the `Routes.php` file in the `Configurations` directory. It maps URLs to controller actions `Routes/<Controller>.php`, allowing you to define how requests should be handled.

## Controllers

Controllers are responsible for handling incoming requests and responding with the appropriate views or data. You can create controllers in the `Controllers` directory and define actions to handle specific routes.

## Models

Models represent your application's data and business logic. They interact with the database and provide data to the controllers. Create models in the `Models` directory.

## Views

Views are responsible for rendering the HTML content that's sent to the user's browser. Views are stored in the `Views` directory and can use data provided by controllers.

## Assets

The `Assets` directory contains CSS, JavaScript, and other static files that are used in your application.

## Libraries

In the "Libraries" directory, you'll find essential libraries and scripts that complement the Weaver framework. Here's an overview of the available library:

`Mail.py`:
- **Description**: Mail.py is a Python script that serves as a part of the Weaver framework's functionality. It facilitates email handling and delivery for various features within the framework.
- **Prerequisite**: Python 3 is required for Mail.py to work effectively.

You can explore the Libraries directory to understand how these components are integrated into the Weaver framework and how they enhance its capabilities.

## Helpers

The "Helpers" directory contains a set of PHP helper classes that provide various utility functions to streamline common tasks in your Weaver framework application.

## Core

The "Core" directory contains essential system files and classes used by the Weaver Framework. These files include:

- `Exception_.php`: Provides error handling for anomalies in the application.
- `Controller.php`: The base controller class for creating controllers.
- `Cookie.php`: A class for handling cookies.
- `File.php`: Provides file-related functions.
- `Mailer.php`: Handles email sending functionality.
- `MySQL.php`: Manages database connections and queries.
- `Request.php`: Handles incoming HTTP requests.
- `Response.php`: Manages and sends HTTP responses.
- `Router.php`: The router class for defining and handling routes.
- `Session.php`: Manages user sessions.
- `System.php`: Provides core system functionality.

You can find these files in the "Core" directory within your project structure.

## Environment Variables

The `.env` file contains essential environment variables, including database connection details, mailer configuration, and project information.

## Error Handling

Weaver provides error handling mechanisms to handle exceptions and errors gracefully. You can customize error pages and responses.

## Extensions and Customization

You can extend Weaver by creating custom controllers, models, and views, or by adding additional functionality through libraries and extensions.

## Contributing

We welcome contributions from the community. If you'd like to contribute to Weaver, please follow our [contribution guidelines](CONTRIBUTING.md).

## License

Weaver is open-source and released under the [MIT License](LICENSE).

Happy coding with Weaver!


[def]: #license