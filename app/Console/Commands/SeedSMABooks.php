<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedSMABooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:sma-books';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed SMA books for SMAN 1 Dayeuhkolot';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Seeding SMA books for SMAN 1 Dayeuhkolot...');
        
        $this->call('db:seed', [
            '--class' => 'Database\\Seeders\\SMABooksSeeder'
        ]);
        
        $this->info('SMA books seeded successfully!');
        
        return Command::SUCCESS;
    }
}
