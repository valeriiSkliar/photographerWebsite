<?php

namespace App\Forms;

use App\Models\Album;
use Kris\LaravelFormBuilder\Form;

class ComponentData extends Form
{
    public function buildForm()
    {

        $allAlbums =  Album::getIdNameArray();

        $this
            ->add('field_name')
            ->add('field_value')
            ->add('album_id', 'select', [
                'choices' => $allAlbums,
                'empty_value' => '=== Select album ==='
            ])
            ->add('submit', 'submit', ['label' => 'Add']);
    }
}
