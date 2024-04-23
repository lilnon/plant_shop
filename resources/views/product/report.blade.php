
<?php
date_default_timezone_set('UTC');

$currentTimeUTC = new DateTime('now', new DateTimeZone('UTC'));

$thailandTimezone = new DateTimeZone('Asia/Bangkok');
$currentTimeUTC->setTimezone($thailandTimezone);

$currentDateTimeThailand = $currentTimeUTC->format('Y-m-d H:i:s');
?>

<header>
    <h1>Plant Shop</h1>
    <h3>Product discription</h3>
    <p>document date : {{ $currentDateTimeThailand }}</p>

    <hr />
    <br>
    <table>

        <tr>
            <td colspan="2"><b>Product title : {{ $data->title }}</b></td>
        </tr>
        <tr>
            <td colspan="2">By : User name</td>
        </tr>

        <tr>
            <td>
                <h3>Create date</h3>
            </td>
            <td>
                <h3>Category</h3>
            </td>
        </tr>
        <tr>
            <td>{{$data->created_at}}</td>
            <td>{{$data->category}}</td>
        </tr>
    </table>
    <br>

    <hr>

    <br>
</header>

<main>
    <table>
        <thead>
            <tr>
                <th><b>Product_id</b></th>
                <th align="left"><b>Item Description</b></th>

                <th align="right"><b>Price</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{$data->id}}
                </td>
                <td align="left">
                    {{$data->content}}
                </td>
                <td align="right">
                    {{$data->price}} bath
                </td>
            </tr>

        </tbody>
        <hr>
</main>
