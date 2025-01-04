<!doctype html>
<html lang="en" data-bs-theme="auto">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Meta tags -->
        <meta name="description" content="">
        <!-- <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors"> -->
        <!-- <meta name="generator" content="Hugo 0.122.0"> -->
        <title><?=$this->renderSection('titlePage');?> · Saunglebe</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

        <!-- Bootstrap core CSS -->
        <link href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">

        <!-- Favicons -->
        <!-- <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
        <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
        <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
        <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
        <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
        <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
        <meta name="theme-color" content="#712cf9"> -->

        <!-- FontAwesome -->
        <link rel="stylesheet" href="<?=base_url('assets/vendor/fontawesome-free/css/all.min.css');?>">

        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

        <!-- DataTable CSS -->
        <link rel="stylesheet" href="<?=base_url('assets/vendor/datatables/datatables.min.css');?>">

        <!-- simple-notify -->
        <link rel="stylesheet" href="<?=base_url('assets/vendor/simple-notify/dist/simple-notify.min.css');?>">

        <!-- sweetalert -->
        <link id="sweetalert2" rel="stylesheet"
            href="<?=base_url('assets/vendor/sweetalert/dist/sweetalert2.min.css');?>">

        <!-- daterangepicker -->
        <link rel="stylesheet" href="<?=base_url('assets/vendor/daterangepicker/daterangepicker.css');?>">

        <!-- Custom JS -->
        <script src="<?=base_url('assets/script.js');?>"></script>

        <!-- Custom CSS -->
        <link rel="stylesheet" href="<?=base_url('assets/style.css');?>">

    </head>

    <body>
        <!-- Icon SVG for dark mode toggle -->
        <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
            <symbol id="check2" viewBox="0 0 16 16">
                <path
                    d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
            </symbol>
            <symbol id="circle-half" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
            </symbol>
            <symbol id="moon-stars-fill" viewBox="0 0 16 16">
                <path
                    d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
                <path
                    d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
            </symbol>
            <symbol id="sun-fill" viewBox="0 0 16 16">
                <path
                    d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
            </symbol>
        </svg>

        <!-- Navbar section start -->
        <?=$this->include('layouts/includes/navbar');?>
        <!-- Navbar section end -->

        <div class="container-fluid h-100">
            <div class="row h-100">
                <!-- Sidebar section start -->
                <?=$this->include('layouts/includes/sidemenu');?>
                <!-- Sidebar section end -->

                <!-- Main content section start -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pb-md-4 mb-md-4">
                    <?=$this->renderSection('content');?>
                </main>
                <!-- Main content section end -->
            </div>
        </div>

        <!-- Jquery -->
        <script src="<?=base_url('assets/vendor/jquery/jquery.min.js');?>"></script>
        <!-- Bootstrap core JavaScript -->
        <script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
        <!-- DataTable JS -->
        <script src="<?=base_url('assets/vendor/datatables/datatables.min.js');?>"></script>
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
        <!-- simple-notify -->
        <script src="<?=base_url('assets/vendor/simple-notify/dist/simple-notify.min.js');?>"></script>
        <!-- sweetalert -->
        <script src="<?=base_url('assets/vendor/sweetalert/dist/sweetalert2.all.min.js');?>"></script>
        <!-- daterangepicker -->
        <script src="<?=base_url('assets/vendor/daterangepicker/moment.min.js');?>"></script>
        <script src="<?=base_url('assets/vendor/daterangepicker/daterangepicker.js');?>"></script>

        <!-- Custom script -->
        <script type="module">
        import language from '<?=base_url('assets/vendor/datatables/i18n/indonesian.mjs');?>'
        $(document).ready(function() {
            // DataTable
            $('#dataTable').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: language
            });

            // Date Range Picker
            $('.daterange').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });
        });
        </script>
        <?=$this->include('layouts/includes/alert-message');?>

        <?=$this->renderSection('script');?>
    </body>

</html>