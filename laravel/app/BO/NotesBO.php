<?php
namespace App\BO;

class NotesBO
{
    public function buildForCreate($request) 
    {
        return [
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user_id,
            'reminder_date' => $request->reminder_date,
            'metadata' => json_encode([
                'export_style' => $request->export_style ?? 'simple'
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function buildForUpdate($request)
    {
        return [
            'title' => $request->title,
            'content' => $request->content,
            'reminder_date' => $request->reminder_date,
            'metadata' => json_encode([
                'export_style' => $request->export_style ?? 'simple'
            ]),
            'updated_at' => now(),
        ];
    }
}