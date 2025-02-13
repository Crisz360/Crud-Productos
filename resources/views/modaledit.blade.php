<div id="editProductoModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">						
                    <h4 class="modal-title">Editar Registro</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idEdit">	
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" id="nameEdit" required>
                    </div>
                    <div class="form-group">
                        <label>Precio</label>
                        <input type="number" class="form-control" id="priceEdit" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha Registro</label>
                        <input type="text" class="form-control" id="dateEdit" required>
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" class="form-control" id="stockEdit" required>
                    </div>					
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
                    <button type="button" class="btn btn-success" id="saveEdit" onclick="actualizarProducto()">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>