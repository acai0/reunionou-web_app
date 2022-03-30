<?php
namespace reu\back2\app\bootstrap;

use Illuminate\Database\Capsule\Manager;

class Bootstrap {

    public static function startEloquent($file) {

        $conf = parse_ini_file($file);
        $db = new Manager();

        $db->addConnection($conf);
        $db->setAsGlobal();
        $db->bootEloquent();

    }
}
