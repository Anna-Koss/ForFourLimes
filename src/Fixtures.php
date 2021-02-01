<?php


namespace App;


class Fixtures
{
    private const CHARS_A = [
        'e','y','u','i','o','a'
    ];

    private const CHARS_B = [
        'q','w','r','t','p','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m'
    ];

    public function generateUsers(int $count)
    {
        $users = [];
        for($i = 0; $i < $count; $i++) {
            $firstName = $this->generateFirstName();
            $lastName = $this->generateLastName();
            $users[] = [
                'first_name' => ucfirst($firstName), //upper case first
                'last_name' => ucfirst($lastName),
                'phone' => '+38(097)' . random_int(1000000, 9999999),
                'email' => "{$firstName}.{$lastName}@email.com"
            ];
        }
        return $users;
    }


    private function generateFirstName(int $minLength = 4, int $maxLength = 6)
    {
        $firstName = '';
        $length = random_int($minLength, $maxLength);
        for($i = 0; $i < $length; $i++) {
            if ($i % 2 === 0) {
                $char = self::CHARS_B[random_int(0, count(self::CHARS_B) - 1)];
            } else {
                $char = self::CHARS_A[random_int(0, count(self::CHARS_A) - 1)];
            }
            $firstName .= $char;
        }
        return $firstName;
    }

    private function generateLastName(int $minLength = 5, int $maxLength = 8)
    {
        $lastName = '';
        $length = random_int($minLength, $maxLength);
        for($i = 0; $i < $length; $i++) {
            if ($i % 2 === 0) {
                $char = self::CHARS_B[random_int(0, count(self::CHARS_B) - 1)];
            } else {
                $char = self::CHARS_A[random_int(0, count(self::CHARS_A) - 1)];
            }
            $lastName .= $char;
        }
        return $lastName;
    }
}