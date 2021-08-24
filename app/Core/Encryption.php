<?php
require_once('./Libararies/defuse-crypto.phar');

use Defuse\Crypto\Key;
use Defuse\Crypto\Crypto;

class Encryption
{

    private function loadEncryptionKeyFromConfig()
    {
        $keyAscii = "def000008ba46253635efd0420af09e956de0219dd24c9e3a64fd4630bdfc6af8f69895eb43eef0d0390be27fef36ec22c17ffb8ad290f7a5f131bed23df2e51c45e4da1";
        return Key::loadFromAsciiSafeString($keyAscii);
    }

    public function encrypt($strings, $purpose = '')
    {
        $context = ["stage" => "communityretreat", "purpose" => $purpose];
        $secretString = json_encode(array_merge($context, $strings));
        $key = $this->loadEncryptionKeyFromConfig();
        $ciphertext = Crypto::encrypt($secretString, $key);
        return $ciphertext;
    }

    public function decrypt($string,$purpose = '')
    {
        $key = $this->loadEncryptionKeyFromConfig();

        try {
            $secret_data = Crypto::decrypt($string, $key);
            $data = json_decode($secret_data,true);
            if (!($data["stage"] == "communityretreat" and $data["purpose"] == $purpose))
                throw new \Exception("Decryption failed", 500);
        } catch (\Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException $ex) {
            throw new \Exception("Decryption failed", 500);
        }
        return $data;
    }
}
