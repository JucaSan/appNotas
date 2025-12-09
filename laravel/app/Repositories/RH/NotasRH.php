<?php

namespace App\Repositories\RH;

class NotasRH 
{
    public function obtenerColumnas(&$query, string $columnasString)
    {
        // $columnasvalor = [
        //     'es_activo' => 'n.is_active'
        // ]
        $columnas = array_map('trim', explode(',', $columnasString));
        $query->select($columnas);
    }

    public function obtenerFiltros(&$query, $filters)
    {
        if (!empty($filters['search'])) {
            $query->where('title', 'LIKE', '%'.$filters['search'].'%');
        }

        if (!empty($filters['date_from'])) {
            $query->where('created_at', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->where('created_at', '<=', $filters['date_to']);
        }
    }


    public function obtenerOrden(&$query, $filters)
    {
        $columna = $filters['orden_columna'] ?? 'created_at';
        $direccion = $filters['orden_direccion'] ?? 'desc';

        $query->orderBy($columna, $direccion);
    }


}