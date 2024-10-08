<?php

namespace App\Infrastructure\Helpers;

use Exception;

class JwtHelper
{
    public static function base64UrlEncode($data)
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }

    public static function generateJwt($header, $payload, $secret)
    {
        // Encode Header
        $base64UrlHeader = self::base64UrlEncode(json_encode($header));

        // Encode Payload
        $base64UrlPayload = self::base64UrlEncode(json_encode($payload));

        // Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);

        // Encode Signature to Base64Url
        $base64UrlSignature = self::base64UrlEncode($signature);

        // Return JWT
        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }

    public static function decodeJwt($jwt, $secret)
    {
        $parts = explode('.', $jwt);

        if (count($parts) !== 3) {
            throw new Exception('Invalid JWT structure');
        }

        $header = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $parts[0])), true);
        $payload = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $parts[1])), true);
        $signatureProvided = $parts[2];

        $base64UrlHeader = self::base64UrlEncode(json_encode($header));
        $base64UrlPayload = self::base64UrlEncode(json_encode($payload));
        $signature = self::base64UrlEncode(hash_hmac('sha256', $base64UrlHeader . '.' . $base64UrlPayload, $secret, true));

        if ($signature !== $signatureProvided) {
            throw new Exception('Invalid token signature');
        }

        return $payload;
    }
}
