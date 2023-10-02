# Weaver v1.0.0 - PHP Framework

Welcome to Weaver, a PHP mini-MVC (Model-View-Controller) Framework designed to simplify web application development. This framework provides a structured approach to building web applications while maintaining flexibility and efficiency.



## Getting Started

1. Clone or download this repository.
2. Configure 'Configurations/.env' file. Before you start using the framework, make sure to create an `.env` file in the 'Configurations' directory with the following content:
```env
# Project's Environment Variables

## Environment
ENVIRONMENT=development

## MySQL Configuration
MYSQL_HOST=[<HOST>]
MYSQL_USERNAME=[<USERNAME>]
MYSQL_PASSWORD=[<PASSWORD>]
MYSQL_DATABASE=[<DATABASE_NAME>]

## Mailer Configuration
SENDER_EMAIL=[<USERNAME>]
SENDER_PASSWORD=[<PASSWORD>]

## Project Information
PROJECT_NAME=[<PROJECT_NAME>]
```
3. Start building your controllers, models, and views to create your web application.



## Quick Start Guide

Welcome to Weaver Framework! This guide will help you get started quickly with your project. Follow these steps to set up and explore the framework:

### Getting Started

1. **Configuration**: Configure the `.env` file located in the `Configurations` directory with your project-specific settings.

2. **Routes**: Open the `Configurations/Routes.php` file to view the existing routes defined for your project. Routes are defined as `'route' => 'Controller@method'`. For example, `'/' => 'Portal@Index'` corresponds to the root route, which maps to the `Portal` controller's `Index` method.

3. **Controllers**: Based on the routes you find in `Routes.php`, navigate to the appropriate controller located in the `Routes` directory. For example, if you see a route `'/' => 'Portal@Index'`, you can find the corresponding controller logic in `Routes/Portal.php`.

4. **Views**: Within the controller methods, you will often see the loading of views using commands like `$this->view('Welcome', array())`. To find the view file associated with this action, look in the `Views` directory for a file named `[VIEW_NAME].php`. For example, you would find the `Welcome.php` view file for the above command.

### Explore Examples

In the views (`Views/Welcome.php`), you'll find examples that demonstrate various aspects of the framework. These examples cover a wide range of functionality, allowing you to explore the capabilities of Weaver Framework.

### Contribute and Improve

If you grasp the basics and have ideas for improvements or spot opportunities for enhancement, we encourage you to contribute to the project. Your feedback and contributions are highly appreciated.

Thank you for choosing Weaver Framework, and we hope you have a great development experience!



## License

This framework is open-source and released under the [MIT License](LICENSE).
