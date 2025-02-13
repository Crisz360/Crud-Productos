<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'PRODUC_ID';
    public $timestamps = false;

    protected $fillable = [
        'PRODUC_NOMBRE',
        'PRODUC_PRECIO',
        'PRODUC_STOCK',
        'PRODUC_FEHCAREG',
    ];

    public function __construct()
    {
        parent::__construct();

    }


    static public function getProducto($id){
        return self::where('PRODUC_ID', $id)->first();
    }

    static public function deleteProducto($id){
        return self::where('PRODUC_ID', $id)->delete();
    }

    static public function insertData($data){
        $fecha = date('Y-m-d H:i:s', strtotime($data['PRODUC_FEHCAREG']));
        $sql = "INSERT INTO productos (PRODUC_ID, PRODUC_NOMBRE, PRODUC_PRECIO, PRODUC_STOCK, PRODUC_FEHCAREG) 
        VALUES ($data[PRODUC_ID], '$data[PRODUC_NOMBRE]', $data[PRODUC_PRECIO], $data[PRODUC_STOCK], '$fecha')";
        return DB::insert($sql);
    }

    static public function updateData($data){
     
        $fecha = date('Y-m-d H:i:s', strtotime($data['PRODUC_FEHCAREG']));
        $sql = "UPDATE productos SET PRODUC_NOMBRE = '$data[PRODUC_NOMBRE]', PRODUC_PRECIO = $data[PRODUC_PRECIO], 
        PRODUC_STOCK = $data[PRODUC_STOCK], PRODUC_FEHCAREG = '$fecha' WHERE PRODUC_ID = $data[PRODUC_ID]";
        return DB::update($sql);
    }
}


