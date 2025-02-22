$(document).ready(function() {
    const $sidebarContainer = $('#default-container');
    // Load the sidebar.html content dynamically
    $.get('default/default-bar.php', function(data) {
        $sidebarContainer.html(data);

        const $sideNav = $('#sideNav');
        $sideNav.toggleClass('active');
        $('.content').css({
            'margin-left': '250px',
            'transition': '0.5s'
        });
    });
});

function toggleNav() {
    const $sideNav = $('#sideNav');
    $sideNav.toggleClass('active');
    if ($sideNav.hasClass('active')) {
        $('.content').css({
            'margin-left': '250px',
            'transition': '0.5s'
        });
    } else {
        $('.content').css({
            'margin-left': '0',
            'transition': '0.5s'
        });
    }
}