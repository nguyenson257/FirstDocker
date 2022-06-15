function search() {
    $.ajax({
        type: "POST",
        url: "{{ route('sport/search-advance') }}",
        data: $("#search-form").serialize(),
        success: function (data) {
            $('#sports').html(data);
        }
    });
}

// $(document).ready(function () {
//     $('#selectedColumn').DataTable();
//     $('.dataTables_length').addClass('bs-select');
//   });