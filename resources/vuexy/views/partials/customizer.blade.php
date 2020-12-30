{{-- BEGIN: Customizer --}}
<div class="customizer d-none d-md-block">

    <a class="customizer-toggle d-flex align-items-center justify-content-center" href="javascript:void(0);">
        <i class="spinner" data-feather="settings">
        </i>
    </a>

    <div class="customizer-content">
        <!-- Customizer header -->
        <div class="customizer-header px-2 pt-1 pb-0 position-relative">
            <h4 class="mb-0">Theme Customizer</h4>
            <p class="m-0">Customize & Preview in Real Time</p>

            <a class="customizer-close" href="javascript:void(0);"><i data-feather="x"></i></a>
        </div>

        <hr />

        <!-- Styling & Text Direction -->
        <div class="customizer-styling-direction px-2">
            <p class="font-weight-bold">Skin</p>
            <div class="d-flex">
                <div id="light-theme-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="skinlight" name="skinradio" class="custom-control-input layout-name"
                            checked data-layout="" />
                        <label class="custom-control-label" for="skinlight">Light</label>
                    </div>
                </div>
                <div id="bordered-theme-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="skinbordered" name="skinradio" class="custom-control-input layout-name"
                            data-layout="bordered-layout" />
                        <label class="custom-control-label" for="skinbordered">Bordered</label>
                    </div>
                </div>
                <div id="dark-theme-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="skindark" name="skinradio" class="custom-control-input layout-name"
                            data-layout="dark-layout" />
                        <label class="custom-control-label" for="skindark">Dark</label>
                    </div>
                </div>
            </div>
        </div>

        <hr />

        <!-- Menu -->
        <div class="customizer-menu px-2">
            <div id="customizer-menu-collapsible" class="d-flex">
                <p class="font-weight-bold mr-auto m-0">Collapsible</p>
                <div id="collapsible-button">
                    <div class="custom-control custom-control-primary custom-switch">
                        <input type="checkbox" class="custom-control-input" id="collapse-sidebar-switch"
                            data-status="off" />
                        <label class="custom-control-label" for="collapse-sidebar-switch"></label>
                    </div>
                </div>
            </div>
        </div>
        <hr />

        <!-- Layout Width -->
        <div class="customizer-footer px-2">
            <p class="font-weight-bold">Layout Width</p>
            <div class="d-flex">
                <div id="layout-full-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="layout-width-full" name="layoutWidth" class="custom-control-input"
                            checked />
                        <label class="custom-control-label" for="layout-width-full">Full Width</label>
                    </div>
                </div>
                <div id="layout-boxed-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="layout-width-boxed" name="layoutWidth" class="custom-control-input" />
                        <label class="custom-control-label" for="layout-width-boxed">Boxed</label>
                    </div>
                </div>
            </div>
        </div>
        <hr />

        <!-- Navbar -->
        <div class="customizer-navbar px-2">
            <div id="customizer-navbar-colors">
                <p class="font-weight-bold">Navbar Color</p>
                <ul class="list-inline unstyled-list">
                    <li class="color-box bg-white border selected" data-navbar-default="" data-color="bg-white">
                    </li>
                    <li class="color-box bg-primary" data-navbar-color="bg-primary" data-color="bg-primary">
                    </li>
                    <li class="color-box bg-secondary" data-navbar-color="bg-secondary" data-color="bg-secondary">
                    </li>
                    <li class="color-box bg-success" data-navbar-color="bg-success" data-color="bg-success">
                    </li>
                    <li class="color-box bg-danger" data-navbar-color="bg-danger" data-color="bg-danger">
                    </li>
                    <li class="color-box bg-info" data-navbar-color="bg-info" data-color="bg-info">
                    </li>
                    <li class="color-box bg-warning" data-navbar-color="bg-warning" data-color="bg-warning">
                    </li>
                    <li class="color-box bg-dark" data-navbar-color="bg-dark" data-color="bg-dark">
                    </li>
                </ul>
            </div>

            <p class="navbar-type-text font-weight-bold">Navbar Type</p>
            <div class="d-flex">
                <div id="nav-floating-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="nav-type-floating" name="navType" class="custom-control-input"
                            checked />
                        <label class="custom-control-label" for="nav-type-floating">Floating</label>
                    </div>
                </div>
                <div id="nav-sticky-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="nav-type-sticky" name="navType" class="custom-control-input" />
                        <label class="custom-control-label" for="nav-type-sticky">Sticky</label>
                    </div>
                </div>
                <div class="mr-1" id="nav-static-button">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="nav-type-static" name="navType" class="custom-control-input" />
                        <label class="custom-control-label" for="nav-type-static">Static</label>
                    </div>
                </div>
                <div class="mr-1" id="nav-hidden-button">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="nav-type-hidden" name="navType" class="custom-control-input" />
                        <label class="custom-control-label" for="nav-type-hidden">Hidden</label>
                    </div>
                </div>
            </div>
        </div>
        <hr />

        <!-- Footer -->
        <div class="customizer-footer px-2">
            <p class="font-weight-bold">Footer Type</p>
            <div class="d-flex">
                <div id="footer-sticky-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="footer-type-sticky" name="footerType" class="custom-control-input" />
                        <label class="custom-control-label" for="footer-type-sticky">Sticky</label>
                    </div>
                </div>
                <div id="footer-static-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="footer-type-static" name="footerType" class="custom-control-input"
                            checked />
                        <label class="custom-control-label" for="footer-type-static">Static</label>
                    </div>
                </div>
                <div id="footer-hidden-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="footer-type-hidden" name="footerType" class="custom-control-input" />
                        <label class="custom-control-label" for="footer-type-hidden">Hidden</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- End: Customizer --}}
