<?php 
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\CurrencyProject\Currency;
use Illuminate\Support\Facades\Log;


class CurrencyService{

    public static function  get_data_from_NBP_API(){
        $response = Http::acceptJson()->get('http://api.nbp.pl/api/exchangerates/tables/A/');
        if ($response->successful() ){ 
           $data = $response->json()[0]['rates'];

           $data = array_map(function($data) {
               return array(
                   'name' => $data['currency'],
                   'currency_code' => $data['code'], // we have to translate Response from NBP api so we coud insert thoes data in proper columns
                   'exchange_rate' => $data['mid']
               );
           }, $data);
        }
        else {  
            Log::channel('currencyProject')->info(now()->toDateTimeString() . ' import from NBP failed ');
        }
        return $data;

    }

    public function insert_data_to_database(){

        $data = CurrencyService::get_data_from_NBP_API();

        foreach($data as $d){
            $currency = Currency::where('name',$d['name']);
        if ($currency->exists()){
            try {
                $currency->update(['exchange_rate' => $d['exchange_rate'] ]);
            }catch(\Exception $e){
                Log::channel('currencyProject')->info(now()->toDateTimeString() . ' import failed messeage: ' . $e->getMessage());
            } 
        }
        else{
            try{
                Currency::insert($data);
                Log::channel('currencyProject')->info(now()->toDateTimeString() . ' succes import');
            } catch(\Exception $e){
                Log::channel('currencyProject')->info(now()->toDateTimeString() . ' import failed messeage: ' . $e->getMessage());
            } 
        }
     
    }
    }
}
