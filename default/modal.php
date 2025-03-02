<!-- logout modal -->
<?php include '../conn/session.php'; ?>
<div class="show" id="logoutModal-x">
    <div class="modal-content-x">
        <!-- head -->
        <div class="modal-head-x">
            <h5 class="x-h2"><?php echo $_SESSION['fullname'] ?></h5>
            <!-- email -->
            <p class="x-p"><?php echo $_SESSION['email_address'] ?></p>
        </div>
        <div class="modal-body-x">
            <!-- Manage Account -->
            <div class="first-row">
                <!-- arrow right -->
                <i class="fa-solid fa-user"></i>
                <p class="x-p">Manage Account</p>
            </div>
            <div class="second-row" id="logout_action">
                <!-- arrow right -->
                <i class="fa-solid fa-right-from-bracket"></i>
                <p class="x-p">Sign out</p>
            </div>
        </div>
    </div>
</div>
<!-- end of logout modal -->