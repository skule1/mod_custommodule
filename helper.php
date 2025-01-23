<?php
defined('_JEXEC') or die;

class ModCustomModuleHelper
{
    public static function getData($params)
    {
        // Example of interacting with the model
        JLoader::register('CustomModuleModelExample', __DIR__ . '/models/example.php');
        $model = new CustomModuleModelExample();
        $bruker = $model->bruker()->userid; //, userid, client_id
        // echo 'bruker: ' . $bruker . '<br>';
        return $model->getItems($bruker);
    }
}