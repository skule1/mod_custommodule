<?php
// No direct access
defined('_JEXEC') or die;

// Load the module's helper file
require_once __DIR__ . '/helper.php';

// Get data from the helper
$data = ModCustomModuleHelper::getData($params);

// Load the layout file
require JModuleHelper::getLayoutPath('mod_custommodule');
?>
