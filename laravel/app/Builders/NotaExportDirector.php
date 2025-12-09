<?php

namespace App\Builders;

class NotaExportDirector
{
    public function build(string $style, array $note): array
    {
        $builder = new NotaExportBuilder();

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
