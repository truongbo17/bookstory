<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStory</title>
    <link rel="icon" href="{{ asset('images/logo/logo-header.png') }}">
    <link href="{{ asset('1/app.css') }}" rel="stylesheet">
</head>

<body>
<button class="btn btn-primary" id="btn-download" data-vip="1" data-id="17027" data-file="ky-thuat-thiet-ke-web "><i
        class="fas fa-download"></i> Tải về
</button>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    window.API_UPDATE_DOWNLOAD = 'https://pesthubt.com/quiz/update-download'
    window.API_CHECK_VIP = 'https://pesthubt.com/quiz/is-user-vip'
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '6TzmqLD4mt7Riz4kHUnYHs3J0j58IRdFBPXLPSfw',
            'Access-Control-Allow-Origin': '*'
        }
    });
    $(function () {
        $('#btn-download').click(function () {
            update_download()
        })
    })

    function update_download(quiz_id) {
        $.ajax({
            url: API_UPDATE_DOWNLOAD,
            data: {
                'quiz_id': quiz_id,
            },
            type: 'POST',
            crossDomain: true,
            success: function () {
                alert("Success");
            },
            error: function () {
                alert('Failed!');
            },
        })
    }
</script>
</html>
