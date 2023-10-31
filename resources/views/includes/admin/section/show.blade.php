<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <h1>Section {{ $section->name }}</h1>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-warning">Edit
                Section</a>
        </div>
    </div>
    <div class="accordion" id="mainAccordion">

        <div class="card">
            <div class="card-header" id="sectionDetailsHeading">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#sectionDetails"
                            aria-expanded="true" aria-controls="sectionDetails">
                        Section Details
                    </button>
                </h5>
            </div>

            <div id="sectionDetails" class="collapse show" aria-labelledby="sectionDetailsHeading"
                 data-parent="#mainAccordion">
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>ID:</strong> {{ $section->id }}</li>
                        <li class="list-group-item"><strong>Name:</strong> {{ $section->name }}</li>
                        <li class="list-group-item"><strong>Page:</strong> {{ $section->page->name }}</li>
                        <li class="list-group-item"><strong>Order:</strong> {{ $section->order }}</li>
                    </ul>
                </div>
            </div>
        </div>

        @if($section->sectionContent)
            <div class="card">
                <div class="card-header" id="contentDetailsHeading">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#contentDetails" aria-expanded="false" aria-controls="contentDetails">
                            Content Details
                        </button>
                    </h5>
                </div>
                <div id="contentDetails" class="collapse" aria-labelledby="contentDetailsHeading"
                     data-parent="#mainAccordion">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Font:</strong> {{ $section->sectionContent->font }}</li>
                            <li class="list-group-item"><strong>Font
                                    Color:</strong> {{ $section->sectionContent->font_color }}</li>
                            <li class="list-group-item"><strong>Background
                                    Color:</strong> {{ $section->sectionContent->background_color }}</li>
                            <li class="list-group-item">
                                <strong>Background Image:</strong><br>
                                <img src="{{ asset($section->sectionContent->background_image) }}"
                                     alt="Background Image"
                                     width="200" class="img-thumbnail">
                            </li>
                            <li class="list-group-item"><strong>Title:</strong> {{ $section->sectionContent->title }}
                            </li>
                            <li class="list-group-item">
                                <strong>Description:</strong> {{ $section->sectionContent->description }}
                            </li>
                            <li class="list-group-item"><strong>Content
                                    Text:</strong> {{ $section->sectionContent->content_text }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @if($section->components)
            <div class="card">
                <div class="card-header" id="componentsHeading">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#components" aria-expanded="false" aria-controls="components">
                            Components
                        </button>
                    </h5>
                </div>
                <div id="components" class="collapse" aria-labelledby="componentsHeading"
                     data-parent="#mainAccordion">
                    <div class="card-body">
                        @foreach($section->components as $component)
                            {{--                                @dd($component->details)--}}
                            <li class="list-group-item">
                                <strong>Type:</strong> {{ $component->type }}<br>
                                {{--                                    <strong>Details:</strong> {{ $component->details->value }}--}}
                            </li>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if($section->sectionComponents)
            @foreach($section->sectionComponents as $sectionComponent)
                <div class="row">
                    @include('sectionComponents.admin.'.$sectionComponent->template_name)
                </div>
            @endforeach
        @endif
        {{--            @if($section->sectionComponents)--}}
        {{--                {{ $section->sectionComponents }}--}}
        {{--                <div class="card">--}}
        {{--                    <div class="card-header" id="componentsHeading">--}}
        {{--                        <h5 class="mb-0">--}}
        {{--                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"--}}
        {{--                                    data-target="#components" aria-expanded="false" aria-controls="components">--}}
        {{--                                Components--}}
        {{--                            </button>--}}
        {{--                        </h5>--}}
        {{--                    </div>--}}
        {{--                    <div id="components" class="collapse" aria-labelledby="componentsHeading"--}}
        {{--                         data-parent="#mainAccordion">--}}
        {{--                        <div class="card-body">--}}
        {{--                            @foreach($section->sectionComponents as $component)--}}
        {{--                                <li class="list-group-item">--}}
        {{--                                    <strong>Name:</strong> {{ $component->name }}<br>--}}
        {{--                                    <strong>Details:</strong> {{ $component->details[0]['value'] }}--}}
        {{--                                </li>--}}
        {{--                                <li class="list-group-item">--}}
        {{--                                    <strong>Type:</strong> {{ $component->type }}<br>--}}
        {{--                                    <strong>Details:</strong> {{ $component->details[0]['value'] }}--}}
        {{--                                </li>--}}
        {{--                            @endforeach--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            @endif--}}

    </div>
</div>
