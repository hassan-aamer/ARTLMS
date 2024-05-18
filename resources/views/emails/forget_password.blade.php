<html>
<head></head>
<body>

<div style="position:relative;width: 80%; margin: 0 auto; padding: 30px">
    <div style="width: 100%;
                padding: 5px 0;
                background: #039f39;
                text-align: center;
                border-radius: 10px;
                color: #fff;">
        <h1> منصة فن | استعادة كلمة المرور </h1>
    </div>
    <div style="background: #eeeeee; padding: 20px; text-align: center;border-radius: 10px;">
        <p>
            @if(isset($email))
                <strong>مرحباً</strong> {{$email}}
            @endif
        </p>

        <p>
            اضغط علي الرابط الأسفل لاستعادة كلمة المرور
        </p>

        <a style="background: #ff2424;
                    padding: 20px;
                    display: block;
                    color: #fff;
                    text-decoration: auto;
                    font-weight: bold;
                    width: 20%;
                    margin: 0 auto;
                    border-radius: 10px;" href="{{$link}}">
            استعادة كلمة المرور
        </a>

    </div>
</div>

</body>
</html>
