<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index(){
        $productos = Producto::all()->where('PRODUC_ID', '>', 0);

        view()->share('productos', $productos);
        return view('productos');
    }

    public function nextId(){
        $productos = Producto::all();
        $id = $productos->last()->PRODUC_ID + 1;
        return $id;
    }

    public function crearProducto(){

        $producto = [
            'PRODUC_ID'         => $this->nextId(),
            'PRODUC_NOMBRE'     => $_POST['Nombre'],
            'PRODUC_PRECIO'     => $_POST['Precio'],
            'PRODUC_STOCK'      => $_POST['stock'],
            'PRODUC_FEHCAREG'   => $_POST['fechaRegistro'],
        ];

        Producto::insertData($producto);
  
        return json_encode(200, true);
    }

    public function actualizarProducto(){
     
        $producto = [
            'PRODUC_ID'         => $_POST['id'],
            'PRODUC_NOMBRE'     => $_POST['Nombre'],
            'PRODUC_PRECIO'     => $_POST['Precio'],
            'PRODUC_STOCK'      => $_POST['stock'],
            'PRODUC_FEHCAREG'   => $_POST['fechaRegistro'],
        ];

        Producto::updateData($producto);
  
        return json_encode(200, true);
    }

    public function editarProducto(){

        $idEdit = request()->input('id');
        $productoIndividual = Producto::getProducto($idEdit);

        return $productoIndividual;
    }

    public function eliminarProducto(Request $request){
        $idEliminar = $request->query('idEliminar');

         Producto::deleteProducto($idEliminar);
        
        return json_encode(200, true);
    }
}
