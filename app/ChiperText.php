<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiperText extends Model
{
    //// Store the cipher method 
    private const  CHIPERING = "AES-128-CTR"; 
    
    // Use OpenSSl Encryption method 
    
    private const  OPTIONS = 0; 
    
    // Non-NULL Initialization Vector for encryption 
    private const  ENCRYPTION_IV = '1235987891015892'; 
    
    // Store the encryption key 
    private const ENCRYPTION_KEY = "LogonBroadBandHome";
    
    public static function  encrypt($value)
    {
            // Use openssl_encrypt() function to encrypt the data 
            return openssl_encrypt($value,self::CHIPERING, 
            self::ENCRYPTION_KEY, self::OPTIONS, self::ENCRYPTION_IV);
    }

    public static function  decrypt($value){

        return openssl_decrypt ($value,self::CHIPERING, 
            self::ENCRYPTION_KEY, self::OPTIONS, self::ENCRYPTION_IV); 
    }
}
