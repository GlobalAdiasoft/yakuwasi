<?php
class Index_controller extends Controller {
    function __construct() {
        parent::__construct();
    }
    public function ejemplo() {
        print_r(PDO::getAvailableDrivers());
    }
    public function index() {
        /*      
        $usrCtrlr             = new Dashboard_controller();
        $this->view->usrCtrlr = $usrCtrlr->hola();
        */
        $this->view->render($this, 'index', NOMBRE_EMPRESA, 'index');
    }
    public function cpanel() {
        $this->view->render($this, 'cpanel', NOMBRE_EMPRESA, 'cpanel');
    }
    public function usuarios() {
        $this->view->render($this, 'usuarios', NOMBRE_EMPRESA, 'usuarios');
    }
    public function clientes() {
        $this->view->render($this, 'clientes', NOMBRE_EMPRESA, 'clientes');
    }
    public function facturar() {
        $this->view->render($this, 'facturar', NOMBRE_EMPRESA, 'facturar');
    }
    public function verfacturas() {
        $this->view->render($this, 'verfacturas', NOMBRE_EMPRESA, 'verfacturas');
    }
    public function verboletas() {
        $this->view->render($this, 'verboletas', NOMBRE_EMPRESA, 'verboletas');
    }
    public function vernotacredito() {
        $this->view->render($this, 'vernotacredito', NOMBRE_EMPRESA, 'vernotacredito');
    }
    public function vernotadebito() {
        $this->view->render($this, 'vernotadebito', NOMBRE_EMPRESA, 'vernotadebito');
    }
    public function almacen_familia() {
        $this->view->render($this, 'almacen/familia', NOMBRE_EMPRESA, 'familia');
    }
    public function almacen_marca() {
        $this->view->render($this, 'almacen/marca', NOMBRE_EMPRESA, 'marca');
    }
    public function almacen_fabricante() {
        $this->view->render($this, 'almacen/fabricante', NOMBRE_EMPRESA, 'fabricante');
    }
    public function almacen_unidades() {
        $this->view->render($this, 'almacen/unidades', NOMBRE_EMPRESA, 'unidades');
    }
    public function sistema_proveedores() {
        $this->view->render($this, 'sistema/proveedores', NOMBRE_EMPRESA, 'proveedores');
    }
    public function almacen_articulos() {
        $this->view->render($this, 'almacen/articulos', NOMBRE_EMPRESA, 'articulos');
    }
    public function pedidos_pedidos() {
        $this->view->render($this, 'pedidos/pedidos', NOMBRE_EMPRESA, 'pedidos');
    }
    public function pedidos_lista_pedidos() {
        $this->view->render($this, 'pedidos/lista_pedidos', NOMBRE_EMPRESA, 'lista_pedidos');
    }
    public function facturacionelectronica_boleta() {
        $this->view->render($this, 'facturacionelectronica/boleta', NOMBRE_EMPRESA, 'boleta');
    }
    public function facturacionelectronica_factura() {
        $this->view->render($this, 'facturacionelectronica/factura', NOMBRE_EMPRESA, 'factura');
    }
    public function facturacionelectronica_nota_credito() {
        $this->view->render($this, 'facturacionelectronica/nota_credito', NOMBRE_EMPRESA, 'nota_credito');
    }
    public function facturacionelectronica_nota_credito_tabla() {
        $this->view->render($this, 'facturacionelectronica/nota_credito_tabla', NOMBRE_EMPRESA, 'nota_credito_tabla');
    }
    public function facturacionelectronica_nota_debito_tabla() {
        $this->view->render($this, 'facturacionelectronica/nota_debito_tabla', NOMBRE_EMPRESA, 'nota_debito_tabla');
    }
    public function facturacionelectronica_nota_debito() {
        $this->view->render($this, 'facturacionelectronica/nota_debito', NOMBRE_EMPRESA, 'nota_debito');
    }
    public function pedidos_cobranza() {
        $this->view->render($this, 'pedidos/cobranza', NOMBRE_EMPRESA, 'cobranza');
    }
    public function caja() {
        $this->view->render($this, 'caja', NOMBRE_EMPRESA, 'caja');
    }
    public function compras() {
        $this->view->render($this, 'compras', NOMBRE_EMPRESA, 'compras');
    }
    public function compras2() {
        $this->view->render($this, 'co2', NOMBRE_EMPRESA, 'co2');
    }
    public function ventas() {
        $this->view->render($this, 'ventas', NOMBRE_EMPRESA, 'ventas');
    }
    public function gastos() {
        $this->view->render($this, 'gastos', NOMBRE_EMPRESA, 'gastos');
    }
    public function kardex() {
        $this->view->render($this, 'kardex', NOMBRE_EMPRESA, 'kardex');
    }
    public function tipocambio() {
        $this->view->render($this, 'tipocambio', NOMBRE_EMPRESA, 'tipocambio');
    }
    public function ubicacion() {
        $this->view->render($this, 'ubicacion', NOMBRE_EMPRESA, 'ubicacion');
    }
    public function caja2() {
        $this->view->render($this, 'caja2', NOMBRE_EMPRESA, 'caja2');
    }
    public function pleventas() {
        $this->view->render($this, 'pleventas', NOMBRE_EMPRESA, 'pleventas');
    }
    public function plecompras() {
        $this->view->render($this, 'plecompras', NOMBRE_EMPRESA, 'plecompras');
    }
    public function reportesgeneral() {
        $this->view->render($this, 'reporteefrain', NOMBRE_EMPRESA, 'reporteefrain');
    }
    public function configuracion(){
         $this->view->render($this, 'sistema/configuracion', NOMBRE_EMPRESA, 'configuracion');
    }
     public function comprasnuevo(){
         $this->view->render($this, 'comprasnuevo', NOMBRE_EMPRESA, 'comprasnuevo');
    }
      public function nueva_caja(){
         $this->view->render($this, 'nueva_caja', NOMBRE_EMPRESA, 'nueva_caja');
    }
}
