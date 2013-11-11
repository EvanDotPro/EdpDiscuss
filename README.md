EdpDiscuss
========
Version 0.0.1

Requirements
------------

* [Zend Framework 2](https://github.com/zendframework/zf2) (latest master)
* [ZfcBase](https://github.com/ZF-Commons/ZfcBase) (latest master)
* [BaconStringUtils] (https://github.com/Bacon/BaconStringUtils)

Installation
------------

### Main Setup

#### By cloning project

1. Install the [ZfcBase](https://github.com/ZF-Commons/ZfcBase) ZF2 module
   by cloning it into `./vendor/`.
2. Install the [BaconStringUtils] (https://github.com/Bacon/BaconStringUtils) ZF2 module
   by cloning it into `./vendor/`.
3. Clone this project into your `./vendor/` directory.


Post Installation 
-----------------

1. Enabling the modules in your `application.config.php` file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'ZfcBase',
            'BaconStringUtils',
            'EdpDiscuss',
        ),
        // ...
    );
    ```
2. Import the SQL schema located in `./vendor/EdpDiscuss/data/schema.sql`.


Introduction
------------
EdpDiscuss is a module for Zend Framework 2.


Options
-------

The EdpDiscuss module has various options to allow you to quickly customize the basic functionality.

The following options are available:

- **thread_model_class** - Name of Thread entity class to use.
- **message_model_class** - Name of Message entity class to use.
- **tag_model_class** - Name of Tag entity class to use.
- **visit_model_class** - Name of Visit Entity class to use.