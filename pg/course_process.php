<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    include "../inc/dbconfig.php";

    $db = $pdo;

    include "../inc/course.php";

    $cour = new Course($db);

    // $id       = (isset($_POST['id'       ]) && $_POST['id'       ] != '') ? $_POST['id'        ] : '';
    // Array ( [category] => arts_and_science 
    // [photo] => 
    // [detail_photo] => 
    // [name] => 1 
    // [description] => 1 
    // [description1] => 1 
    // [address] => 대구 수성구 미술관로 40 (삼덕동, 대구미술관) 
    // [operating_hours] => 1 
    // [contact] => 1 
    // [website] => 1 
    // [latitude] => 1 
    // [longtitude] => 1 
    // [qr_code] => 
    // [mode] => input )
    $idx = (isset($_POST['idx']) && $_POST['idx'] != '' && is_numeric($_POST['idx'])) ? $_POST['idx'] : '';
    $category = (isset($_POST['category']) && $_POST['category'] != '') ? $_POST['category'] : '';
    $name = (isset($_POST['name']) && $_POST['name'] != '') ? $_POST['name'] : '';
    $description = (isset($_POST['description']) && $_POST['description'] != '') ? $_POST['description'] : '';
    $description1 = (isset($_POST['description1']) && $_POST['description1'] != '') ? $_POST['description1'] : '';
    $address = (isset($_POST['address']) && $_POST['address'] != '') ? $_POST['address'] : '';
    $operating_hours = (isset($_POST['operating_hours']) && $_POST['operating_hours'] != '') ? $_POST['operating_hours'] : '';
    $contact = (isset($_POST['contact']) && $_POST['contact'] != '') ? $_POST['contact'] : '';
    $website = (isset($_POST['website']) && $_POST['website'] != '') ? $_POST['website'] : '';
    $latitude = (isset($_POST['latitude']) && $_POST['latitude'] != '') ? $_POST['latitude'] : '';
    $longtitude = (isset($_POST['longtitude']) && $_POST['longtitude'] != '') ? $_POST['longtitude'] : '';
    $longitude = (isset($_POST['longitude']) && $_POST['longitude'] != '') ? $_POST['longitude'] : '';
    $qr_code = (isset($_POST['qr_code']) && $_POST['qr_code'] != '') ? $_POST['qr_code'] : '';
    $mode = (isset($_POST['mode']) && $_POST['mode'] != '') ? $_POST['mode'] : '';

    $old_photo = (isset($_POST['old_photo']) && $_POST['old_photo'] != '') ? $_POST['old_photo'] : '';
    $old_detail_photo = (isset($_POST['old_detail_photo']) && $_POST['old_detail_photo'] != '') ? $_POST['old_detail_photo'] : '';

    $photo = '';
    $detail_photo = '';

    if ($mode == "input") {
        if ($category == ''){
            die(json_encode(['result' => "empty_category"]));
        }

        if ($name == ''){
            die(json_encode(['result' => "empty_name"]));
        }

        if ($description == ''){
            die(json_encode(['result' => "empty_description"]));
        }

        if ($description1 == ''){
            die(json_encode(['result' => "empty_description1"]));
        }

        // if ($address == ''){
        //     die(json_encode(['result' => "empty_address"]));
        // }

        // if ($operating_hours == ''){
        //     die(json_encode(['result' => "empty_operating_hours"]));
        // }

        // if ($contact == ''){
        //     die(json_encode(['result' => "empty_contact"]));
        // }

        if ($category == ''){
            die(json_encode(['result' => "empty_category"]));
        }

        // if ($website == ''){
        //     die(json_encode(['result' => "empty_website"]));
        // }


        if ($latitude == ''){
            die(json_encode(['result' => "empty_latitude"]));
        }

        if ($longitude == ''){
            die(json_encode(['result' => 'empty_longitude']));
        }

        if ($qr_code == ""){
            die(json_encode(['result' => 'empty_qr_code']));
        }
        
     
        
        if(isset($_FILES['photo']) && $_FILES['photo']['name'] != ''){
            $tmparr = explode('.', $_FILES['photo']['name']);
            $ext = end($tmparr);
            $photo = $name.'.'.$ext;
        
            // 웹 서버 루트 디렉토리를 기준으로한 절대 경로를 생성
            $photo_path = $_SERVER['DOCUMENT_ROOT'] . '/data/course/' . $photo;
        
            copy($_FILES['photo']['tmp_name'], $photo_path);
        }
        
        if(isset($_FILES['detail_photo']) && $_FILES['detail_photo']['name'] != ''){
            $tmparr = explode('.', $_FILES['detail_photo']['name']);
            $ext = end($tmparr);
            $detail_photo = $name.'.'.$ext;
        
            // 웹 서버 루트 디렉토리를 기준으로한 절대 경로를 생성
            $detail_photo_path = $_SERVER['DOCUMENT_ROOT'] . '/data/detail/' . $detail_photo;
        
            copy($_FILES['detail_photo']['tmp_name'], $detail_photo_path);
        }

        $arr = [
            'category' => $category,
            'photo' => $photo,
            'detail_photo' => $detail_photo,
            'name' => $name,
            'description' => $description,
            'description2' => $description1,
            'address' => $address,
            'operating_hours' => $operating_hours,
            'contact' => $contact,
            'website' => $website,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'qr_code' => $qr_code,
        ];

        $cour->courseInput($arr);
        $cour->input($arr);

        die(json_encode(['result' => 'course_input_success']));

    } else if ($mode == "edit") {
        $photo = $old_photo; // 기본적으로 기존 데이터를 유지
        $detail_photo = $old_detail_photo; // 기본적으로 기존 데이터를 유지
    
        if (isset($_FILES['photo']) && $_FILES['photo']['name'] != '') {
            $new_photo = $_FILES['photo'];
            $photo = $cour->photo_upload($name, $new_photo, $old_photo); // 새 파일 업로드
        }
    
        if (isset($_FILES['detail_photo']) && $_FILES['detail_photo']['name'] != '') {
            $new_detail_photo = $_FILES['detail_photo'];
            $detail_photo = $cour->detail_photo_upload($name, $new_detail_photo, $old_detail_photo); // 새 파일 업로드
        }
    
        session_start();
    
        $arr = [
            'idx' => $idx,
            'category' => $category,
            'photo' => $photo,
            'detail_photo' => $detail_photo,
            'name' => $name,
            'description' => $description,
            'description2' => $description1,
            'address' => $address,
            'operating_hours' => $operating_hours,
            'contact' => $contact,
            'website' => $website,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'qr_code' => $qr_code,
        ];
    
        $cour->edit($category, $arr);
        $cour->coursedit($arr);
    
        die(json_encode(['result' => 'course_edit_success']));
    }
    