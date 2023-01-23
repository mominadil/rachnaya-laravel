<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\BooksController;

class StoreApiResponse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:api-response {chunk_size}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch books from API and store them in the database.';

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
    public function handle()
    {
        
        $chunk_size = $this->argument('chunk_size');
        (new BooksController)->fetchBooks($chunk_size);
        $this->info('API response stored successfully!');
    }
}
