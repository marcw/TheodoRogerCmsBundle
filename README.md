Theodo RogerCMSBundle
=====================

WARNING: This fork is really for personal use and available here only for
hosting purpose. Expect things to be broken, commits to disappear and other
inconveniences. If you DO use this bundle, drop me a mail and I will start
working correctly. I might even start tagging release, heh.

The documentation might be completely outdated.

## Installation

### Step 1: Downloading the bundle
To add the bundle to your project add the following entry to your deps file:

### Step 2: Dependencies

**Using Composer**

Add the Roger repository:

``` json
    "require": {
        "theodo/roger-cms-bundle": "dev-master"
    }
```

Then run ```php composer.phar install``` and you are done. You can now jump to the step 4.

### Step 3: AppKernel.php

Register TheodoRogerCmsBundle in your `app/AppKernel.php` file:

``` php
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),

            [...]
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Theodo\RogerCmsBundle\TheodoRogerCmsBundle(),
        );
```

Follow StofDoctrineExtensionsBundle's doc to add the configuration for **timestampable** behavior.

### Step 5: Routing

Add the following lines to your `app/config/routing.yml` file:

``` bash
RogerCms:
    resource: "@TheodoRogerCmsBundle/Resources/config/routing.xml"
    prefix: /
```

### Step 6: Database and entities

RogerCMS uses database to store all content informations, so you need to add its
entities to your entity manager. As it also uses his own user management system
it may be a good idea to use a separate database. For further informations on
how to setup and manage a separate database connection for the CMS, refer to
99-multiple_databases.md file.

If you don't feel like having Roger in separate db, the Symfony Standard Edition
default config will work out of the box. Just generate your schema/migrations
and update your db.

### Step 7: Read the docs

For more documentation, check out the Resources/doc folder.
