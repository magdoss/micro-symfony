# micro-symfony

Micro-symfony is a little framework based on Symfony's microKernelTrait.  
See https://symfony.com/doc/3.4/configuration/micro_kernel_trait.html for detailed informations.

The standard edition of Symfony brings all features for building complex applications.  
But especially little projects builded from scratch needn’t all containing components, bundles and configuration files at the start.
I don’t like the fact, that all of these stuff are loaded whether needed or not, because it blow up your project unnecessarily.

So I looked for a alternative and founded the MicroKernelTrait, which was introduced with Symfony 2.8.  
With this it is possible, to build fully functional apps which can even consist of only one single file.

Micro-symfony takes the middle way of these two approaches.
It loads some, in my opinion, important Symfony components in a simple, easy to extend structure which build the basement for your project and grow up depending on your specific requirements.

## Installation

Installing micro-symfony on your system is a simple process.
First of all, make sure you have installed composer on your system.  
Take a look at https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx if you need help.

After this, go to the path where you want to install micro-symfony and clone the repository.
```bash
$ git clone git@github.com:mahlerse/micro-symfony.git
```

Now enter the directory micro-symfony
```bash
$ cd micro-symfony
```

Last, download and install the required dependencies
```bash
$ composer install
```
After finishing, you have a new, clean installation of micro-symfony and you can start by customizing and developing your own application.

## Structure

Micro-symfiny follows a bit different directory structure as a "normal" Symfony app.
```
|──  app/  
    |──  cache/  
    |──  config/  
    |──  logs/  
    MicroKernel.php  
|──  src/  
|──  vendor/  
|──  web/  
```
The app-directory is the heart of the application. Here you can find the MicroKernel.php which loads all components and bundles for your application.
The directories for the config-, cache- and log-files are stored here, too. 

The src-directory is the right place for your own bundles and business logic. The bundles were loaded by the autoloader automaticly, so you can initialize it in the MicroKernel.php

In the vendor-directory are all external dependecies loaded by composer, for example the used basic symfony-components. Do not change or edit files here!

As in a full-stack installation of Symfony, you have a console to run different tasks from the command line.
You find a list of all available commands by running
```bash
$ ./console
```
in a terminal directly in the root directory of your micro-symfony installation.

## Extending micro-symfony

As said above, micro-symfony loads only a few basic components of Symfony’s Standard Edition.

There are the FrameworkBundle, the TwigBundle for using the template engine and the SensionFrameworkExtraBundle to load routes directly from the controllers, by default.
When you are in the development environment, the SensioGeneratorBundle will also load, to add new bundles, controllers or console commands step by step via the wizard.

Of course you can extend micro-symfony with additional (standard) components/bundles provided by Symfony.  
To add a additional symfony bundle, open the MicroKernel.php file at the app directory.  
Now add the namespace of the new bundle at the top of the script.  
After that, initialize the component at the registerBundle method.

To add your own bundle, you can use the integrated bundle-generator. It will generate all necessary files and register the new bundle at the MicroKernel.php. This is the simplest way to start with at new bundle and your own development.  
To start the bundle-generator, type the following command in your terminal and follow the guide step-by-step.
```bash
$ ./console generate:bundle
```

## Bugs and Support

If you find a bug or another issue, please create a new ticket at the issue-section of the GitHub respository.

## License

You can use the code within the [MIT License](https://opensource.org/licenses/MIT)