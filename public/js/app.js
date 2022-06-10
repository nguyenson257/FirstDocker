function search() {
    $.ajax({
        type: "POST",
        url: "{{ route('sport/search-advance') }}",
        data: $("#search-form").serialize(),
        success: function(data)
        {
            $('#sports').html(data);
        }
    });
}