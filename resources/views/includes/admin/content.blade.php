{{--<div--}}
{{--    class="content-wrapper iframe-mode bg-dark"--}}
{{--    data-widget="iframe"--}}
{{--    data-auto-dark-mode="true"--}}
{{--    data-loading-screen="750">--}}

{{--    <div class="nav navbar navbar-expand-lg navbar-dark border-bottom border-dark p-0">--}}
{{--        <div class="nav-item">--}}
{{--            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>--}}
{{--        </div>--}}
{{--        <a class="nav-link bg-danger" href="#" data-widget="iframe-close">Close</a>--}}
{{--        <a class="nav-link bg-dark" href="#" data-widget="iframe-scrollleft"><i--}}
{{--                class="fas fa-angle-double-left"></i></a>--}}
{{--        <ul class="navbar-nav" role="tablist">--}}
{{--        </ul>--}}
{{--        <a class="nav-link bg-dark" href="#" data-widget="iframe-fullscreen"><i class="fas fa-expand"></i></a>--}}
{{--    </div>--}}
{{--    <div class="tab-content">--}}
{{--        <div class="tab-empty">--}}
{{--            <h2 class="display-4">No tab selected!</h2>--}}
{{--        </div>--}}
{{--        <div class="tab-loading">--}}
{{--            <div>--}}
{{--                <h2 class="display-4">Tab is loading <i class="fa fa-sync fa-spin"></i></h2>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
    <div class="nav navbar navbar-expand-lg navbar-white navbar-light border-bottom p-0">
        <a class="nav-link bg-danger" href="#" data-widget="iframe-close">Close</a>
        <a class="nav-link bg-light" href="#" data-widget="iframe-scrollleft">
            <i
                class="fas fa-angle-double-left">

            </i>
        </a>
        <ul class="navbar-nav" role="tablist">
            <li class="nav-item active" role="presentation">
                <a class="nav-link active"
                   data-toggle="row"
                   id="tab-index"
                   href="#panel-index" role="tab"
                   aria-controls="panel-index" aria-selected="true">All pages
                </a>
            </li>
        </ul>
        <a class="nav-link bg-light" href="#" data-widget="iframe-scrollright"><i class="fas fa-angle-double-right"></i></a>
        <a class="nav-link bg-light" href="#" data-widget="iframe-fullscreen"><i class="fas fa-expand"></i></a>
    </div>
    <div class="tab-content">
        <div
            class="tab-pane fade active show"
            id="panel-index"
            role="tabpanel"
            aria-labelledby="tab-index">
            <iframe src="{{ route('admin.page.index') }}"
                    style="height: 671px;">

            </iframe>
        </div>
        <div class="tab-empty">
            <h2 class="display-4">No tab selected!</h2>
        </div>
        <div class="tab-loading">
            <div>
                <h2 class="display-4">Tab is loading <i class="fa fa-sync fa-spin"></i></h2>
            </div>
        </div>
    </div>
</div>
