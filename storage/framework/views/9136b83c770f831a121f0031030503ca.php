<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="index.html" class="app-brand-link">
      <span class="app-brand-logo demo">
        <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0" />
          <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
          <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
          <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0" />
        </svg>
      </span>
      <span class="app-brand-text demo menu-text fw-bold">Astrology</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item">
      <a href="<?php echo e(route('admin.admin-dashboard')); ?>" class="menu-link">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div data-i18n="Dashboards">Dashboards</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
        <div data-i18n="Roles/Permission">Roles/Permission</div>
      </a>

      <ul class="menu-sub">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role')): ?>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.role.index')); ?>" class="menu-link">
            <div data-i18n="Roles">Roles</div>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission')): ?>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.permission.index')); ?>" class="menu-link">
            <div data-i18n="Permissions">Permissions</div>
          </a>
        </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('assign_permission')): ?>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.userPermission')); ?>" class="menu-link">
            <div data-i18n="Assign Permission">Assign Permission</div>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('assign_permission_read')): ?>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.roleHasPermission')); ?>" class="menu-link">
            <div data-i18n="Role Has Permission">Role Has Permission</div>
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </li>


    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-user"></i>
        <div data-i18n="Users">Users</div>
      </a>
      <ul class="menu-sub">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employee')): ?>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.authuser.index')); ?>" class="menu-link">
            <div data-i18n="Employee">Employee</div>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer')): ?>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.customers')); ?>" class="menu-link">
            <div data-i18n="Customer">Customer</div>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('astrologer')): ?>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.astrologer.index')); ?>" class="menu-link">
            <div data-i18n="Astrologer">Astrologer</div>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('team')): ?>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.teams')); ?>" class="menu-link">
            <div data-i18n="Teams">Teams</div>
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
        <div data-i18n="Master">Master</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item">
          <a href="<?php echo e(route('admin.experties.index')); ?>" class="menu-link">
            <div data-i18n="Experties">Experties</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.language.index')); ?>" class="menu-link">
            <div data-i18n="Language">Language</div>
          </a>
        </li>

      </ul>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-gift"></i>
        <div data-i18n="Offer & Subscription">Offer & Subscription</div>
      </a>

      <ul class="menu-sub">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('offer')): ?>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.offers')); ?>" class="menu-link">
            <div data-i18n="Offer">Offer</div>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('subscription')): ?>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.subscription')); ?>" class="menu-link">
            <div data-i18n="Subscriptions">Subscriptions</div>
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </li>

    <!-- <li class="menu-item">
      <a href="<?php echo e(route('common-chat')); ?>" class="menu-link">
        <i class="menu-icon tf-icons ti ti-messages"></i>
        <div data-i18n="Chat">Chat</div>
      </a>
    </li> -->

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
        <div data-i18n="Report">Report</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item">
          <a href="<?php echo e(route('admin.chatReport')); ?>" class="menu-link">
            <div data-i18n="Chat Report">Chat Report</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.callReport')); ?>" class="menu-link">
            <div data-i18n="Call Report">Call Report</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.revenueReport')); ?>" class="menu-link">
            <div data-i18n="Revenue Report">Revenue Report</div>
          </a>
        </li>

      </ul>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
        <div data-i18n="Blog & Events">Blog & Events</div>
      </a>

      <ul class="menu-sub">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category')): ?>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.category')); ?>" class="menu-link">
            <div data-i18n="Category">Category</div>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog')): ?>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.blog')); ?>" class="menu-link">
            <i class="menu-icon tf-icons ti ti-file"></i>
            <div data-i18n="Blog">Blog</div>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('event')): ?>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.event')); ?>" class="menu-link">
            <i class="menu-icon tf-icons ti ti-file"></i>
            <div data-i18n="Event">Event</div>
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
        <div data-i18n="Web Pages">Web Pages</div>
      </a>

      <ul class="menu-sub">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('web_page')): ?>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.webPage')); ?>" class="menu-link">
            <i class="menu-icon tf-icons ti ti-file"></i>
            <div data-i18n="Pages">Pages</div>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('web_slider')): ?>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.webSlider')); ?>" class="menu-link">
            <i class="menu-icon tf-icons ti ti-file"></i>
            <div data-i18n="Web Sliders">Web Sliders</div>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('faq')): ?>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.faq')); ?>" class="menu-link">
            <i class="menu-icon tf-icons ti ti-file"></i>
            <div data-i18n="Faq Pages">Faq Pages</div>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('offer')): ?>
        <li class="menu-item">
          <a href="<?php echo e(route('admin.socialLink')); ?>" class="menu-link">
            <i class="menu-icon tf-icons ti ti-user"></i>
            <div data-i18n="Web Configuration">Web Configuration</div>
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </li>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('offer')): ?>
    <li class="menu-item">
      <a href="<?php echo e(route('admin.complaint')); ?>" class="menu-link">
        <i class="menu-icon tf-icons ti ti-user"></i>
        <div data-i18n="Complaint">Complaint</div>
      </a>
    </li>
    <?php endif; ?>



  </ul>
</aside><?php /**PATH E:\Theallsif-astro\resources\views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>