{{-- <h1> Frontend template for form </h1>
<h1> Frontend template for FORM </h1>

@php
    use Kris\LaravelFormBuilder\FormBuilder;
    use App\Forms\ApplicationForm;
    $form_id = $sectionComponent->componentData->first();
    $formBuilder = app(FormBuilder::class);
    $formTemplate = $formBuilder->create(ApplicationForm::class, [
        'data' => ['formId' => $form_id->dataable_id ?? 1]
    ]);
@endphp

@if($form_id)
    {!! form($formTemplate) !!}
@endif --}}