<script defer>
    const ready = ($) => {

        const registerNavigationButtons = ($) => {
            $('#nav-float-button').click((e) => {
                $.post("{{ route('user.settings.store') }}", {
                    key: 'nav-layout',
                    value: 'floating',
                    "_token": "{{ csrf_token() }}",
                });
            });

            $('#nav-sticky-button').click((e) => {
                $.post("{{ route('user.settings.store') }}", {
                    key: 'nav-layout',
                    value: 'sticky',
                    "_token": "{{ csrf_token() }}",
                });
            });

            $('#nav-static-button').click((e) => {
                $.post("{{ route('user.settings.store') }}", {
                    key: 'nav-layout',
                    value: 'static',
                    "_token": "{{ csrf_token() }}",
                });
            });

            $('#nav-hidden-button').click((e) => {
                $.post("{{ route('user.settings.store') }}", {
                    key: 'nav-layout',
                    value: 'hidden',
                    "_token": "{{ csrf_token() }}",
                });
            });
        }

        const registerThemeModes = ($) => {
            $('#light-theme-button').click((e) => {
                $.post("{{ route('user.settings.store') }}", {
                    key: 'theme-mode',
                    value: 'light',
                    "_token": "{{ csrf_token() }}",
                });
            });

            $('#dark-theme-button').click((e) => {
                $.post("{{ route('user.settings.store') }}", {
                    key: 'theme-mode',
                    value: 'dark',
                    "_token": "{{ csrf_token() }}",
                });
            });

            $('#bordered-theme-button').click((e) => {
                $.post("{{ route('user.settings.store') }}", {
                    key: 'theme-mode',
                    value: 'bordered',
                    "_token": "{{ csrf_token() }}",
                });
            });
        }

        const registerFooterButtons = ($) => {
            $('#footer-sticky-button').click((e) => {
                $.post("{{ route('user.settings.store') }}", {
                    key: 'footer-layout',
                    value: 'sticky',
                    "_token": "{{ csrf_token() }}",
                });
            });

            $('#footer-static-button').click((e) => {
                $.post("{{ route('user.settings.store') }}", {
                    key: 'footer-layout',
                    value: 'static',
                    "_token": "{{ csrf_token() }}",
                });
            });


            $('#footer-hidden-button').click((e) => {
                $.post("{{ route('user.settings.store') }}", {
                    key: 'footer-layout',
                    value: 'hidden',
                    "_token": "{{ csrf_token() }}",
                });
            });
        };

        const registerLayoutButtons = ($) => {
            $('#layout-full-button').click(() => {
                $.post("{{ route('user.settings.store') }}", {
                    key: 'layout-mode',
                    value: 'full',
                    "_token": "{{ csrf_token() }}",
                });
            });

            $('#layout-boxed-button').click(() => {
                $.post("{{ route('user.settings.store') }}", {
                    key: 'layout-mode',
                    value: 'boxed',
                    "_token": "{{ csrf_token() }}",
                });
            });
        };

        const registerSolos = ($) => {
            (() => {
                let running = false;
                $('#collapsible-button').click((e) => {
                    e.stopImmediatePropagation();
                    if (!running) {
                        running = true;
                    } else {
                        return;
                    }
                    const mode = $('#collapse-sidebar-switch').attr('data-status') === 'off' ?
                        'on' : 'off';
                    $('#collapse-sidebar-switch').attr('data-status', mode);
                    $.post("{{ route('user.settings.store') }}", {
                        key: 'collapsible-mode',
                        value: mode,
                        "_token": "{{ csrf_token() }}",
                    }, () => (running = false));
                });
            })();

            $('.color-box').click(function() {
                $.post("{{ route('user.settings.store') }}", {
                    key: 'navbar-color',
                    value: $(this).attr('data-color'),
                    "_token": "{{ csrf_token() }}",
                });
            });
        }

        const sync = (done) => {
            $.get("{{ route('user.settings.index') }}", data => {
                data.forEach(({
                    key,
                    value
                }) => {
                    if (key === 'nav-layout') {
                        switch (value) {
                            case 'floating':
                                $('#nav-float-button').children().children()[0].click();
                                break;
                            case 'sticky':
                                $('#nav-sticky-button').children().children()[0].click();
                                break;
                            case 'static':
                                $('#nav-static-button').children().children()[0].click();
                                break;
                            case 'hidden':
                                $('#nav-hidden-button').children().children()[0].click();
                                break;
                        }
                    }
                    if (key === 'footer-layout') {
                        console.log($(`#footer-type-${value}`));
                        $(`#footer-type-${value}`).click();
                    }
                    if (key === 'navbar-color') {
                        $(`.color-box.${value}`).click();
                    }
                    if (key === 'layout-mode') {
                        $(`#layout-width-${value}`).click();
                    }
                    if (key === 'theme-mode') {
                        $(`#skin${value}`).click();
                    }
                    if (key === 'collapsible-mode') {
                        if (value === 'on') {
                            setTimeout(() => {

                            }, 15000);
                        }
                    }
                });
                done();
            }, 'json');
        };

        sync(() => {
            registerNavigationButtons($);
            registerThemeModes($);
            registerFooterButtons($);
            registerLayoutButtons($);
            registerSolos($);

            // remove loading screen
            $('#loading-content').remove();

            // show content
            $('#main-content-wrapper').removeClass('d-none');
        });
    };

    // polyfill wait for jQuery to load
    let handle;
    handle = setInterval(() => {
        if (window.$) {
            clearInterval(handle);
            window.$(document).ready(() => ready(window.$));
        }
    }, 1);

</script>
