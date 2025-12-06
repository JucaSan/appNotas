<?php

namespace App\Repositories\RH;

class notesRH 
{
    public function obtenerColumnas() {
        return [
            'id',
            'title',
            'content',
            'user_id',
            'is_important',
            'reminder_date',
            'metadata',
            'created_at',
            'updated_at'
        ];
    }

    public function obtenerFiltros($filters) {
        $where = [];

        if(!empty($filters['search'])) {
            $where[] = ['title', 'LIKE', "%{$filters['search']}%"];
        }

        if(!empty($filters['date_from'])) {
            $where[] = ['created_at', '>=', $filters['date_from']];
        }

        if(!empty($filters['date_to'])) {
            $where[] = ['created_at', '<=', $filters['date_to']];
        }

        return $where;
    }

    public function obtenerOrden($filters) {
        $columna = $filters['orden_columna'] ?? 'created_at';
        $direccion = $filters['orden_direccion'] ?? 'desc';

        return [$columna, $direccion];
    }


}