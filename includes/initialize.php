<?php
/**
 * Description of initialize
 * contains all the files to be included
 * @author wallace
 */
/*
 * this file contains the paths for root directory (SITE_ROOT) and includes directory (LIB_PATH)
 */
defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
defined("SITE_ROOT") ? null : define("SITE_ROOT",DS."opt".DS."lampp".DS."htdocs".DS."kejaport");

defined("LIB_PATH") ? null : define("LIB_PATH",SITE_ROOT.DS."includes".DS);

// load config file first because the other include files use it
require_once (LIB_PATH."config.php");

// load functions so that everything else can use them
// function contains an autoload function for the classes
require_once (LIB_PATH."functions.php");

// load core classes/objects
require_once (LIB_PATH."class.databaseobject.php"); // at the moment this class is empty
require_once (LIB_PATH."class.database.php");
require_once (LIB_PATH."class.user.php");
require_once (LIB_PATH."class.session.php");
require_once (LIB_PATH."class.photograph.php");
require_once (LIB_PATH."class.advertisement.php");

// load helper classes for paginating the homepage index.php
require_once (LIB_PATH."class.pagination.php"); // this is a helper class
