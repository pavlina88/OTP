<?php

class RegistrationForm
{
    /**
     * Convert phone number from this 0887 (54-54-54) to this +359887545454 to can send sms
     * I know the requirement was 0 to be converted to 359 but Twilio wants it to be converted as +359 to be able to send SMS
     * @param string $phone
     *
     * @return string
     */
    public function validatePhone(string $phone): string
    {
        return substr_replace(str_replace(array("-", "(", ")"," "), "", $phone), '+359', 0, 1);
    }

    /**
     * Hashing of password
     * @param string $pass
     *
     * @return string
     */
    public function hashPassword(string $pass): string
    {
        return password_hash($pass, PASSWORD_DEFAULT);
    }
}