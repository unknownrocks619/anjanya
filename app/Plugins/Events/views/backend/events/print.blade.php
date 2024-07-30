@php
    $url = asset('images/letterhead.png');
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Application Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</head>

<body class="mt-0" onload="window.print();">
    <div class="container d-print-none d-flex justify-content-between my-3">
        <a href="{{ route('admin.events.edit', ['event' => $event, 'tab' => 'user-registrations']) }}"
            class="btn btn-primary">Go Back</a>

        <button type='button' class="btn btn-info" onclick="window.print()">Print</button>
    </div>
    <div class="container-fluid mx-1">
        <div class="row my-0 py-0">
            <div class="col-md-12 my-0 py-0">
                <img src="{{ $url }}" style="height:65px; width:100%" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center fs-6">
                मन्त्राे लयाे हठाे राजयाेगाेऽन्तर्भूमिका:क्रमात् ।<br />
                एक एव चतुर्धाय‌ं महायाेगाेऽभिधीयते ।।
            </div>
            <div class="col-md-12 text-center">
                <h6>जगद्गुरु श्रीरामानन्दाचार्य सेवापीठ एवं महायोगी सिद्धबाबा आध्यात्मिक प्रतिष्ठान
                </h6>
                <h5>
                    हिमालयन सिद्धमहायोग ध्यान साधना
                </h5>
                <h4 style="margin-bottom: 0px; padding-bottom:0px;">
                    आवेदन फारम
                </h4>
                <p>
                    मितिः २०८१ / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; देखि &nbsp; २०८१ /
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; /
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    सम्म
                </p>
                <h5 style="margin-bottom:0px; padding-bottom:0px">
                    व्यक्तिगत विवरण
                </h5>
            </div>

        </div>
        <div class="row mt-0">
            <div class="col-md-12 text-center">
                <table>
                    <tbody>
                        <tr>
                            <th style="width: 65px;">
                                नाम :
                            </th>
                            <td style="border-bottom: 2px dotted;width: 250px;text-align: left;">
                                {{ $user->full_name }}
                            </td>
                            <th style="width: 65px;">
                                ठेगाना :
                            </th>
                            <td style="border-bottom:2px dotted;width:300px">
                                {{ $user->portalCountry?->name }},
                                {{ $user->city }},
                                {{ $user->address?->street_address ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-12 text-center">
                <table>
                    <tbody>
                        <tr>
                            <th style="width: 65px;">
                                शिक्षा :
                            </th>
                            <td style="border-bottom: 2px dotted;width: 250px;text-align: left;">
                                {{ $user->meta?->education?->education }}
                            </td>
                            <th style="width: 70px;">
                                व्यसाय :
                            </th>
                            <td style="border-bottom:2px dotted;width:300px">
                                {{ $user->meta?->education->profession }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-12 text-center">
                <table>
                    <tbody>
                        <tr>
                            <th style="width: 65px;">
                                उमेर :
                            </th>
                            <td style="border-bottom: 2px dotted;width: 250px;text-align: left;">
                                @php
                                    $carbon = Carbon\Carbon::createFromFormat('Y-m-d', $user->date_of_birth);
                                    echo $carbon->diffInYears();
                                @endphp
                            </td>
                            <th style="width: 65px;">
                                लिङ्ग :
                            </th>
                            <td style="border-bottom:2px dotted;width:200px">
                                {{ ucwords($user->gender) }}
                            </td>
                            <th style="width: 80px;">
                                सम्र्पक नं. :
                            </th>
                            <td style="border-bottom:2px dotted;width:200px">
                                {{ $user->phone_number }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-12 text-center">
                <table>
                    <tbody>
                        <tr>
                            <th style="width: 65px;">
                                इमेल :
                            </th>
                            <td style="border-bottom: 2px dotted;width: 350px;text-align: left;">
                                {{ $user->full_name }}
                            </td>
                            <th style="width: 110px;">
                                वैवाहिक स्थिति :
                            </th>
                            <td style="width:200px">
                                <input type="checkbox" name="" id="" checked>
                                विवाहित
                                &nbsp;&nbsp;
                                <input type="checkbox" name="" id="">
                                अविवाहित
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12 text-center">
                <table>
                    <tbody>
                        <tr>
                            <th style="width: 150px;">
                                परिचयपत्रको किसिम :
                            </th>
                            <td style="width: 600px;text-align: left;">
                                <input type="checkbox" name="" id=""> नागरिकता
                                &nbsp; &nbsp;
                                &nbsp; &nbsp;
                                <input type="checkbox" name="" id=""> ड्राइभिङ लाइसेन्स
                                &nbsp; &nbsp;
                                &nbsp; &nbsp;
                                <input type="checkbox" name="" id=""> मतदाता परिचयपत्र
                                &nbsp; &nbsp;
                                &nbsp; &nbsp;
                                <input type="checkbox" name="" id=""> राष्ट्रिय परिचयपत्र
                                &nbsp; &nbsp;
                                &nbsp; &nbsp;
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="row mt-0">
            <div class="col-md-12 text-center">
                <table>
                    <tbody>
                        <tr>
                            <th style="width: 200px;">
                                नजिकको सम्पर्क व्यक्तिको नाम :
                            </th>
                            <td style="border-bottom: 2px dotted; width: 300px;text-align: left;">
                                {{ $user->emergency?->contact_person }}
                            </td>
                            <th style="width: 50px;">
                                नाताः
                            </th>
                            <td style="border-bottom: 2px dotted; width: 150px;text-align: left;">
                                {{ $user->emergency?->contact_person }}
                            </td>
                        </tr>

                    </tbody>
                </table>
                <table class="mt-0">
                    <tbody>
                        <tr>
                            <th style="width: 70px;">
                                सम्पर्क नं.
                            </th>
                            <td style="border-bottom: 2px dotted; width: 200px;text-align: left;">
                                {{ $user->emergency?->phone_number }}
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12 text-center">
                <h4>अन्य विवरण</h4>
            </div>
        </div>

        <div class="row mt-0">
            <div class="col-md-12 d-flex align-items-center">
                <h5 class=" mb-0 pb-0">
                    १. तपाई पहिले हिमालयन सिद्धमहायोग ध्यान साधना शिविरमा बस्नुभएको छ ?
                </h5>
                <div style="margin-left: 10px;" class="fs-4">

                    छ <input type="checkbox" name="" id="">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    छैन <input type="checkbox" name="" id="">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                </div>

            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12 d-flex align-items-center">
                <h5 class=" mb-0 pb-0">
                    २. तपाईको साथमा शिविरमा बस्ने कुनै साथी वा परिवारको सदस्य पनि हुनुहुन्छ ?
                </h5>
                <div style="margin-left: 10px;" class="fs-4">

                    छ <input type="checkbox" name="" id="">
                    &nbsp;&nbsp;&nbsp;
                    छैन <input type="checkbox" name="" id="">
                    &nbsp;&nbsp;&nbsp;
                </div>

            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12">
                <h5 class=" mb-0 pb-0">
                    ३. तपाईमा कुनै शारीरिक÷मानसिक रोग अहिले छ वा पहिले थियो ? विवरण खुलाउनुहोस्
                </h5>
                <div style="min-height: 20px; border-bottom:2px dotted" class="fs-4 mx-3">

                </div>

            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12">
                <h5 class=" mb-0 pb-0">
                    ४. हाल कुनै औषधी सेवन गर्दै हुनुहुन्छ? छ भने विवरण खुलाउनुहोस्
                </h5>
                <div style="min-height: 20px; border-bottom:2px dotted" class="fs-4 mx-3">
                    @if ($user->meta?->history && $user->meta?->history->medicine_history == 'yes')
                        {{ $user->meta?->history->regular_medicine_history_detail }}
                    @endif

                </div>

            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12 d-flex align-items-center">
                <span class="fs-5">
                    ५.
                </span>
                <h5 class=" mb-0 pb-0" style="margin-left: 5px;">
                    तपाईले कुनै ध्यान विधि, उपचार विधि वा यस्तै अन्य विधिको अभ्यास गर्नुभएको छ ?
                </h5>
                <div style="margin-left: 10px;" class="fs-4">

                    छ <input type="checkbox" name="" id="">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    छैन <input type="checkbox" name="" id="">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                </div>

            </div>
        </div>

        <div class="row mt-0">
            <div class="col-md-12 d-flex align-items-center">
                <span class="fs-5">
                    ६.
                </span>
                <h5 class=" mb-0 pb-0" style="margin-left: 5px;">
                    छ भने कुन विधि विवरण खुलाउनुहोस् ?
                </h5>
                <div style="margin-left: 10px; border-bottom: 1px dotted;min-width: 200px;min-height:5px;"
                    class="fs-4">
                </div>

            </div>
        </div>

        <div class="row mt-0">
            <div class="col-md-12 d-flex align-items-center">
                <span class="fs-5">
                    ७.
                </span>
                <h5 class=" mb-0 pb-0" style="margin-left: 5px;">
                    सिद्धमहायोग ध्यान साधनाबारे कसरी जानकारी पाउनुभयो ?
                </h5>
                <div style="margin-left: 10px;" class="fs-4">
                    @php
                        $source = $user->source;
                        $explode = explode('_', $source);
                        echo ucwords(implode(' ', $explode));
                    @endphp
                    <input type="checkbox" name="" id="" checked>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                </div>

            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12 text-center">
                <h3 style="padding-bottom:0px;margin-bottom:0px;">
                    प्रतिवद्धता
                </h3>
                <p style="font-size: 18px;margin-top:0px;">
                    परमपूज्य सद्गुरुदेव अनन्तश्रीविभूषित जगद्गुरु श्रीरामानन्दाचार्य स्वामी श्रीरामकृष्णाचार्य महायोगी
                    सिद्धबाबाबाट गराइएको
                    हिमालयन सिद्धमहायोग ध्यान साधना र यसको नीति नियम मैले राम्रोसंग पढि बुझि साधनामा भाग लिएको छु । म
                    ईश्वर साक्षी
                    राखी यो शपथ ग्रहण गर्दछु कि जगद्गुरु महायोगी सिद्धबाबा र उहाँको संस्था प्रति सदा ईमान्दारी र
                    बफादारीका साथ यस
                    विद्याको गुरुआज्ञा बिना आफ्नो नाम, प्रसिद्धि र धन कमाउनका लागि दुरुपयोग गर्ने छैन । यस साधनाबाट
                    प्राप्त परिणामको
                    जिम्मेवार म आफै रहनेछु ।
                    <br />
                </p>
            </div>
            <div class="col-md-12 text-end">
                <table style="float:right">
                    <tr>
                        <th style="width: 150px;">दस्तखत : </th>
                        <td style="width: 200px; border-bottom: 2px dotted"></td>
                    </tr>
                </table>
            </div>
        </div>


    </div>
</body>

</html>
