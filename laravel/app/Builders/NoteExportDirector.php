<?php

namespace App\Builders;

class NoteExportDirector
{
    public function buildSimple(NoteExportBuilderInterface $builder, array $note)
    {
        $builder->reset();
        $builder->addBasicInfo($note);
        return $builder->getResult();
    }

    public function buildIntermediate(NoteExportBuilderInterface $builder, array $note)
    {
        $builder->reset();
        $builder->addBasicInfo($note);
        $builder->addAuthor($note);
        $builder->addTimestamps($note);
        return $builder->getResult();
    }

    public function buildAdvanced(NoteExportBuilderInterface $builder, array $note)
    {
        $builder->reset();
        $builder->addBasicInfo($note);
        $builder->addAuthor($note);
        $builder->addTimestamps($note);
        $builder->addFlags($note);
        return $builder->getResult();
    }
}
