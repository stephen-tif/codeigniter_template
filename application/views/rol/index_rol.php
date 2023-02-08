<div class="container-fluid">
    <div class="row rounded bg-light sombra">
        <div class="col-md-8 text-center title py-2">
            <h1 class="display-4">Gestion de roles</h1>
        </div>
        <div class="col-md-4 text-center title pt-3 py-2">
            <button class="btn btn-primary" id="new"><i class="fas fa-plus"></i> Nuevo registro</button>
        </div>
        <div class="clearfix"></div>

        <div class="col-md-12">
            <div class="table-responsive col-md-12 mx-auto">
                <table id="tablaRoles" class="table table-bordered mx-auto" width="70%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                        <th>ID</th>
                            <th>NOMBRE</th>
                            <th>OPCIONES</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!--MODAL INSERTAR-->
<div class="modal fade" id="frmInsertar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-primary">
                <h4 class="modal-title">
                    Nuevo rol
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row p-3 my-2" id="bloqueFormulario">

                    <div class="form-column col-md-12">
                        <div class="form-group">
                            <label for="">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" name="enviarData" id="enviarData" class="btn btn-primary btn-lg">Agregar</button>
                <button type="button" onclick="$('#nombre').val('');" class="btn btn-secondary btn-lg">Limpiar</button>
            </div>
        </div>
    </div>
</div>

<!--MODAL MODIFICAR-->
<div class="modal fade" id="frmModificar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-success">
                <h4 class="modal-title">Modificar rol</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row p-3 my-2" id="FormularioModificar">

                    <input type="text" class="form-control" name="id" id="id" hidden>
                    <div class="form-column col-md-12">
                        <div class="form-group">
                            <label for="">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" name="modificarData" id="modificarData" class="btn btn-success btn-lg">Modificar</button>
                <button type="button" onclick="$('#FormularioModificar :input').val('').trigger('change');" 
                    class="btn btn-secondary btn-lg" data-dismiss="modal">Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
