<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: '/securityfdc',
            method: 'GET',
            success: function(response) {
                // alert(response.message);
            },
            error: function() {
                alert('Error occurred');
            }
        });
    });
</script>
