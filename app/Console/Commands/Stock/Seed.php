<?php

namespace App\Console\Commands\Stock;

use Illuminate\Console\Command;
use Tagd\Core\Database\Seeders\Items\StockSeeder;
use Tagd\Core\Models\Actor\Retailer;
use Tagd\Core\Models\Item\Type;

class Seed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock:seed {retailerEmail}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds a retailer stock';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(StockSeeder $seeder)
    {
        $retailerEmail = $this->argument('retailerEmail');

        $retailer = Retailer::where('email', $retailerEmail)->firstOrFail();

        $type = Type::fromName(
            $this->choice(
                'What type of stock?',
                Type::names(),
            )
        );

        $total = $this->ask('How many?');

        $seeder->run([
            'truncate' => 'false',
            'retailerId' => $retailer->id,
            'total' => $total,
            'type' => $type,
        ]);

        $this->info('done');

        return Command::SUCCESS;
    }
}
