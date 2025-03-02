// modals
$(document).ready(function () {
    // Load the modal.html content dynamically
    const $modalContainer = $('#modal-container');
    $.get('default/modal.php', function (data) {
        $modalContainer.html(data);
    });
}
);

$(document).ready(function () {
    const $sidebarContainer = $('#default-container');
    // Load the sidebar.html content dynamically
    $.get('default/default-bar.php', function (data) {
        $sidebarContainer.html(data);

        const $sideNav = $('#sideNav');
        $sideNav.toggleClass('active');
        $('.content').css({
            'margin-left': '250px',
            'width': 'calc(95% - 250px)',
            'transition': '0.5s'
        });
        // change hamburger-menu icon
        $('.hamburger-menu i').removeClass('fa-bars').addClass('fa-ellipsis-vertical');

        const $logoutDropdown = $('#user-settings');
        // set dropdown text
        var $data = JSON.parse(localStorage.getItem('loginDetails'));
        var $userFullname = $data.fullname;
        const $thumbnail = getThumbnail($userFullname);
        $('#dropdown').html($thumbnail);
        // Load the dropdown.html content dynamically
        $logoutDropdown.click(function () {
            if ($logoutDropdown.hasClass('show')) {
                $logoutDropdown.removeClass('show');
                $('#logoutModal-x').css({ 'display': 'none' });
            } else {
                $logoutDropdown.addClass('show');

                // get and set fullname and email_address localStorage
                var $data = JSON.parse(localStorage.getItem('loginDetails'));
                var $fullname = $data.fullname;
                var $email_address = $data.email_address;
                $('#fullname').text($fullname);
                $('#email_address').text($email_address);

                // show modal
                $('#logoutModal-x').css({ 'display': 'block' });

                // logout conn/logout.php
                $('#logout_action').click(function () {
                    $.get('conn/logout.php', function (data) {
                        location.reload();
                    });
                });
            }
            // close modal if clicked outside
            $(window).click(function (event) {
                if (!$(event.target).closest('#logoutModal-x').length && !$(event.target).is('#dropdown')) {
                    $logoutDropdown.removeClass('show');
                    $('#logoutModal-x').css({ 'display': 'none' });
                }
            });
        });
    });
});

// active nav
$(document).ready(function () {
    const $navItems = $('li');
    $navItems.click(function () {
        alert('clicked');
        $navItems.removeClass('active');
        $(this).addClass('active');
    });
});

function toggleNav() {
    const $sideNav = $('#sideNav');
    $sideNav.toggleClass('active');
    if ($sideNav.hasClass('active')) {
        $('.content').css({
            'margin-left': '250px',
            'width': 'calc(95% - 250px)',
            'transition': '0.5s'
        });
        // change hamburger-menu icon
        $('.hamburger-menu i').removeClass('fa-bars').addClass('fa-ellipsis-vertical');
    } else {
        $('.content').css({
            'margin-left': '0',
            'width': '95%',
            'transition': '0.5s'
        });
        // change hamburger-menu icon
        $('.hamburger-menu i').removeClass('fa-ellipsis-vertical').addClass('fa-bars');
    }
}

// change status design for Pending, Approved and Rejected 
$(document).ready(function () {
    // Change status design for Pending, Approved and Rejected
    function updateStatusDesign() {
        $('td:contains("Pending")').html('<span class="badge badge-warning">Pending</span>');
        $('td:contains("Approved")').html('<span class="badge badge-success">Approved</span>');
        $('td:contains("Rejected")').html('<span class="badge badge-danger">Rejected</span>');
    }

    // Initial update
    updateStatusDesign();

    // Update status design after search
    $('#searchInput').on('keyup', function () {
        updateStatusDesign();
    });

    // Update status design pagination
    $('.pagination').on('click', function () {
        updateStatusDesign();
    });
});

// User fullname tumbnail for replace dropdown : Ex: Kent Abulag -> KA
function getThumbnail(fullname) {
    var name = fullname.split(' ');
    var thumbnail = name[0].charAt(0) + name[1].charAt(0);
    return thumbnail.toUpperCase();
}