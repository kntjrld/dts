$(document).ready(function(){
    // Load fetch connection response
    fetch('conn/connection.php')
    .then(response => response.json())
    .then(data => {
        // console.log(data);
        // alert(data);
        if(data.status == 'success'){
            $('#connection').html(data.message);
        }
        else{
            alert(data.message);
        }
    })
});