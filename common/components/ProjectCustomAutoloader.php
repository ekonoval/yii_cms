<?php

class ProjectCustomAutoloader
{
    static private $_predefined = array(
        "Backend",
        "Frontend",
        "Api"
    );

    static function loadClass($class_name_fully_qualified)
    {

        $exists = false;
        $ns_delim = '\\';
        //pa($class_name_fully_qualified);
        $parts = explode($ns_delim, $class_name_fully_qualified);

        //--- proper ekonoval class is comming ---//
        if(
            sizeof($parts) >= 2 // "\Ekv\Product" or "\Ekv\Frontend\Products"
            && $parts[0] == "Ekv"
        ){
            //pa(Yii::getPathAliases());exit;

            //--- load common classes (common namespace is omitted) ---//

            //--- common ---//
            $parts_1 = $parts[1];

            if(!in_array($parts_1, self::$_predefined)){
                $base_path = realpath(Yii::getPathOfAlias("common.components")) . DIRECTORY_SEPARATOR;
                $relative_parts = array_slice($parts, 1);
                $absolute_path = $base_path . implode($ns_delim, $relative_parts) . ".php";
                require $absolute_path;
                $exists = class_exists($class_name_fully_qualified) || interface_exists($class_name_fully_qualified);
            }
            //--- any of possible -end parts ---//
            else{
                $path_alias = strtolower($parts_1);
                //TODO - check if proper alias exists
                $base_path = realpath(Yii::getPathOfAlias($path_alias));
                $base_path .= DIRECTORY_SEPARATOR . "components" . DIRECTORY_SEPARATOR;
                $relative_parts = array_slice($parts, 2);

                $absolute_path = $base_path . implode($ns_delim, $relative_parts) . ".php";
                require $absolute_path;
                $exists = class_exists($class_name_fully_qualified) || interface_exists($class_name_fully_qualified);
            }
        }
//        foreach (self::$prefixes as $prefix) {
//            if (strpos($className, $prefix . '_') !== false) {
//                if (!self::$basePath) {
//                    self::$basePath =
//                        Yii::getPathOfAlias("application.vendors") . '/';
//                }
//                include self::$basePath . str_replace
//                ('_', '/', $className) . '.php';
//                return class_exists($className, false) ||
//                    interface_exists($className, false);
//            }
//        }
        return $exists;
    }
}
