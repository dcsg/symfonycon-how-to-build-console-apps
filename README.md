# How to build Console applications

Source code of my talk at [SymfonyCon 2013](warsaw2013.symfony.com) about **How to build Console applications**

## Installation

```

git clone git@github.com:danielcsgomes/symfonycon-how-to-build-console-apps.git

cd symfonycon-how-to-build-console-apps

# Install using composer with development dependencies:
curl -sS https://getcomposer.org/installer | php

# Then, using the `composer.phar` file:
php composer.phar install --dev

```

## Usage

```

# Run the application
./bin/app

# Run the application with dependency injection in DumpDatabase Command
./bin/app-di

# Run tests:
./vendor/bin/phpunit

```

## License
The code is licensed under the [MIT License](https://github.com/danielcsgomes/symfonycon-how-to-build-console-apps/blob/master/LICENSE)
