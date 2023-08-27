<?php

namespace Rpmeir\TGRecaptcha;

use Adianti\Validator\TFieldValidator;

class TGRecaptchaValidator extends TFieldValidator
{
    public function validate($label, $value, $params = null)
    {
        if(!value)
        {
            throw new Exception("O campo {$label} é obrigatório");
        }

        $recaptcha_config = require_once('app/config/recaptcha.php');
        $recaptcha = new \ReCaptcha\ReCaptcha($recaptcha_config['chave_secreta']);
        $resp = $recaptcha->setExpectedHostname($_SERVER["SERVER_NAME"])
            ->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

        if (!$resp->isSuccess())
        {
            throw new Exception("O {$label} é inválido!");
        }
    }
}