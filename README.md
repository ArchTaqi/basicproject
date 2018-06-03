# Setting up a PHP Project for Git, Composer, PHPUnit, PHP_Codesniffer and PHP Mess Detector

Before getting started make sure that [Git is installed and configured][2] correctly and that an instance of [composer][3] is present.

The first steps are create a new directory, run `git init`, [set up a&nbsp;.gitignore][4] file, and run `composer init`.

When running `composer init` configure it as follows:

* [choose a license][5]: MIT is a good default
* dependency on php
* require dev dependencies: phpunit/phpunit, squizlabs/php_codesniffer, phpmd/phpmd
* add the vendor directory to&nbsp;.gitignore

![PHP Basic Project init](public/PHP-Basic-Project-init.gif)

Composer installs code in to the vendor directory and installs command line scripts in&nbsp;./vendor/bin for ease of use [change that directory to one called bin][6] instead. Once that is done add the bin dir to&nbsp;.gitignore, validate the composer json and install the dependencies.

* composer config "bin-dir" bin
* echo "/bin" &gt;&gt;&nbsp;.gitignore
* composer validate
* composer install

![PHP Basic Project Composer Install](public/PHP-Basic-Project-install.gif)

Now the project has a basic structure and some dependencies. The binaries for PHPUnit, PHP Mess Detector and PHP_Codesniffer could all be installed globally but doing it this way allows for different versions of the tools to be used in different projects.

Next step is to write some code, some unit tests, and to run phpunit. For this step there are two prewritten classes [Car][7] and [CarTest][8]. Once they are downloaded and in place then their namespace needs to be added to the autoloader in composer and the autoload file needs to be generated.

* mkdir src/ and download Car.php
* mkdir test/ and download CarTest.php
* add the namespace "pl/basicproject" to the autoload section of composer.json using [PSR-4][9]
* generate autoload files with `composer dump-autoload`
* phpunit takes care of loading the classes it uses so no need to add it to composer.json
* run phpunit and give it the autoloader with the --boostrap option.

![PHP Basic Project PHPUnit](public/PHP-Basic-Project-PHPUnit.gif)

Having to specify the tests to run and the bootstrap on each run gets old real quick. Instead of doing this each time it's simpler to specify a phpunit.xml configuration file.

This configuration specifies which autload to use, some PHP ini settings, the directory to load tests from using testsuites and the files to use when generating code coverage using the filter option.

![PHP Basic Project PHPUnit and phpunit.xml](public/PHP-Basic-Project-PHPUnit-and-phpunit-xml.gif)

Now on to PHP_Codesniffer. The sniffs can be run similar to PHPUnit specifying the standard to use and the directories to use but it's simpler to create a phpcs.xml and let the tool pick up on that instead. The following configuration file tells the tool to run on the src and test directories using the [PSR-2][10] coding standard and a couple of extra rules.

Another tool that is installed along side PHP_Codesniffer is the [PHP Code Beatufier And Fixer][11] aka phpcbf. This will run off the same config file and automatically fixes violations where possible.

![PHP Basic Project PHP_Codesniffer](public/PHP-Basic-Project-PHP_Codesniffer.gif)

The final tool to configure is PHP Mess Detector.

This is then run specifying the directories and output type: `phpmd test,src text phpmd.xml`:

![PHP Basic Project PHP Mess Detector](public/PHP-Basic-Project-PHP-Mess-Detector.gif)

That’s it. If further customisations of the phpcs.xml and phpmd.xml files are required check out the [PHP Coding Standard Generator](http://edorian.github.io/php-coding-standard-generator/).

```
php composer.phar validate
php composer.phar dump-autoload
// PHPUNIT
php bin/phpunit --version
php bin/phpunit --bootstrap=./vendor/autoload.php test/CarTest.php
php bin/phpunit --coverage-text
// Code_Sniffer
php bin/phpcs 
php bin/phpcbf
php bin/phpcs --report=summary
//PHP Mess Detector
php bin/phpmd test,src text phpmd.xml
php bin/phpmd src/,test text phpmd.xml
```

[2]: https://git-scm.com/book/en/v2/Getting-Started-First-Time-Git-Setup
[3]: https://getcomposer.org/doc/00-intro.md
[4]: https://github.com/github/gitignore
[5]: https://choosealicense.com
[6]: https://getcomposer.org/doc/articles/vendor-binaries.md#can-vendor-binaries-be-installed-
[7]: https://gist.github.com/peterlafferty/515213c806eb5afd87667eb2abf9ee2c
[8]: https://gist.github.com/peterlafferty/16d12f45723a8fe52e747d7ab37e26d3
[9]: http://www.php-fig.org/psr/psr-4/
[10]: http://www.php-fig.org/psr/psr-2/
[11]: https://github.com/squizlabs/PHP_CodeSniffer/wiki/Fixing-Errors-Automatically

  