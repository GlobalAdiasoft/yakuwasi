<?php
require URLINC . 'check_session.php';
require URLINC . 'head.php';
require URLINC . 'nav_dash.php';

?>
<input type="hidden" value="0" name="nrokardex">
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <hr>
            <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Lista de Artículos</h5>
            <small><i class="far fa-edit"></i> Aquí podrá ver toda la información de todos los artículos.</small>
            &nbsp;&nbsp;<button id="btn_agregar" class="btn btn-dark btn-sm">Agregar</button>
            <hr>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <table class="datatable table table-striped table-bordered dt-responsive " style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Familia</th>
                                    <th>Marca</th>
                                    <th>Fabricante</th>
                                    <th>Descripción</th>
                                    <th>Unidad de Medida</th>
                                    <th>Ubicació</th>
                                    <th>Stock</th>
                                    <th>Stock Mínimo</th>
                                    <th>Código Artículo</th>
                                    <th>Especificación Técnica</th>
                                    <th>Imagenes</th>
                                    <th>Estado</th>
                                    <th>Proveedor</th>
                                    <th>Impuesto</th>
                                    <th>Código de Barras</th>
                                     <th>Moneda</th>

                                    <th>Ganancia</th>
                                    <th>Precio Compra sin IGV</th>
                                    <th>Precio Compra con IGV</th>
                                    <th>Precio Venta sin IGV</th>
                                    <th>Precio Venta con IGV</th>

                                    <th>Código de Usuario</th>
                                    <th>Fecha de Alta</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                    <!--<th>Editar Especificacion</th>
                                    <th>Editar Imágenes</th>-->
                                    <th>Kardex</th>

                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<form id="form_agregar" action="<?php echo URL ?>Articulos/agregar" method="post" enctype="multipart/form-data" class="ocultar">
    <div class="form-group row">
        <label for="" class="col-5">Nombre :</label>
        <div class="col-7">
            <input class="form-control form-control-sm" type="text" name="nombre" placeholder="Ingrese el nombre el articulo" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Familia :</label>
        <div class="col-7">
            <select class="form-control form-control-sm select2-single" name="familia" required>
                <option value="" disabled selected>Seleccione una familia</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Marca :</label>
        <div class="col-7">
            <select class="form-control form-control-sm select2-single" name="marca" required>
                <option value="" disabled selected>Seleccione una marca</option>
            </select>
        </div>
    </div>
    <div class="form-group row ocultar">
        <label for="" class="col-5">Fabricante :</label>
        <div class="col-7">
            <select class="form-control form-control-sm select2-single" name="fabricante" >
                <option value="" disabled selected>Seleccione un fabricante</option>
            </select>
        </div>
    </div>
    <div class="form-group row ocultar">
        <label for="" class="col-5">Descripción :</label>
        <div class="col-7">
            <textarea class="form-control form-control-sm" name="descripcion" cols="30" rows="3" placeholder="Ingrese una pequeña descripción"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Unidad de medida :</label>
        <div class="col-7">
            <select class="form-control form-control-sm select2-single" name="unidad_medida" required>
                <option value="" disabled selected>Seleccione una unidad de medida</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Ubicación :</label>
        <div class="col-7">
            <select class="form-control form-control-sm select2-single" name="ubicacion" required>
                <option value="" disabled selected>Seleccione una ubicacion</option>

            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Código de barras :</label>
        <div class="col-7">
            <input class="form-control form-control-sm" type="text" name="codbarras" placeholder="Ingrese el código del artículo" required>
            <br>
            <div id="imagen_cod_bar"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Código artículo :</label>
        <div class="col-7">
            <input class="form-control form-control-sm" type="text" name="cod_articulo" placeholder="Ingrese el código del artículo" required >
        </div>
    </div>
    <div class="form-group row ocultar">
        <label for="" class="col-5">Especificación técnica :</label>
        <div class="col-7">
            <div id="file_especificacion">Cargar Especificación</div>
        </div>
    </div>
    <div class="form-group row ocultar">
        <label for="" class="col-5">Imagen o Imágenes :</label>
        <div class="col-7">
            <div id="file_imagen">Cargar Imagen</div>
        </div>
    </div>
    <div class="form-group row ocultar">
        <label for="" class="col-5">Estado :</label>
        <div class="col-7">
            <select class="form-control form-control-sm select2-single" name="estado" 0>
                <option value="" disabled>Seleccione un estado</option>
                <option value="1" selected>Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Proveedor :</label>
        <div class="col-7">
            <select class="form-control form-control-sm select2-single" name="proveedor" required>
                <option value="" disabled selected>Seleccione un proveedor</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Impuesto :</label>
        <div class="col-7">
            <input class="form-control form-control-sm" type="text" name="impuesto" placeholder="Ingrese el impuesto" required value="<?php echo IGV; ?>" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Stock :</label>
        <div class="col-7">
            <input class="form-control form-control-sm" type="number" name="stock" min="0" placeholder="Ingrese Stock" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Stock Mínimo :</label>
        <div class="col-7">
            <input class="form-control form-control-sm" type="number" name="stockminimo" min="1" placeholder="Ingrese el stock minimo" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Moneda :</label>
        <div class="col-7">
            <select class="form-control form-control-sm" name="moneda" id="" required>
                <option value="" disabled selected="">Seleccione una moneda</option>
                <option value="PEN">Soles</option>
                <option value="USD">Dólares</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5 font_azul">Ganancia :</label>
        <div class="col-7">
            <input class="form-control form-control-sm  two-decimals"  name="ganancia" type="number" step="any"   required >
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5 font_azul">Precio Compra con IGV :</label>
        <div class="col-7">
            <input class="form-control form-control-sm  two-decimals"  name="produ_precio_compra_conigv" type="number" step="any"  required >
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5 font_azul">Precio Compra sin IGV :</label>
        <div class="col-7">
            <input class="form-control form-control-sm  two-decimals"  name="produ_precio_compra_sinigv" type="number" step="any"   required >
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5 font_azul">Precio Venta con IGV :</label>
        <div class="col-7">
            <input class="form-control form-control-sm  two-decimals"  name="produ_precio_ventaconigv" type="number" step="any"  required>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5 font_azul">Precio Venta sin IGV :</label>
        <div class="col-7">
            <input class="form-control form-control-sm"  name="produ_precio_ventasinigv" type="number" step="any"  min="1" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5 "></label>
        <div class="col-7">
            <button class="btn btn-dark btn-sm">Agregar </button>
        </div>
    </div>
