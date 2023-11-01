<?php

namespace App\Services;

class SessionMessageService
{
    const SUCCESS_MESSAGE_KEY = 'success_message';
    const ERROR_MESSAGE_KEY = 'error_message';


    public function setFlashMessage($key, $message): void
    {
        session()->flash($key, $message);
    }

    public function setSuccessMessage($message): void
    {
        $this->setFlashMessage(self::SUCCESS_MESSAGE_KEY, $message);
    }

    public function setErrorMessage($message): void
    {
        $this->setFlashMessage(self::ERROR_MESSAGE_KEY, $message);
    }
}
