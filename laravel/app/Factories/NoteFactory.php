<?php

namespace App\Factories;

use Illuminate\Http\Request;

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