</form>
<form id="form_modificar" action="<?php echo URL ?>Articulos/modificar" method="post" enctype="multipart/form-data" class="ocultar">
    <input name="id" type="hidden" >
    <div class="form-group row">
        <label for="" class="col-5">Nombre :</label>
        <div class="col-7">
            <input class="form-control form-control-sm" type="text" name="nombre" placeholder="Ingrese el nombre el articulo" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Familia :</label>
        <div class="col-7">
            <select class="form-control form-control-sm select2-single" name="familia" required>
                <option value="" disabled selected>Seleccione una familia</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Marca :</label>
        <div class="col-7">
            <select class="form-control form-control-sm select2-single" name="marca" required>
                <option value="" disabled selected>Seleccione una marca</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Fabricante :</label>
        <div class="col-7">
            <select class="form-control form-control-sm select2-single" name="fabricante" required>
                <option value="" disabled selected>Seleccione un fabricante</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Descripción :</label>
        <div class="col-7">
            <textarea class="form-control form-control-sm" name="descripcion" cols="30" rows="3" placeholder="Ingrese una pequeña descripción"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Unidad de medida :</label>
        <div class="col-7">
            <select class="form-control form-control-sm select2-single" name="unidad_medida" required>
                <option value="" disabled selected>Seleccione una unidad de medida</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Ubicación :</label>
        <div class="col-7">
            <select class="form-control form-control-sm select2-single" name="ubicacion" required>
                <option value="" disabled selected>Seleccione una ubicacion</option>

            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Código de barras :</label>
        <div class="col-7">
            <input class="form-control form-control-sm" type="text" name="codbarras" placeholder="Ingrese el código del artículo" required >
            <br>
            <div id="imagen_cod_bar"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Código artículo :</label>
        <div class="col-7">
            <input class="form-control form-control-sm" type="text" name="cod_articulo" placeholder="Ingrese el código del artículo" required >
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Estado :</label>
        <div class="col-7">
            <select class="form-control form-control-sm select2-single" name="estado" 0>
                <option value="" disabled>Seleccione un estado</option>
                <option value="1" selected>Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Proveedor :</label>
        <div class="col-7">
            <select class="form-control form-control-sm select2-single" name="proveedor" required>
                <option value="" disabled selected>Seleccione un proveedor</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Impuesto :</label>
        <div class="col-7">
            <input class="form-control form-control-sm" type="text" name="impuesto" placeholder="Ingrese el impuesto" required value="" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Stock :</label>
        <div class="col-7">
            <input class="form-control form-control-sm" type="number" name="stock" min="0" placeholder="Ingrese Stock" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Stock Mínimo :</label>
        <div class="col-7">
            <input class="form-control form-control-sm" type="number" name="stockminimo" min="1" placeholder="Ingrese el stock minimo" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5">Moneda :</label>
        <div class="col-7">
            <select class="form-control form-control-sm" name="moneda" id="" required>
                <option value="" disabled selected="">Seleccione una moneda</option>
                <option value="PEN">Soles</option>
                <option value="USD">Dólares</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5 font_azul">Ganancia :</label>
        <div class="col-7">
            <input class="form-control form-control-sm  two-decimals"  name="ganancia" type="number" step="any"   required >
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5 font_azul">Precio Compra con IGV :</label>
        <div class="col-7">
            <input class="form-control form-control-sm  two-decimals"  name="produ_precio_compra_conigv" type="number" step="any"  required >
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5 font_azul">Precio Compra sin IGV :</label>
        <div class="col-7">
            <input class="form-control form-control-sm  two-decimals"  name="produ_precio_compra_sinigv" type="number" step="any"   required >
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5 font_azul">Precio Venta con IGV :</label>
        <div class="col-7">
            <input class="form-control form-control-sm  two-decimals"  name="produ_precio_ventaconigv" type="number" step="any"  required>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5 font_azul">Precio Venta sin IGV :</label>
        <div class="col-7">
            <input class="form-control form-control-sm"  name="produ_precio_ventasinigv" type="number" step="any"  min="1" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-5 "></label>
        <div class="col-7">
            <button class="btn btn-dark btn-sm">Modificar</button>
        </div>
    </div>
</form>
<?php
require URLINC . 'footer.php';
?>
<div id="kardex" class="ocultar">
<table class="datatable1 table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Articulo</th>
                                    <th>Código Articulo</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Ingreso</th>
                                    <th>Salida</th>
                                    <th>Saldo</th>
                                    <th>Usuario</th>
                                    <th>Documento</th>
                                    <th>Correlativo</th>
                                    <th>Proveedor</th>
                                    <th>Observaciones</th>


                            </thead>
                        </table></div>