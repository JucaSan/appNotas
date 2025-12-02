<?php

namespace App\Factories;

use Illuminate\Http\Request;
use App\Models\User;

class NoteFactory
{
    public static function make(Request $request): NoteTypeInterface
    {
        if ($request->reminder_date) {
            return new ReminderNote();
        }

        if ($request->has('is_important')) {
            return new ImportantNote();
        }

        return new NormalNote();
    }
}
