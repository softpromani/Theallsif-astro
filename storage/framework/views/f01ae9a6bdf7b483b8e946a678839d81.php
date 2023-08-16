<script src="<?php echo e(asset('assets/vendor/libs/jquery/jquery.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/popper/popper.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/js/bootstrap.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/node-waves/node-waves.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/hammer/hammer.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/i18n/i18n.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/typeahead-js/typeahead.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/js/menu.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/apex-charts/apexcharts.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/swiper/swiper.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>


<script src="<?php echo e(asset('assets/js/dashboards-analytics.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/app-user-list.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/ui-modals.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/forms-selects.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/forms-tagify.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/forms-typeahead.js')); ?>"></script>

<script src="<?php echo e(asset('assets/vendor/libs/select2/select2.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/tagify/tagify.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/typeahead-js/typeahead.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/bloodhound/bloodhound.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/js/template-customizer.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js')); ?>"></script>

<!-- Vendors JS -->
<script src="<?php echo e(asset('assets/vendor/libs/chartjs/chartjs.js')); ?>"></script>
<!-- Page JS -->
<script src="<?php echo e(asset('assets/js/charts-chartjs.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/flatpickr/flatpickr.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/forms-pickers.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/charts-apex.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/app-chat.js')); ?>"></script>

<script src="<?php echo e(asset('assets/vendor/libs/quill/katex.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/quill/quill.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/forms-editors.js')); ?>"></script>

<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>

<div id="template-customizer" class="invert-bg-white" style="visibility: visible">
    <?php
    $superadminId = session('superadmin_id');
    $eid=Crypt::encrypt($superadminId);
    ?>
    <a href="<?php echo e(route('admin.loginUsingId', $eid)); ?>" class="template-customizer-open-btn" tabindex="-1">
        <i class="menu-icon tf-icons ti ti-user" style="visibility: visible"></i>
    </a>

</div><?php /**PATH E:\Projects\Theallsif-astro\resources\views/admin/layouts/script.blade.php ENDPATH**/ ?>