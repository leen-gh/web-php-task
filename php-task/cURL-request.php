<?php

    $url = 'https://api.baubuddy.de/index.php/login';
    $headers = [
        'Authorization: Basic QVBJX0V4cGxvcmVyOjEyMzQ1NmlzQUxhbWVQYXNz',
        'Content-Type: application/json'
    ];
    $data = [
        'username' => '365',
        'password' => '1'
    ];

    // initialize cURL session no.1
    $ch = curl_init();

    //setting headers(the defualt type requst is GET)
    curl_setopt($ch, CURLOPT_URL, $url);
    //htis opt will return the response body as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //to change the requst type to post 
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $responseA = curl_exec($ch);
    //echo $responseA;
    $resAData = json_decode($responseA, true);
    //var_dump($resAData);

    // close the cURL session no.1
    curl_close($ch);


    $accessToken = $resAData['oauth']['access_token'];
    $tokenType =$resAData['oauth']['token_type'];

    // URL and headers session no.2
    $url = 'https://api.baubuddy.de/dev/index.php/v1/tasks/select';
    $headers = array(
        'Authorization: '. $tokenType.' ' . $accessToken,
        'Content-Type: application/json'
    );

    // initialize cURL session no.2
    $ch = curl_init();

    // set the URL and headers S no.2
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error = curl_error($ch);
    }

    // close the cURL session no.2
    curl_close($ch);

    if ($response) {
    $responseData = json_decode($response, true);
    //var_dump($responseData);
    }


    //searchong method
    $searchQuery = isset($_GET['searchQ']) ? $_GET['searchQ'] : '';

    $filteredData = array_filter($responseData, function($item) use ($searchQuery) {
        // Modify the conditions as per your table structure and search criteria
        if (strpos(strtolower($item['task']), strtolower($searchQuery)) !== false ||
            strpos(strtolower($item['title']), strtolower($searchQuery)) !== false ||
            strpos(strtolower($item['description']), strtolower($searchQuery)) !== false
            ) {
            return true;
        }
        return false;
    });
    //var_dump($filteredData);

?>
<html>
    <table class="table-responsive" >
        <thead>
            <tr>
                <th>Task</th>
                <th>Title</th>
                <th>Description</th>
                <th>ColorCode</th>
            </tr>
        </thead>
    </table>
    <div class="tbl-content">
        <table cellpadding="0" cellspacing="0">
            <tbody>
                <?php foreach($filteredData as $res):?>
                <tr style="background-color:<?= $res["colorCode"]?> ">
                    <td><?= $res["task"] ?></td>
                    <td><?= $res["title"]?></td>
                    <td><?= $res["description"] ?></td>
                    <td><?= $res["colorCode"] ?></td>

                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    
</html>

<?php
       
?>

