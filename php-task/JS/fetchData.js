function fetchData(searchQuery = '') {
    $.ajax({
        url: 'cURL-request.php', 
        method: 'GET',
        data: { searchQ: searchQuery },
        dataType: 'html',
        success: function(response) {
            $('#data-container').html(response);
        }
    });
}