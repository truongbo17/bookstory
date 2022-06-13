<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow">
    <title>PDF</title>
    <style>
        * {
            font-family: DejaVu Sans;
            font-size: 14px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            padding-top: 20px;
            font-weight: bold;
        }

        .container {
            max-width: 800px;
        }
    </style>
</head>
<body>

<header>
    &copy; <?php echo date("Y");?> BookStory - Nguyễn Quang Trường (truongnq017@gmail.com)
</header>

<div>
    <div class="container" style="margin-top: 30px">
        <h1 class="text-center" style="text-align: center">{{$title}}</h1>
        @foreach($quizs as $quiz_sections)
            <div class="section-content">
                <h2>{{$quiz_sections['title']}}</h2>
                <div class="section" style="margin-bottom: 20px">
                    <div class="section-title" style="margin-bottom: 5px;"><strong></strong></div>
                    <div class="list-qs">
                        <div class="qs-content" style="margin-bottom: 15px;">
                            <div class="qs-title">
                                <div></div>
                            </div>
                            <ul class="qs-answer">
                                @foreach($quiz_sections['answers'] as $answer)
                                    <li>@if($answer['is_correct'] == 1)
                                            <span style="color:red;font-size:16px">*</span>
                                        @endif{{$answer['option']}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
</body>
</html>
