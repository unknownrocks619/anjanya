<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body style="padding:0px;margin:0px;">
    <div class="container-fluid">
        <div class="row vh-100 align-items-center">
            <div class="col-12 text-center">
                <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}"
                    style="max-width:125px; max-height:100px;" />
                <h2>
                    Sorry this website is currently under maintenance.
                </h2>
                <p>
                    Please be patient, we're either experiencing technical issues or performing upgrades. We will be
                    back
                    shortly, Thank you.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
