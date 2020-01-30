@extends('index')
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.reset-pop').fadeIn(300).css({
                display: 'flex',
            });
        })
    </script>
@endsection
