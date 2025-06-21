<?php
namespace App\Infrastructure\WebToken;

class JWT
{
    private static $secretKey = 'your-secret-key'; // Use a strong secret key

    // Encode a JWT
    public static function encode(array $payload, $expiration = 3600)
    {
        $header = [
            'alg' => 'HS256', // Algorithm
            'typ' => 'JWT'    // Token type
        ];

        $payload['exp'] = time() + $expiration; // Add expiration time

        // Base64Url encoding
        $headerBase64 = self::base64UrlEncode(json_encode($header));
        $payloadBase64 = self::base64UrlEncode(json_encode($payload));

        // Create the signature
        $signature = hash_hmac('sha256', "$headerBase64.$payloadBase64", self::$secretKey, true);
        $signatureBase64 = self::base64UrlEncode($signature);

        // Return the complete JWT
        return "$headerBase64.$payloadBase64.$signatureBase64";
    }

    // Decode and validate a JWT
    public static function decode($token)
    {
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            return false; // Invalid token structure
        }

        [$headerBase64, $payloadBase64, $signatureBase64] = $parts;

        // Recreate the signature to verify the token
        $signature = self::base64UrlDecode($signatureBase64);
        $validSignature = hash_hmac('sha256', "$headerBase64.$payloadBase64", self::$secretKey, true);

        if (!hash_equals($signature, $validSignature)) {
            return false; // Invalid signature
        }

        // Decode the payload
        $payload = json_decode(self::base64UrlDecode($payloadBase64), true);

        // Check if the token has expired
        if (isset($payload['exp']) && $payload['exp'] < time()) {
            return false; // Token expired
        }

        return $payload;
    }

    // Base64Url encode
    private static function base64UrlEncode($data)
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }

    // Base64Url decode
    private static function base64UrlDecode($data)
    {
        return base64_decode(str_replace(['-', '_'], ['+', '/'], $data));
    }
}
