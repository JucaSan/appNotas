<?php

namespace App\Factories;

use Illuminate\Http\Request;
use App\Models\User;

class NoteFactory
{
    private static function resolveType(Request $request):string 
    {
        if($request->reminder_date) return 'reminder';
        if($request->has('is_important')) return 'important';
        return 'normal';
    }

    public static function createDataFromRequest(Request $request, User $user): array
    {
        $type = self::resolveType($request);

        return [
            'title'         => $request->title,
            'content'       => $request->content,
            'user_id'       => $user->id,
            'type'          => $type,
            'is_important'  => $request->has('is_important') ? 1 : 0,
            'reminder_date' => $request->reminder_date,
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }

    
    public static function updateDataFromRequest(Request $request): array
    {
        $type = self::resolveType($request);

        return [
            'title'         => $request->title,
            'content'       => $request->content,
            'type'          => $type,
            'is_important'  => $request->has('is_important') ? 1 : 0,
            'reminder_date' => $request->reminder_date,
            'updated_at'    => now(),
        ];
    }
}
