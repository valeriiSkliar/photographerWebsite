<div
    class="content-wrapper iframe-mode bg-dark"
    data-widget="iframe"
    data-auto-dark-mode="true"
    data-loading-screen="750">
    <div class="nav navbar navbar-expand-lg navbar-dark border-bottom border-dark p-0">
        <a class="nav-link bg-danger" href="#" data-widget="iframe-close">Close</a>
        <a class="nav-link bg-dark" href="#" data-widget="iframe-scrollleft"><i class="fas fa-angle-double-left"></i></a>
        <ul class="navbar-nav" role="tablist">
        </ul>
        <a class="nav-link bg-dark" href="#" data-widget="iframe-scrollright"><i class="fas fa-angle-double-right"></i></a>
        <a class="nav-link bg-dark" href="#" data-widget="iframe-fullscreen"><i class="fas fa-expand"></i></a>
    </div>
    <div class="tab-content">
{{--        <iframe src="{{ route('iframe.content') }}" width="100%" height="100%"></iframe>--}}
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
