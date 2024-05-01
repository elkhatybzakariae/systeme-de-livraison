@if ($message)
    <script>
        Swal.fire({
            icon: '{{ $type }}',
            title: 'Alert',
            text: '{{ $message }}',
        });
    </script>
@endif
