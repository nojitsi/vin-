<?php

namespace App\Console\Commands;

use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use PHPHtmlParser\Dom;
use PHPHtmlParser\Exceptions\ChildNotFoundException;
use PHPHtmlParser\Exceptions\CircularException;
use PHPHtmlParser\Exceptions\StrictException;


class VinParses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vin';

    /**
     * Execute the console command.
     */
    public function handle(Client $guzzle)
    {
        $vin = "3MW5R1J00L8B15589";
        $jar = new CookieJar(false);
        try {
            $response = $guzzle->get('proxy', [
                'query' => ['vin' => $vin]
            ]);
            $html = $response->getBody();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }

        $dom = new Dom;
        try {
            $dom->loadStr($html);
        } catch (ChildNotFoundException|CircularException|StrictException $exception) {
            dd($exception->getMessage());
        }
        $a = $dom->find('a')[0];
        echo $a->text; // "click here"






        /*        $client = new Client(['cookies' => new FileCookieJar('cookies.txt')]);

                $client->getConfig('handler')->push(CloudflareMiddleware::create());

                $res = $client->request('GET', 'http://www.exemple.com/');
                echo $res->getBody();
                $this->info($d); */
    }
}
