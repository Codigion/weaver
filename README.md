# Weaver v1.0.1 - MVC Framework

Welcome to Weaver, a PHP MVC (Model-View-Controller) Framework designed to simplify web application development. This framework provides a structured approach to building web applications while maintaining flexibility and efficiency.


## Getting Started

1. Clone or download this repository.
2. Configure 'Configurations/.env' file.
3. Start building your controllers, models, and views to create your web application.


### Environment Variables

Before you start using the framework, make sure to create an `.env` file in the 'Configurations' directory with the following content:

```env
# Project's Environment Variables

## Environment
ENVIRONMENT=development

## Project Base URL
BASE_URL=[<Project Base URL>]

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


## License

This framework is open-source and released under the [MIT License](LICENSE).