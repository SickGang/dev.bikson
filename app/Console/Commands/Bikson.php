<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Storage;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

use App\Models\Catalog\Item;
use App\Models\Catalog\Image;

use Illuminate\Support\Facades\Log;

class Bikson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bikson:catalog {mode} {arg?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function saveProduct($products=array())
    {
        if ($products && is_array($products)) {
            foreach ($products as $key => $product) {
                $image_url = '';
                if (@exif_imagetype($product['img_url'])) {
                    $contents = file_get_contents($product['img_url']);
                    // $name = substr($product['img_url'], strrpos($product['img_url'], '/') + 1);
                    $store = Storage::disk('public_images_products')->put($product['prefix_image'].'.jpg', $contents);
                    $image_url = '/images/products/'.$product['prefix_image'].'.jpg';
                    // Log::channel('catalog')->debug($image_url);
                }

                $prefix_intekopt_image = 'https://intekopt.ru/upload/photo/';
                if ($product['img_url']) {
                    for ($i=0; $i < 10; $i++) {
                        if (@exif_imagetype($prefix_intekopt_image.$product['prefix_image'].'/'.$i.'.jpg')) {
                            // $contents = file_get_contents($product['img_url']);
                            // $store = Storage::disk('public_images_products')->put($product['prefix_image'].'.jpg', $contents);
                            $image_url = '/images/products/'.$product['prefix_image'].'_'.$i.'.jpg';
                            Log::channel('catalog')->debug($image_url);
                        }
                    }
                }


                // $item = Item::where('api_inteksar_id', $product['id'])->first();
                // if (!$item) {
                //     $item = new Item;
                // }
                // $item->category = $product['category'];
                // $item->title = $product['title'];
                // $item->quantity = $product['quantity'];
                // $item->price = $product['price'];
                // $item->img_url = $image_url;
                // $item->inv_code = $product['inv_code'];
                // $item->api_inteksar_id = $product['id'];
                // $item->save();
                // echo date('Y-m-d H:i:s').' save product id = '.$item->id."\n";
            }
        }

        return 0;
    }

    private function syncCatalog()
    {
        $guzzle = new Client(['timeout'  => 300.0]);
        try {
            $result = $guzzle->get('http://api.inteksar.ru/bikson/get');
            // echo $result->getBody()->getContents();
            if (!empty($result->getBody()->getContents())) {
                // Log::channel('catalog')->debug(json_decode($result->getBody(), true));
                $this->saveProduct(json_decode($result->getBody(), true));
            }
        } catch (RequestException $e) {
            echo "RequestException\n" . Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        } catch (Exception $e) {
            echo 'Выброшено исключение: '.$e->getMessage()."\n";
            sleep(5);
            $this->syncCatalog();
        }

        return 0;
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $mode = $this->argument('mode');
        $arg = $this->argument('arg');
        $args = $this->argument();

        echo "Mode is ".$mode."\n";
        switch ($mode) {
            case 'sync':
                $this->syncCatalog();
                break;

            default:
                echo "Неизвестный режим";
                break;
        }

        return 0;
    }
}
