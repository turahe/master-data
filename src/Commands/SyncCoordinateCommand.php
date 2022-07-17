<?php

namespace Turahe\Master\Commands;

use GuzzleHttp\Exception\ServerException;
use Illuminate\Console\Command;
use Turahe\Master\Models\City;
use Turahe\Master\Models\District;
use Turahe\Master\Models\Province;
use Turahe\Master\Models\Village;

class SyncCoordinateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'turahe:master:sync-coordinate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize latitude longitude data in database directly using Google\'s geocoding service';

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
     * @return mixed
     */
    public function handle()
    {
        $count = Province::count();
        $this->info("Processing {$count} Province");
        $bar = $this->output->createProgressBar($count);
        $bar->start();
        Province::cursor()->each(function ($item) use ($bar) {
            $meta = $item->meta;
            $geocoding = \Spatie\Geocoder\Geocoder::getCoordinatesForAddress($item->address);
            $meta['lat'] = $geocoding['lat'] ?? null;
            $meta['long'] = $geocoding['lng'] ?? null;
            $item->meta = $meta;
            $item->save();
            $bar->advance();
        });

        $this->line('');

        $count = City::count();
        $this->info("Processing {$count} City");
        $bar = $this->output->createProgressBar($count);
        $bar->start();
        City::with('province')->cursor()->each(function ($item) use ($bar) {
            $meta = $item->meta;
            $geocoding = \Spatie\Geocoder\Geocoder::getCoordinatesForAddress($item->address);
            $meta['lat'] = $geocoding['lat'] ?? null;
            $meta['long'] = $geocoding['lng'] ?? null;
            $item->meta = $meta;
            $item->save();
            $bar->advance();
        });

        $this->line('');

        $count = District::count();
        $this->info("Processing {$count} District");
        $bar = $this->output->createProgressBar($count);
        $bar->start();
        District::with('city.province')->cursor()->each(function ($item) use ($bar) {
            $meta = $item->meta;
            $geocoding = \Spatie\Geocoder\Geocoder::getCoordinatesForAddress($item->address);
            $meta['lat'] = $geocoding['lat'] ?? null;
            $meta['long'] = $geocoding['lng'] ?? null;
            $item->meta = $meta;
            $item->save();
            $bar->advance();
        });

        $this->line('');

        $count = Village::whereNull('meta')->count();
        $this->info("Processing {$count} Village");
        $bar = $this->output->createProgressBar($count);
        $bar->start();
        Village::whereNull('meta')->cursor()->each(function ($item) use ($bar) {
            $meta = $item->meta;
            if (!$meta) {
                try {
                    $geocoding = \Spatie\Geocoder\Geocoder::getCoordinatesForAddress($item->address);
                    $meta['lat'] = $geocoding['lat'] ?? null;
                    $meta['long'] = $geocoding['lng'] ?? null;
                    $item->meta = $meta;
                    $item->save();
                } catch (ServerException $e) {
                    $this->error($e->getMessage());
                    sleep(1);
                }
            }
            $bar->advance();
        });
    }
}
