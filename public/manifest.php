
<?php



    // {
    //     "name": "Laravel Package Tutorial",
    //     "short_name": "LPT",
    //     "start_url": "/index.php",
    //     "background_color": "#6777ef",
    //     "description": "Tutorial of Laravel Package",
    //     "display": "fullscreen",
    //     "theme_color": "#6777ef",
    //     "icons": [
    //         {
    //             "src": "logo.PNG",
    //             "sizes": "512x512",
    //             "type": "image/png",
    //             "purpose": "any maskable"
    //         }
    //     ]
    // }



$arr = array( "name"=> config('app.school_name'),
"short_name"=> config('app.school_name'),
"start_url"=> "/index.php",
"background_color"=> "#6777ef",
"description"=> "Tutorial of Laravel Package",
"display"=> "fullscreen",
"theme_color"=> "#6777ef","icons"=>["src"=> "logo.PNG",
            "sizes"=> "512x512",
           "type"=> "image/png",
             "purpose"=> "any maskable"]);

echo json_encode($arr);






?>


