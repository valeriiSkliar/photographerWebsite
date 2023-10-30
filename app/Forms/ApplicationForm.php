<?php

namespace App\Forms;

use App\Models\FormField;
use Kris\LaravelFormBuilder\Form;


class ApplicationForm extends Form
{
    public function buildForm()
    {

        $formId = $this->getData('formId');

        $formFields = FormField::where('form_id', $formId)->get();

        foreach ($formFields as $field) {
            $attributes = [
                'label' => $field->label,
                'attr' => ['placeholder' => $field->placeholder]
            ];

            if ($field->type === 'number') {
                $attributes['attr']['min'] = 0;
            }

            $this->add($field->name, $field->type, $attributes);
        }

        if (!$this->has('submit')) {
            $this->add('submit', 'submit', [
                'label' => 'Send'
            ]);
        }


//        $this
//            ->add('service', 'text', [
//                'label' => 'Service:',
//                'attr' => ['placeholder' => '']
//            ])
//            ->add('name', 'text', [
//                'label' => 'Name:',
//                'attr' => ['placeholder' => '']
//            ])
//            ->add('surname', 'text', [
//                'label' => 'Surname:',
//                'attr' => ['placeholder' => '']
//            ])
//            ->add('phone', 'text', [
//                'label' => 'Phone:',
//                'attr' => ['placeholder' => '']
//            ])
//            ->add('day', 'number', [
//                'label' => 'Day:',
//                'attr' => ['placeholder' => '']
//            ])
//            ->add('month', 'number', [
//                'label' => 'Month:',
//                'attr' => ['placeholder' => '']
//            ])
//            ->add('year', 'number', [
//                'label' => 'Year:',
//                'attr' => ['placeholder' => '']
//            ])
//            ->add('submit', 'submit', [
//                'label' => 'Send'
//            ]);
    }
}
