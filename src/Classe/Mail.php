<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{

    private $api_key = '7dc0b4a2b209f00e82da6747058ab3fe';
    private $api_key_secret = '3e6686788d7614928bc9427ed3b82a85';

    public function send($emailExpediteur, $nomExpediteur, $emailDestinataire, $nomDestinataire, $objet, $contenue)
    {

        // $mj = new Client($this->api_key, $this->api_key_secret, true, ['version' => 'v3.1']);
        // $body = [
        //     'Messages' => [
        //         [
        //             'From' => [
        //                 'Email' => $emailExpediteur,
        //                 'Name' => $nomExpediteur
        //             ],
        //             'To' => [
        //                 [
        //                     'Email' => $emailDestinataire,
        //                     'Name' => $nomDestinataire
        //                 ]
        //             ],
        //             'TemplateID' => 5690103,
        //             'TemplateLanguage' => true,
        //             'Subject' => $objet,
        //             'Variables' => [
        //                 'content' => $contenue,
        //             ]
        //         ]
        //     ]
        // ];
        // $response = $mj->post(Resources::$Email, ['body' => $body]);
        // $response->success();
    }
}
