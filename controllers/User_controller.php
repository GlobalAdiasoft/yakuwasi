 <?php
class User_controller extends Controller {
    function __construct() {
        parent::__construct();
    }
    public function register_user() {
        $id                = null;
        $usu_nombres       = $_POST['nombres'];
        $usu_apellidos     = $_POST['apellidos'];
        $usu_email         = $_POST['email'];
        $usu_telefono      = empty($_POST['telefono'])?'0':$_POST['telefono'];
        $usu_celular       = empty($_POST['celular'])?'0':$_POST['celular'];
        $usu_dni           = $_POST['dni'];
        $usu_fechaalta     = fecha_mysql;
        $usu_usuario       = $_POST['usuario'];
        $usu_password      = Hash::create(ALGORITMO, $_POST['password'], HASHKEY);
        $usu_acceso        = $_POST['acceso'];
        $condicion_correo  = Usuario::where('usu_email', $usu_email);
        $condicion_usuario = Usuario::where('usu_usuario', $usu_usuario);
        $usu_estado = 0;
        if (empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['email']) || empty($_POST['dni']) || empty($_POST['usuario']) || empty($_POST['password']) || empty($_POST['acceso'])) {
            echo 0; //algun vacio
            exit;
        }
        if (empty($condicion_correo)) {
        } else {
            echo 1; //ya existe correo
            exit;
        }
        if (empty($condicion_usuario)) {
        } else {
            echo 2; //ya existe correo
            exit;
        }
        $usuario = new Usuario($id, $usu_nombres, $usu_apellidos, $usu_email, $usu_telefono, $usu_celular, $usu_dni, $usu_fechaalta, $usu_usuario, $usu_password, $usu_acceso, $usu_estado);
        $usuario->create();
        echo 3;
    }
    public function login() {
        $id='';
        $password='';
        $usu_usuario       = $_POST['usuario'];
        $usu_password      = Hash::create(ALGORITMO, $_POST['password'], HASHKEY);
        $condicion_usuario = Usuario::where('usu_usuario', $usu_usuario);
        if (empty($_POST['usuario']) || empty($_POST['password'])) {
            if (empty($_POST['usuario'])) {
                echo 0.1;
                exit;
            }
            if (empty($_POST['password'])) {
                echo 0.2;
                exit;
            }
        } else {
            if (empty($condicion_usuario)) {
                echo 0; //'no existe usuario';
                exit;
            } else {
                foreach ($condicion_usuario as $value) {
                    $id = $value['id'];
                    $password = $value['usu_password'];
                   
                }
                if ($usu_password == $password) {
                    echo 1; //'coincide y estamos adentro';
                    $this->crearsesion($id);
                } else {
                    echo 2; //'existe usuario pero no coincide contraseña';
                }
            }
        }
    }
    function crearsesion($id) {
        Session::setValue('ID_TRA'.NOMBRE_SESSION, $id);
    }
    function destroy_session() {
        Session::destroy();
        echo '<script>';
        echo 'document.location = "'.URL.'";';
        echo '</script>';
    }
    function mostrar_usuarios() {
        $usuarios = Usuario::where('usu_estado',0);
        $data=array();
        
        foreach ($usuarios as $value) {
            
            switch ($value['usu_acceso']) {
                case 1:
                $usu_acceso='(1) ADMINISTRADOR';
                break;
            case 2:
                $usu_acceso='(2) CAJA';
                break;
            case 3:
                $usu_acceso='(3) PEDIDOS';
                break;
            case 4:
                $usu_acceso='(4) BLOQUEADO';
                break;
            case 5:
                $usu_acceso='(5) FACTURACIÓN';
                break;

                default:
                    break;
            }
           array_push($data, array(
               'id'=>$value['id'],
               'usu_nombres'=>$value['usu_nombres'],
               'usu_apellidos'=>$value['usu_apellidos'],
               'usu_email'=>$value['usu_email'],
               'usu_telefono'=>$value['usu_telefono'],
               'usu_celular'=>$value['usu_celular'],
               'usu_dni'=>$value['usu_dni'],
               'usu_fechaalta'=>$value['usu_fechaalta'],
               'usu_usuario'=>$value['usu_usuario'],
               'usu_password'=>$value['usu_password'],
               'usu_acceso'=>$usu_acceso,
               'usu_estado'=>$value['usu_estado'],
           ));
        }
       echo json_encode($data);
    }
    function eliminar_usuario() {
        $id       = $_POST['id'];
        $usuarios = Usuario::getById($id);
        $usuarios->setUsu_estado(1);
        $usuarios->update();
        
        echo 'eliminado';
    }
    function mostrar_usuario() {
        $usuarios = Usuario::where('id', $_POST['id']);
        echo json_encode($usuarios);
    }
    function modificar_usuario() {
        if (empty($_POST['id']) || empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['email']) || empty($_POST['dni']) || empty($_POST['usuario']) || empty($_POST['acceso'])) {
            echo 0;
            exit;
        }
        $usuarios = Usuario::getById($_POST['id']);
        $usuarios->setUsu_nombres($_POST['nombres']);
        $usuarios->setUsu_apellidos($_POST['apellidos']);
        $usuarios->setUsu_email($_POST['email']);
        $usuarios->setUsu_telefono($_POST['telefono']);
        $usuarios->setUsu_celular($_POST['celular']);
        $usuarios->setUsu_dni($_POST['dni']);
        $usuarios->setUsu_usuario($_POST['usuario']);
        $usuarios->setUsu_acceso($_POST['acceso']);
        $usuarios->update();
        echo 1;
    }
    function modificar_password() {
        if (empty($_POST['password'])) {
            echo 0;
            exit;
        }
        $usuarios = Usuario::getById($_POST['id']);
        $usuarios->setUsu_password(Hash::create(ALGORITMO, $_POST['password'], HASHKEY));
        $usuarios->update();
        echo 1;
    }
}
