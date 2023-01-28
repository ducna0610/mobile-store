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
        /* @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100&family=Reem+Kufi+Fun:wght@500&family=Reem+Kufi:wght@400;500&display=swap'); */
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css");
        @import url('https://fonts.googleapis.com/css2?family=Jost:wght@200;400&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* font-family: 'Reem Kufi Fun', sans-serif; */
            font-family: 'Jost', sans-serif;

        }

        .section {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #282c34;
        }

        .login {
            width: 360px;
            height: min-content;
            padding: 20px;
            border-radius: 8px;
            /* background: green; */
        }

        .img {
            width: 50px;
            height: 50px;
            cursor: pointer;
        }

        .img:hover {
            color: rgb(0, 0, 255);
        }

        .login h1 {
            font-size: 36px;
            margin-bottom: 25px;
        }

        .login form {
            font-size: 20px;

        }

        .login form .form-group {
            margin-bottom: 12px;
        }

        .login form input[type="submit"] {
            font-size: 20px;
            margin-top: 15px;
        }
    </style>

    <title>Document</title>
</head>

<body>
    <div class="Login">
        <div class="section">
            <div class="login bg-white m-4">
                <h1 class="text-center">
                    Admin register
                </h1>
                <!-- <h1 class="text-center">Login Here!</h1> -->

                <form action="admin-register" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" type="email">
                            Email Address
                        </label>
                        <input class="form-control" type="email" id="email" name="email" required />
                        <!-- <div class="invalid-feedback">
                  Please enter your email address
              </div>  -->
                    </div>

                    <div class="form-group">
                        <label class="form-label" type="password">
                            Password
                        </label>
                        <input class="form-control" type="password" id="password" name="password" required />
                        <!-- <div class="invalid-feedback">
                  Please enter your password
              </div> -->
                    </div>

                    <div class="form-group form-check">
                        <input class="form-check-input" type="checkbox" id="checkbox" />
                        <label class="form-check-label" type="checkbox">
                            Remember me
                        </label>
                    </div>

                    <input class="btn btn-primary w-100" type="submit" value="Sign In" />
                </form>
            </div>
        </div>
    </div>
</body>

</html>
