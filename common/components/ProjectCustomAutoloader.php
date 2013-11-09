<?php

class ProjectCustomAutoloader
{
    private $_predefined = array(
        "B" => "backend",
        "F" => "frontend",
        "A" => "api"
    );

    private $_nsDelim = '\\';

    function loadClass($class_name_fully_qualified)
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

            //--- try COMMON app ---//
            if(!in_array($parts_1, array_keys($this->_predefined))){
                //todo - fix direct path from namespace not components
                $base_path = realpath(Yii::getPathOfAlias("common")) . DIRECTORY_SEPARATOR;
                $relative_parts = array_slice($parts, 1);

                $this->_includeClass(
                    $class_name_fully_qualified,
                    $base_path,
                    $relative_parts
                );

//                $absolute_path = $base_path . implode($ns_delim, $relative_parts) . ".php";
//                require $absolute_path;
//                $exists = class_exists($class_name_fully_qualified) || interface_exists($class_name_fully_qualified);
            }
            //--- any of possible -end parts ---//
            else{
                //$path_alias = strtolower($parts_1);
                $path_alias = $this->_predefined[$parts_1];
                //TODO - check if proper alias exists
                $base_path = realpath(Yii::getPathOfAlias($path_alias)) . DIRECTORY_SEPARATOR;
                //$base_path .= DIRECTORY_SEPARATOR . "components" . DIRECTORY_SEPARATOR;
                $relative_parts = array_slice($parts, 2);

                $this->_includeClass(
                    $class_name_fully_qualified,
                    $base_path,
                    $relative_parts
                );
//                $absolute_path = $base_path . implode($ns_delim, $relative_parts) . ".php";
//                //pa($absolute_path);
//                require $absolute_path;
//                $exists = class_exists($class_name_fully_qualified) || interface_exists($class_name_fully_qualified);
            }
        }

        return $exists;
    }

    private function _includeClass($class_name_fully_qualified, $base_path, $relative_parts)
    {
        $absolute_path = $base_path . implode($this->_nsDelim, $relative_parts) . ".php";
        //pa($absolute_path);

        require $absolute_path;
        $exists = class_exists($class_name_fully_qualified) || interface_exists($class_name_fully_qualified);
    }
}
