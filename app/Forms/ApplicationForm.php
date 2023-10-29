<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ApplicationForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('service', 'text', [
                'label' => 'Service:',
                'attr' => ['placeholder' => '']
            ])
            ->add('name', 'text', [
                'label' => 'Name:',
                'attr' => ['placeholder' => '']
            ])
            ->add('surname', 'text', [
                'label' => 'Surname:',
                'attr' => ['placeholder' => '']
            ])
            ->add('phone', 'text', [
                'label' => 'Phone:',
                'attr' => ['placeholder' => '']
            ])
            ->add('day', 'number', [
                'label' => 'Day:',
                'attr' => ['placeholder' => '']
            ])
            ->add('month', 'number', [
                'label' => 'Month:',
                'attr' => ['placeholder' => '']
            ])
            ->add('year', 'number', [
                'label' => 'Year:',
                'attr' => ['placeholder' => '']
            ])
            ->add('submit', 'submit', [
                'label' => 'Send'
            ]);
    }
}
