// Change status design for Pending, Approved and Rejected
function updateStatusDesign() {
    $('td:contains("Pending")').html('<span class="badge badge-warning">Pending</span>');
    $('td:contains("Approved")').html('<span class="badge badge-success">Approved</span>');
    $('td:contains("Rejected")').html('<span class="badge badge-danger">Rejected</span>');
}