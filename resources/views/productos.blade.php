<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Productos</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    body {
        color: #566787;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
		font-size: 13px;
	}
	.table-responsive {
        margin: 30px 0;
    }
	.table-wrapper {
		min-width: 1000px;
        background: #fff;
        padding: 20px 25px;
		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {        
		padding-bottom: 15px;
		color: #333;
		padding: 16px 30px;
		margin: -20px -25px 10px;
		border-radius: 3px 3px 0 0;
    }
    .table-title h1 {
		margin: 5px 0 0;
		font-size: 28px;
        text-align: center;
	}
	.table-title .btn-group {
		float: right;
	}
	.table-title .btn {
		color: #fff;
		float: right;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
		padding: 12px 15px;
		vertical-align: middle;
    }
	table.table tr th:first-child {
		width: 60px;
	}
	table.table tr th:last-child {
		width: 100px;
	}
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }	
    table.table td:last-child i {
		opacity: 0.9;
		font-size: 22px;
        margin: 0 5px;
    }
	table.table td a {
		font-weight: bold;
		color: #566787;
		display: inline-block;
		text-decoration: none;
		outline: none !important;
	}
	table.table td a:hover {
		color: #2196F3;
	}
	table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.deleteProducto {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
	}
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }	
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }    
	/* Modal styles */
	.modal .modal-dialog {
		max-width: 400px;
	}
	.modal .modal-header, .modal .modal-body, .modal .modal-footer {
		padding: 20px 30px;
	}
	.modal .modal-content {
		border-radius: 3px;
	}
	.modal .modal-footer {
		background: #ecf0f1;
		border-radius: 0 0 3px 3px;
	}
    .modal .modal-title {
        display: inline-block;
    }
	.modal .form-control {
		border-radius: 2px;
		box-shadow: none;
		border-color: #dddddd;
	}
	.modal textarea.form-control {
		resize: vertical;
	}
	.modal .btn {
		border-radius: 2px;
		min-width: 100px;
	}	
	.modal form label {
		font-weight: normal;
	}	
</style>
<script>
$(document).ready(function(){
    $('.edit').click(function(){
    let idEdit = $(this).attr('value');
    
    $.ajax({
        url: 'productos/editarProducto',
        type: 'get',
        dataType: 'json',
        data: {
            id: idEdit
        },
        success: function(response){
            let fecha = new Date(response.PRODUC_FEHCAREG);
            let fechaRegistro = fecha.getDate() + '-' + (fecha.getMonth() + 1) + '-' + fecha.getFullYear();
            
            $('#idEdit').val(response.PRODUC_ID);
            $('#nameEdit').val(response.PRODUC_NOMBRE);
            $('#priceEdit').val(response.PRODUC_PRECIO);
            $('#dateEdit').val(fechaRegistro);
            $('#stockEdit').val(response.PRODUC_STOCK);
            $('#idEdit').val(response.PRODUC_ID);
            
            $('#editProductoModal').modal('show');
        }
    })
    });
});

function registrarProducto(){
    $.ajax({
        url: 'productos/crearProducto',
        type: 'post',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: {
            Nombre:         $('#nameAdd').val(),
            Precio:         $('#priceAdd').val(),
            fechaRegistro:  $('#dateAdd').val(),
            stock:          $('#stockAdd').val()
        },
        success: function(response){
            if(response == 200){
                $('#addProductoModal').modal('hide');
                location.reload();
            }
        }
    })
}

function actualizarProducto(idEdit){
    $.ajax({
        url: 'productos/actualizarProducto',
        type: 'post',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: {
            id:             $('#idEdit').val(),
            Nombre:         $('#nameEdit').val(),
            Precio:         $('#priceEdit').val(),
            fechaRegistro:  $('#dateEdit').val(),
            stock:          $('#stockEdit').val()
        },
        success: function(response){
            if(response == 200){
                $('#editProductoModal').modal('hide');
                location.reload();
            }
        }
    })
};
$(document).ready(function(){
    $('.deleteProducto').click(function(){
        let idDelete = $(this).attr('value');
        if(idDelete != null){
            Swal.fire({
                title: '¿Estas seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: '¡Si, Eliminar!'
            })

            $.ajax({
                url: 'productos/eliminarProducto',
                type: 'get',
                dataType: 'json',
                data: {
                    idEliminar: idDelete
                },
                success: function(response){
                    if(response == 200){
                        Swal.fire(
                            'Eliminado!',
                            'El registro ha sido eliminado.',
                            'success'
                        )
                        location.reload();
                    }
                }
            });
        }
    });
});




</script>
</head>
<body>
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <h1 class="text-info titletable">Productos</h1>
                    <div class="col-xs-12">
                        <a href="#addProductoModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE145;</i> <span>Nuevo Registro</span></a>
                        <a href="#deleteProductoModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Eliminar</span></a>						
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Fecha Registro</th>
                        <th>Stock</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                    <tr>    
                        <td>{{$producto['PRODUC_NOMBRE']}}</td>
                        <td>${{$producto['PRODUC_PRECIO']}}</td>
                        <td>{{$producto['PRODUC_STOCK']}}</td>
                        <td>{{$producto['PRODUC_FEHCAREG']}}</td>
                        <td>
                            <a href="#editProductoModal"   value="{{$producto['PRODUC_ID']}}" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#deleteProductoModal"  value="{{$producto['PRODUC_ID']}}" class="deleteProducto" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE15C;</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="hint-text">Mostrando <b>5</b> de <b>25</b> registros</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Anterior</a></li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Siguiente</a></li>
                </ul>
            </div>
        </div>
    </div>       
	<!-- Edit Modal HTML -->

    <div id="addProductoModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="javascript:registrarProducto();" method="post">
					<div class="modal-header">						
						<h4 class="modal-title">Registrar Producto</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" id="nameAdd" required>
                        </div>
                        <div class="form-group">
                            <label>Precio</label>
                            <input type="number" class="form-control" id="priceAdd" required>
                        </div>
                        <div class="form-group">
                            <label>Fecha Registro</label>
                            <input type="date" class="form-control" id="dateAdd" required>
                        </div>
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" class="form-control" id="stockAdd" required>
                        </div>					
                    </div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal de edición -->
    <div class="editProductoModal"  class="modal fade">
        @include('modaledit', ['productos' => $productos])
    </div>
        
	<!-- Delete Modal HTML -->
	{{-- <div id="deleteProductoModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete">
					</div>
				</form>
			</div>
		</div>
	</div> --}}
</body>
</html>