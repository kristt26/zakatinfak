<!DOCTYPE html>
<html lang="en" ng-app="apps" ng-controller="indexController" ng-cloak>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="/assets/img/baznas.png" rel="icon">
    <title>SIPDZIS Papua</title>
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/ruang-admin.min.css" rel="stylesheet">
    <link href="/libs/angular-datatables/dist/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <style>
        .table-xs {
            font-size: 0.80rem;
            /* 12px */
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?= view('layout/admin/menu') ?>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->

                <?= view('layout/admin/header') ?>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">{{header}}</h1>
                    </div>

                    <?= $this->renderSection('content') ?>

                    <!-- Modal Logout -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin keluar?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                                    <a href="/auth/logout" class="btn btn-primary">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!---Container Fluid-->
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>copyright &copy; <script>
                                document.write(new Date().getFullYear());
                            </script> - developed by
                            <b><a href="" target="_blank">Sistem Informasi Zakat, Infak dan Sedekah</a></b>
                        </span>
                    </div>
                </div>
            </footer>
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/libs/angular/angular.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/assets/vendor/select2/dist/js/select2.min.js"></script>
    <!-- Bootstrap Datepicker -->
    <script src="/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap Touchspin -->
    <script src="/assets/vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
    <!-- ClockPicker -->
    <script src="/assets/vendor/clock-picker/clockpicker.js"></script>
    <!-- RuangAdmin Javascript -->
    <script src="/assets/js/ruang-admin.min.js"></script>

    <script src="/js/apps.js"></script>
    <script src="/libs/angular/angular-sanitize.min.js"></script>
    <script src="/libs/angular/angular-ui-router.min.js"></script>
    <script src="/libs/angular/angular-animate.min.js"></script>
    <!-- <script src="/js/apps.js"></script> -->
    <script src="/js/services/helper.services.js"></script>
    <script src="/js/services/auth.services.js"></script>
    <script src="/js/services/admin.services.js"></script>
    <script src="/js/services/pesan.services.js"></script>
    <script src="/js/controllers/admin.controllers.js"></script>
    <script src="/libs/angular-ui-select2/src/select2.js"></script>
    <script src="/libs/angular-datatables/dist/angular-datatables.js"></script>
    <script src="/libs/angular-locale_id-id.js"></script>
    <script src="/libs/input-mask/angular-input-masks-standalone.min.js"></script>
    <script src="/libs/jquery.PrintArea.js"></script>
    <script src="/libs/angular-base64-upload/dist/angular-base64-upload.min.js"></script>
    <script src="/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="/libs/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="/libs/datatables/btn.js"></script>
    <script src="/libs/datatables/print.js"></script>
    <script src="/libs/loading/dist/loadingoverlay.min.js"></script>
    <script src="/libs/angularjs-currency-input-mask/dist/angularjs-currency-input-mask.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    <!-- Tambahkan JS Select2 -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> -->
    <script src="/libs/select2/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/rv9fpjih10cz06opokn2wzy9zina5xksqeku4a1vitllucut/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

</body>

</html>