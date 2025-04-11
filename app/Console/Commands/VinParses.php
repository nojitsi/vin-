<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

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
        $vin = "";
        $r=$guzzle->get("3MW5R1J00L8B15589");
        $d = json_decode($r->getBody(), true);

        $this->info($d);
    }
}
