<?php
  session_start();
  if (empty($_SESSION["id"] and $_SESSION["id"]!="admin")) {
    header("location: /BicRobmvc/index.php");
  }else{
    
  }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Registro De Usuarios</title>
        <link rel="stylesheet" href="/BicRobmvc/views/src/css/estiloRegUsuariosAdm.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/fdcbc345f8.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title>Registro Usuarios</title>
    </head> <?php include_once ("../recursos/navAdm.php"); ?>

    <body class="bg-black">
        <div class="container mt-5">
            <div class="row paneluno m-4 p-2">
                <h3>Registro De Usuarios</h3>
                <div class="row">
                    <div class="col-12">
                        <form class="p-3 border rounded" id="formRegUsrs" method="POST">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="apellidoPaterno" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="apellidoPaterno" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" id="apellidoMaterno" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="estado" class="form-label">Estado</label>
                                    <input type="text" class="form-control" id="estado" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="municipio" class="form-label">Municipio</label>
                                    <input type="text" class="form-control" id="municipio" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="tel" class="form-control" id="telefono" pattern="[0-9]+" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="correoElectronico" class="form-label">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="correoElectronico" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="nombreUsuario" class="form-label">Nombre de usuario</label>
                                    <input type="text" class="form-control" id="nombreUsuario" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="tipoUsuario" class="form-label">Tipo de usuario</label>
                                    <select class="form-select" id="tipoUsuario" required>
                                        <option value="" disabled selected>Selecciona una opción</option>
                                        <option value="usuario">Usuario</option>
                                        <option value="administrador">Administrador</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="contraseña" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="contraseña" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="confirmarContraseña" class="form-label">Confirmar contraseña</label>
                                    <input type="password" class="form-control" id="confirmarContraseña" required>
                                </div>
                                <div class="col-md-4 PPP">
                                    <label for="confirmarContraseña" class="form-label">a</label>
                                    <button type="submit" class="btn btn-primary w-100" id="registrar">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div>
                        <input type="text" id="busq-usr">
                        <button class="btn btn-success" onclick="cargarTabla();">Buscar</button>
                        <button class="btn btn-danger" id="cancelBusq">Cancelar</button>
                    </div>

                    <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarModalLabel">Editar Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/BicRobmvc/controllers/usrsController.php?accion=update" class="p-3 border rounded" id="formEditarUsrs" method="POST">
                                    <input type="hidden" name="idM" id="idM">
                                    <div class="form-group">
                                        <label for="nombrem">Nombre:</label>
                                        <input type="text" class="form-control" name="nombrem" id="nombrem">
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidoPaternom">Apellido Paterno:</label>
                                        <input type="text" class="form-control" name="apellidoPaternom"
                                            id="apellidoPaternom">
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidoMaternom">Apellido Materno:</label>
                                        <input type="text" class="form-control" name="apellidoMaternom"
                                            id="apellidoMaternom">
                                    </div>
                                    <div class="form-group">
                                        <label for="estadom">Estado:</label>
                                        <input type="text" class="form-control" name="estadom" id="estadom">
                                    </div>
                                    <div class="form-group">
                                        <label for="municipiom">Municipio:</label>
                                        <input type="text" class="form-control" name="municipiom" id="municipiom">
                                    </div>
                                    <div class="form-group">
                                        <label for="telefonom">Teléfono:</label>
                                        <input type="text" class="form-control" name="telefonom" id="telefonom">
                                    </div>
                                    <div class="form-group">
                                        <label for="correoElectronicom">Correo Electrónico:</label>
                                        <input type="email" class="form-control" name="correoElectronicom"
                                            id="correoElectronicom">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombreUsuariom">Nombre de Usuario:</label>
                                        <input type="text" class="form-control" name="nombreUsuariom" id="nombreUsuariom">
                                    </div>
                                    <div class="form-group">
                                        <label for="contraseñam">Contraseña:</label>
                                        <input type="password" class="form-control" name="contraseñam" id="contraseñam">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmarContraseñam">Confirmar Contraseña:</label>
                                        <input type="password" class="form-control" name="confirmarContraseñam"
                                            id="confirmarContraseñam">
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <input type="submit" class="btn btn-primary">Guardar cambios</input>
                                </form>
                            </div>
                            <div class="modal-footer">
                                
                            </div>
                        </div>
                    </div>
                </div>

                    <table id="tablaUsrs">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="contenedor-tabla"></div>
                </div>
                <!-- Modal -->
                <!-- Modal -->
               
    </body>
    <script src="./cargarTbl.js"></script>

</html>