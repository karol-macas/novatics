<?php

namespace App\Http\Controllers;

use Botman\Botman\Botman;
use Botman\Botman\BotmanFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ChatbotController extends Controller
{
    public function handle()
    {
        $config = [];
        $botman = BotmanFactory::create($config);

        $botman->hears('{message}', function($bot, $message) {
            // Mensaje de "pensando"
            $bot->reply('Déjame un momento...');

            // Obtén la respuesta de AI
            $response = $this->getAIResponse($message);
            $bot->reply($response);
        });

        $botman->listen();
    }

    private function getAIResponse($message)
    {
        $client = new Client();

        try {
            $response = $client->post('https://api-inference.huggingface.co/models/gpt2', [
                'json' => ['inputs' => $message],
                'headers' => [
                    'Authorization' => 'Bearer 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', // Usa tu token
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            // Ajusta según la estructura de respuesta que recibas
            return $data[0]['generated_text'] ?? 'No tengo una respuesta para eso.';
        } catch (RequestException $e) {
            return 'Lo siento, ha ocurrido un error al comunicarme con el servicio. Inténtalo de nuevo más tarde.';
        } catch (\Exception $e) {
            return 'Ocurrió un error inesperado. Por favor, intenta nuevamente.';
        }
    }
}
