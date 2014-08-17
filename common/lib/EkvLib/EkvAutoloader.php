<?php
namespace EkvLib;

class EkvAutoloaderException extends EkvLibException{}

class EkvAutoloader
{
    private $predefined = array(
        "B" => "backend",
        "F" => "frontend",
        "A" => "api"
    );

    private $nsDelim = '\\';

    function loadClass($classNameFullyQualified)
    {

        $exists = false;
        //pa($classNameFullyQualified);
        $parts = explode($this->nsDelim, $classNameFullyQualified);

        //--- proper ekonoval class is comming ---//
        if(
            sizeof($parts) >= 2 // "\Ekv\Product" or "\Ekv\Frontend\Products"
            && $parts[0] == "Ekv"
        ){

            //--- load common classes (common namespace is omitted) ---//

            //--- common ---//
            $parts1 = $parts[1];

            $appsRootPath = __DIR__.'/../../../';

            //--- try COMMON app ---//
            if(!in_array($parts1, array_keys($this->predefined))){
                //todo - fix direct path from namespace not components
                //$base_path = realpath(Yii::getPathOfAlias("common")) . DIRECTORY_SEPARATOR;
                $basePath = $appsRootPath.'common'.DIRECTORY_SEPARATOR;
                $relativeParts = array_slice($parts, 1);

                $this->_includeClass(
                    $classNameFullyQualified,
                    $basePath,
                    $relativeParts
                );

//                $absolute_path = $base_path . implode($ns_delim, $relative_parts) . ".php";
//                require $absolute_path;
//                $exists = class_exists($class_name_fully_qualified) || interface_exists($class_name_fully_qualified);
            }
            //--- any of possible -end parts ---//
            else{
                //$path_alias = strtolower($parts_1);
                $pathAlias = $this->predefined[$parts1];
                //TODO - check if proper alias exists
                $basePath = $appsRootPath . $pathAlias . DIRECTORY_SEPARATOR;
                //$base_path .= DIRECTORY_SEPARATOR . "components" . DIRECTORY_SEPARATOR;
                $relativeParts = array_slice($parts, 2);

                $this->_includeClass(
                    $classNameFullyQualified,
                    $basePath,
                    $relativeParts
                );
//                $absolute_path = $base_path . implode($ns_delim, $relative_parts) . ".php";
//                //pa($absolute_path);
//                require $absolute_path;
//                $exists = class_exists($class_name_fully_qualified) || interface_exists($class_name_fully_qualified);
            }
        }

        return $exists;
    }

    private function _includeClass($classNameFullyQualified, $basePath, $relativeParts)
    {
        $absolutePath = $basePath . implode($this->nsDelim, $relativeParts) . ".php";

        if(file_exists($absolutePath)){
            require $absolutePath;
        }else{
            throw new EkvAutoloaderException("Classname {$classNameFullyQualified} can't be loaded.");
        }
        $exists = class_exists($classNameFullyQualified) || interface_exists($classNameFullyQualified);
    }
}
 