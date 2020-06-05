<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULAIRE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <style>
        #main {
            width: 90%;
            min-height: 400px;
            margin: 40px auto;
            padding: 20px;
            background-color: #eee;
            border-radius: 5px;
        }

        .btn-success {
            margin-top: 20px;
            transition:0.5s;
        }

        .alert-danger{
            padding:15px;
            font-size:18px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div id="main">
            <form id="form" name="form">
                <h2>INSCRIPTION</h2>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="psd" id="password">
                </div>
                <div class="form-group">
                    <button class="btn-success btn-lg w-100">INSCRIPTION</button>
                </div>
            </form>
            <div class="alert-danger">
            </div>
            <div class="alert-success">
            </div>
        </div>
    </div>

</body>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script src="script/main.js"></script>

</html>