<?php

namespace App\Contract;

interface AuthBaseContract
{
    public function login(array $credentials);

    public function register(array $payloads, $assignRole = []);

    public function logout();

    public function profile();

    public function update(array $payloads, $assignRole = []);

    public function sendOTP(array $payloads);

    public function validateOTP(array $payloads);

    public function resetPassword(array $payloads);

    public function refreshToken();
}
