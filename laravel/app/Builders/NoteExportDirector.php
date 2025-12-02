<?php

namespace App\Builders;

class NoteExportDirector
{
    public function build(string $style, array $note): array
    {
        $builder = new NoteExportBuilder();

        $builder->reset();

        $builder->addBasicInfo($note);

        if ($style !== 'simple') {
            $builder->addAuthor($note);
            $builder->addTimestamps($note);
        }

        if ($style === 'advanced') {
            $builder->addFlags($note);
        }

        return $builder->getResult();
    }
}
