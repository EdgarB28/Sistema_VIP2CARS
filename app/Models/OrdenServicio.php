<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenServicio extends Model
{   
    protected $primaryKey = 'id';
    protected $table = 'ordenes_servicio';

    protected $fillable = [
        'id_cliente',
        'id_vehiculo',
        'descripcion',
        'estado',
        'total_mano_obra',
        'total_repuestos',
        'total',
        'fecha_ingreso',
        'fecha_salida'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }
}
