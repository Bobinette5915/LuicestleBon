<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{

    private $api_key = '2dd0be465b7c3d9fcb9b21fdb2b2db55';
    private $api_key_secret = '95eb49756f632eadf1d62d80a3e778aa';

    public function send($emailExpediteur, $nomExpediteur, $emailDestinataire, $nomDestinataire, $objet, $contenue)
    {

        $mj = new Client($this->api_key, $this->api_key_secret, true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => $emailExpediteur,
                        'Name' => $nomExpediteur
                    ],
                    'To' => [
                        [
                            'Email' => $emailDestinataire,
                            'Name' => $nomDestinataire
                        ]
                    ],
                    'TemplateID' => 5734084,
                    'TemplateLanguage' => true,
                    'Subject' => $objet,
                    'Variables' => [
                        'content' => $contenue,
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    }
}
