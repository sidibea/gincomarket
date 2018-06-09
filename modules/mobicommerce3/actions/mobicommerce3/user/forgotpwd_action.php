<?php
$GLOBALS["PeeYuAVcvDYxitRACSyw"]=base64_decode("QW4gZXJyb3Igb2NjdXJyZWQgd2hpbGUgc2VuZGluZyB0aGUgZW1haWwu");$GLOBALS["clDBUEZYNUFAaVDeeJcN"]=base64_decode("U2hvcHBpbmdDYXJ0");$GLOBALS["zyCDQPaTqgmxkQFUGvGF"]=base64_decode("Y2FydF9kZXRhaWxz");$GLOBALS["iKLyShFQlpjmJpFfaoec"]=base64_decode("IA==");$GLOBALS["gMgaAUwbMnadAJXdLjpx"]=base64_decode("UGFzc3dvcmQgcXVlcnkgY29uZmlybWF0aW9u");$GLOBALS["gYdRUwjsnpmYFUJQQNdJ"]=base64_decode("cGFzc3dvcmRfcXVlcnk=");$GLOBALS["jkdxUJtvcZigjDXy"]=base64_decode("JmlkX2N1c3RvbWVyPQ==");$GLOBALS["kyYdwFcfMicwiwSgjWhl"]=base64_decode("dG9rZW49");$GLOBALS["qhJymdWpyVJoFTtbyogs"]=base64_decode("cGFzc3dvcmQ=");$GLOBALS["RTxfwZQIIozDKaOi"]=base64_decode("e3VybH0=");$GLOBALS["PuQuMLIRBbfHrBQKeWHM"]=base64_decode("e2ZpcnN0bmFtZX0=");$GLOBALS["wBzUMnRaFxYCvTwYidFf"]=base64_decode("e2xhc3RuYW1lfQ==");$GLOBALS["ACVQhyvmpAAGAvCuYwTa"]=base64_decode("e2VtYWlsfQ==");$GLOBALS["yFHrTSnlhBdjRAORlkk"]=base64_decode("WW91IGNhbiByZWdlbmVyYXRlIHlvdXIgcGFzc3dvcmQgb25seSBldmVyeSAlZCBtaW51dGUocyk=");$GLOBALS["KSnaKwUFRWrzLlFxxfAA"]=base64_decode("IG1pbnV0ZXM=");$GLOBALS["ORiQcwxRUgkUGshQDXPa"]=base64_decode("UFNfUEFTU1dEX1RJTUVfRlJPTlQ=");$GLOBALS["YZKtjOFPvKlwsKvkzoNC"]=base64_decode("Kw==");$GLOBALS["eklsbKUhiqTjVWrQnvcn"]=base64_decode("WW91IGNhbm5vdCByZWdlbmVyYXRlIHRoZSBwYXNzd29yZCBmb3IgdGhpcyBhY2NvdW50Lg==");$GLOBALS["EzUeyKaxNWXGIQozSAR"]=base64_decode("VGhlcmUgaXMgbm8gYWNjb3VudCByZWdpc3RlcmVkIGZvciB0aGlzIGVtYWlsIGFkZHJlc3Mu");$GLOBALS["lxJuPRqZoSfNgzJOudsg"]=base64_decode("SW52YWxpZCBlLW1haWwgYWRkcmVzcw==");$GLOBALS["VwCGqpUwTcGsnqOFNfAB"]=base64_decode("ZW1haWw=");$GLOBALS["PdepTkCacGhHbSYynMub"]=base64_decode("SFRUUC8xLjEgNDA0IE5vdCBGb3VuZA==");$GLOBALS["QIfjBqYCYzCTbgddRxFH"]=base64_decode("SU5fTU9CSUNPTU1FUkNF");
?><?php


if (!defined($GLOBALS["QIfjBqYCYzCTbgddRxFH"]))
{
    header($GLOBALS["PdepTkCacGhHbSYynMub"]);
    die();
}

class mobicommerce3_user_forgotpwd_action extends BaseAction
{
    public function execute()
    {
        $username = Tools::getValue($GLOBALS["VwCGqpUwTcGsnqOFNfAB"]);
        $customer = new Customer();
        
        if (empty($username) || !Validate::isEmail($username))
        {
            $this->setError(MobicommerceResult::ERROR_USER_INVALID_USER_DATA, array(Tools::displayError('Invalid e-mail address')));
            return;
        }

        $customer->getByEmail($username);

        if (!Validate::isLoadedObject($customer))
        {
			$this->setError(MobicommerceResult::ERROR_USER_INVALID_USER_DATA, array(Tools::displayError('There is no account registered for this email address.')));
            return;
        }
		else if(!$customer->active)
        {
			$this->setError(MobicommerceResult::ERROR_USER_INVALID_USER_DATA, array(Tools::displayError('You cannot regenerate the password for this account.')));
            return;
		}
		else if ((strtotime($customer->last_passwd_gen.$GLOBALS["YZKtjOFPvKlwsKvkzoNC"].($min_time = (int)Configuration::get($GLOBALS["ORiQcwxRUgkUGshQDXPa"])).$GLOBALS["KSnaKwUFRWrzLlFxxfAA"]) - time()) > 0)
        {
			$this->setError(MobicommerceResult::ERROR_USER_INVALID_USER_DATA, array(sprintf(Tools::displayError('You can regenerate your password only every %d minute(s)'), (int)$min_time)));
            return;
		}
		$context = Context::getContext();
        $mail_params = array(
            '{email}'     => $customer->email,
            '{lastname}'  => $customer->lastname,
            '{firstname}' => $customer->firstname,
            '{url}'       => $context->link->getPageLink('password', true, null, 'token='.$customer->secure_key.'&id_customer='.(int)$customer->id)
		);
		if (Mail::Send($context->language->id, $GLOBALS["gYdRUwjsnpmYFUJQQNdJ"], Mail::l($GLOBALS["gMgaAUwbMnadAJXdLjpx"]), $mail_params, $customer->email, $customer->firstname.$GLOBALS["iKLyShFQlpjmJpFfaoec"].$customer->lastname))
        {
			$this->setSuccess(array($GLOBALS["zyCDQPaTqgmxkQFUGvGF"] => ServiceFactory::factory($GLOBALS["clDBUEZYNUFAaVDeeJcN"])->get()));
		}
		else
        {
		 	$this->setError(MobicommerceResult::ERROR_USER_INVALID_USER_DATA, array(Tools::displayError('An error occurred while sending the email.')));
            return;
        }
    }
}
 ?>