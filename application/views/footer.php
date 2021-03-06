<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

        </main><!-- #site-content -->

        <footer class="footer" style="background-color:#e7e7e7; height:50px; position: absolute; bottom: 0; width: 100%;" >
            <div class="container" style="padding-top:10px;">
                <div class="row">
                    <div class="col-sm-2 pull-right">
                        <a href="#">Hilfe</a>
                    </div>
                    <div class="col-sm-2 pull-right">
                        <a href="#">Impressum</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- js -->
        <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/jquery.stickyheader.js') ?>"></script>
        <script src="<?= base_url('assets/js/jquery.businessHours.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/jquery.ioslist.min.js') ?>"></script>

        <script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('assets/js/map_user_input.js') ?>"></script>
        <script type="text/javascript">
            ;(function( $, window, document, undefined ) {
                "use strict";
                $( document ).ready(function() {
                    $('#myTable').DataTable();
                    $('#username').mapUserName('#facility_name');
                    $('.stickytable').stickyTableHeaders();

                });

                <?php if (isset($current_view) && $current_view === 'match_view') : ?>
                $(".match_list").ioslist();
                <?php endif; ?>
            })( jQuery, window, window.document );
        </script>
    </body>
</html>