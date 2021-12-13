<?php

class Discord{
    function send($title, $username, $msg, $webhook){
        $webhookurl = $webhook;
        $timestamp = date("c", strtotime("now"));
        
        $json_data = json_encode([
            // Username
            "username" => "Example Hook",
        
            // Text-to-speech
            "tts" => false,
        
            // Embeds Array
            "embeds" => [
                [
                    // Embed Title
                    "title" => $title,
        
                    // Embed Type
                    "type" => "rich",
        
                    // Embed Description
                    //"description" => "",
        
                    // URL of title link
                    "url" => "https://example.com/panel",
        
                    // Timestamp of embed must be formatted as ISO8601
                    "timestamp" => $timestamp,
        
                    // Embed left border color in HEX
                    "color" => hexdec( "3366ff" ),
        
                    // Author
                    "author" => [
                        "url" => "https://example.com/"
                    ],
        
                    // Additional Fields array
                    "fields" => [
                        // Field 1
                        [
                            "name" => "**$username**",
                            "value" => $msg,
                            "inline" => false
                        ],
                    ]
                ]
            ]
        
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
        
        $ch = curl_init( $webhookurl );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        
        $response = curl_exec( $ch );
        curl_close( $ch );
    }
}
