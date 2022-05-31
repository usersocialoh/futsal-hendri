<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand" href="<?= base_url('profile') ?>">
        <div class="sidebar-brand-text mx-2">Futsal</div>
    </a>
    <hr class="sidebar-divider mb-3">
    <div class="sidebar-heading">
        Account
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('profile') ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Your Profile</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('edit-profile') ?>">
            <i class="fas fa-fw fa-edit"></i>
            <span>Edit Profile</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('change-password') ?>">
            <i class="fas fa-fw fa-lock"></i>
            <span>Change Password</span></a>
    </li>
    <hr class="sidebar-divider mb-3">
    <div class="sidebar-heading">
        Manage user
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('manage-member') ?>">
            <i class="fas fa-fw fa-child"></i>
            <span>Manage member</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('manage-owner') ?>">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>Manage owner</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('manage-admin') ?>">
            <i class="fas fa-fw fa-key"></i>
            <span>Manage admin</span></a>
    </li>
    <hr class="sidebar-divider mb-3">
    <div class="sidebar-heading">
        Owner
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('owner-approval') ?>">
            <i class="fas fa-fw fa-check"></i>
            <span>Owner Approval</span></a>
    </li>
</ul>