<!DOCTYPE html>
<html class="st-layout ls-top-navbar show-sidebar sidebar-l2 ls-bottom-footer" lang="fr">
    @include('layout._head')
    <body>
        <div class="st-container">
            @include('layout._navbar')
            @include('layout._sidebar')
                <div class="st-pusher" id="content">
                    <div class="st-content">
                        <div class="st-content-inner">
                            <div class="container-fluid">

                                @yield('content')

                            </div>
                        </div>
                    </div>
                </div>
            @include('layout._footer')
        </div>
    </body>
</html>