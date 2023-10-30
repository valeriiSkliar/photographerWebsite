<?php

namespace App\Forms;

use App\Models\Album;
use Kris\LaravelFormBuilder\Form;

class ComponentData extends Form
{
    public function buildForm()
    {

        $allAlbums =  Album::getIdNameArray();
        $availableForms =  \App\Models\Form::getIdNameArray();

        $this
            ->add('field_name')
            ->add('field_value')
//            ->add('add_form', 'checkbox', [
//                'value' => 'add',
//                'checked' => false
//            ])
            ->add('album_id', 'select', [
                'choices' => $allAlbums,
                'empty_value' => '=== Select album ==='
            ])
            ->add('form_id', 'select', [
                'choices' => $availableForms,
                'empty_value' => '=== Select form ==='
            ])
            ->add('submit', 'submit', ['label' => 'Add']);
    }
}
