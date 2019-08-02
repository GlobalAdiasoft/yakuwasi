<?php
class HeadLinks {
    function listar_fw($path, $nombre = '') {
        $dir = opendir($path);
        $files = array();
        while ($elemento = readdir($dir)) {
            if ($elemento != "." && $elemento != "..") {
                if (is_dir($path . $elemento)) {
                    //listar_fw($path . $elemento . '/');
                } else {
                    $files[] = $elemento;
                }
            }
        }
        for ($x = 0;$x < count($files);$x++) {
            $separarextension = explode(".", $files[$x]);
            $contadorextension = count($separarextension);
            switch ($contadorextension) {
                case 1:
                    $extencion = $separarextension[0];
                break;
                case 2:
                    $extencion = $separarextension[1];
                break;
                case 3:
                    $extencion = $separarextension[2];
                break;
                case 4:
                    $extencion = $separarextension[3];
                break;
                case 5:
                    $extencion = $separarextension[4];
                break;
            }
            switch ($extencion) {
                case 'css':
                    $link = '<link rel="stylesheet" href="' . URL . $path . $files[$x] . '">';
                break;
                case 'js':
                    $link = '<script type="text/javascript" src="' . URL . $path . $files[$x] . '"></script>';
                break;
                default:
                break;
            }
            if ($nombre == '') {
                $min = strpos($files[$x], 'min');
            } else {
                $min = strpos($files[$x], $nombre);
            }
            if ($min === false) {
            } else {
                echo $link;
            }
        }
    }
    function carpetas_head($tipo_archivo = '') {
        switch ($tipo_archivo) {
            case 'css':
                $directorio = opendir(URLCSSSYSTEM);
            break;
            case 'js':
                $directorio = opendir(URLJSSYSTEM);
            break;
            default:
            case '':
                exit;
            break;
        }
        while ($archivo = readdir($directorio)) {
            $busqueda = 'min';
            if (is_dir($archivo)) {
            } else {
                $coincidencia = strrpos($archivo, $busqueda);
                if ($coincidencia != true) {
                } else {
                    switch ($tipo_archivo) {
                        case 'css':
                            echo '<link rel="stylesheet" href="' . URL . URLCSSSYSTEM . $archivo . '">';
                        break;
                        case 'js':
                            echo '<script type="text/javascript" src="' . URL . URLJSSYSTEM . $archivo . '"></script>';
                        break;
                        default:
                        case '':
                            exit;
                        break;
                    }
                }
            }
        }
    }
}
