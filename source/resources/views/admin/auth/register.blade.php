<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css">

    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,600,400italic);

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
            -moz-font-smoothing: antialiased;
            -o-font-smoothing: antialiased;
            font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
        }

        body {
            font-family: "Roboto", Helvetica, Arial, sans-serif;
            font-weight: 100;
            font-size: 12px;
            line-height: 30px;
            color: #777;
            background: lightgray;
        }

        .container {
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
            position: relative;
        }

        #contact input[type="text"],
        #contact input[type="email"],
        #contact input[type="tel"],
        #contact input[type="url"],
        #contact textarea,
        #contact button[type="submit"] {
            font: 400 12px/16px "Roboto", Helvetica, Arial, sans-serif;
        }

        #contact {
            background: #F9F9F9;
            padding: 25px;
            margin: 150px 0;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        #contact h3 {
            display: block;
            font-size: 30px;
            font-weight: 300;
            margin-bottom: 10px;
        }

        #contact h4 {
            margin: 5px 0 15px;
            display: block;
            font-size: 13px;
            font-weight: 400;
        }

        fieldset {
            border: medium none !important;
            margin: 0 0 10px;
            min-width: 100%;
            padding: 0;
            width: 100%;
        }

        #contact input[type="text"],
        #contact input[type="email"],
        #contact input[type="tel"],
        #contact input[type="url"],
        #contact textarea {
            width: 100%;
            border: 1px solid #ccc;
            background: #FFF;
            margin: 0 0 5px;
            padding: 10px;
        }

        #contact input[type="text"]:hover,
        #contact input[type="email"]:hover,
        #contact input[type="tel"]:hover,
        #contact input[type="url"]:hover,
        #contact textarea:hover {
            -webkit-transition: border-color 0.3s ease-in-out;
            -moz-transition: border-color 0.3s ease-in-out;
            transition: border-color 0.3s ease-in-out;
            border: 1px solid #aaa;
        }

        #contact textarea {
            height: 100px;
            max-width: 100%;
            resize: none;
        }

        #contact button[type="submit"] {
            cursor: pointer;
            width: 100%;
            border: none;
            background: lightgray;
            color: #FFF;
            margin: 0 0 5px;
            padding: 10px;
            font-size: 15px;
        }

        #contact button[type="submit"]:hover {
            background: #43A047;
            -webkit-transition: background 0.3s ease-in-out;
            -moz-transition: background 0.3s ease-in-out;
            transition: background-color 0.3s ease-in-out;
        }

        #contact button[type="submit"]:active {
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
        }

        .copyright {
            text-align: center;
        }

        #contact input:focus,
        #contact textarea:focus {
            outline: 0;
            border: 1px solid #aaa;
        }

        ::-webkit-input-placeholder {
            color: #888;
        }

        :-moz-placeholder {
            color: #888;
        }

        ::-moz-placeholder {
            color: #888;
        }

        :-ms-input-placeholder {
            color: #888;
        }
    </style>

    <title>Document</title>
</head>

<body>
    <div class="container">
        <form id="contact" action="admin-register" method="post">
            @csrf
            <h3>Admin Register</h3>
            <fieldset>
                <input placeholder="Tên" type="text" tabindex="1" required autofocus name="name"
                    value="{{ old('name') }}">

                @error('name')
                    <span style='color: red;'>
                        {{ $message }}
                    </span>
                @enderror
            </fieldset>
            <fieldset>
                <input placeholder="Địa chỉ mail" type="email" tabindex="2" required name="email"
                    value="{{ old('email') }}">

                @error('email')
                    <span style='color: red;'>
                        {{ $message }}
                    </span>
                @enderror
            </fieldset>
            <fieldset>
                Giới tính:
                <br>
                <input type="radio" name="gender" value="1" checked> Nam
                <input type="radio" name="gender" value="0"> Nữ


                @error('gender')
                    <span style='color: red;'>
                        {{ $message }}
                    </span>
                @enderror
            </fieldset>
            <fieldset>
                Ngày sinh:
                <input type="date" tabindex="4" required style="margin-left: 40px" name="dob">

                @error('dob')
                    <span style='color: red;'>
                        {{ $message }}
                    </span>
                @enderror
            </fieldset>
            <fieldset>
                <input placeholder="Số điện thoại" type="tel" tabindex="5" required
                    name="phone"value="{{ old('phone') }}">

                @error('phone')
                    <span style='color: red;'>
                        {{ $message }}
                    </span>
                @enderror
            </fieldset>
            <fieldset>
                <textarea placeholder="Địa chỉ" tabindex="4" required name="address">{{ old('address') }}</textarea>

                @error('address')
                    <span style='color: red;'>
                        {{ $message }}
                    </span>
                @enderror
            </fieldset>
            <fieldset>
                <input placeholder="Mật khẩu" type="text" tabindex="6" required name="password">

                @error('password')
                    <span style='color: red;'>
                        {{ $message }}
                    </span>
                @enderror
            </fieldset>
            <fieldset>
                <button type="submit" id="contact-submit" data-submit="...Sending">Đăng ký</button>
            </fieldset>
        </form>
    </div>
</body>

</html>
