<?php

namespace App\Domains\GameConsign\Http\Controllers;

use App\Domains\GameConsign\Http\Requests\AnagramRequest;
use App\Domains\GameConsign\Http\Requests\GetMarvelCharacterRequest;
use App\Helpers\ResponseHelper;
use App\Helpers\Vendors\MarvelHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Traits\PaginationTrait;
use App\Vendors\Marvel;
use Illuminate\Pagination\LengthAwarePaginator;
use VendorHelper;

class GameConsignController extends Controller
{
    use PaginationTrait;
    public function __construct()
    {
        #Load config
        VendorHelper::LoadConfig();
    }

    public function Anagrams(AnagramRequest $request){
        if(($validate = ResponseHelper::RequestValidate($request))['validate'] == false){
            return ResponseHelper::json($validate['data'], 406, 'Failed Validation');
        };
        $array = $validate['data']['input'];
        $result = [];

        foreach ($array as $word) {
            $sortedWord = str_split($word);
            sort($sortedWord);
            $sortedWord = implode('', $sortedWord);

            if (array_key_exists($sortedWord, $result)) {
                $result[$sortedWord][] = $word;
            } else {
                $result[$sortedWord] = [$word];
            }
        }

        $result = array_values($result);
        return ResponseHelper::json($result, 200, "Anagram Functions");
    }

    public function getMarvelCharacters(GetMarvelCharacterRequest $request){
        if(($validate = ResponseHelper::RequestValidate($request))['validate'] == false){
            return ResponseHelper::json($validate['data'], 406, 'Failed Validation');
        };
        $result = Marvel::getCharacters($request->all());
        return ResponseHelper::json($result['data'], $result['statusCode'], "Marvel Functions");
    }

    public function getMarvelCharactersWithPagination(GetMarvelCharacterRequest $request, $perPage){
        if(($validate = ResponseHelper::RequestValidate($request))['validate'] == false){
            return ResponseHelper::json($validate['data'], 406, 'Failed Validation');
        };
        $result = Marvel::getCharacters($request->except(['page']));
        $collection = collect($result['data']['results']);
        $data = [];
        foreach($result['data']['results'] as $key => $res){
            $data[]=$res;
        }
        $paginator=$this->paginate($data, $perPage,$request->get('page'));
        return ResponseHelper::json($paginator, $result['statusCode'], "Marvel Functions");
    }

    public function getMarvelCharactersAuth(GetMarvelCharacterRequest $request){
        if(($validate = ResponseHelper::RequestValidate($request))['validate'] == false){
            return ResponseHelper::json($validate['data'], 406, 'Failed Validation');
        };
        $result = Marvel::getCharacters($request->all());
        return ResponseHelper::json($result['data'], $result['statusCode'], "Marvel Functions");
    }

    public function Nparam($n=3){
        // $topBottom = str_repeat('+', $n) . PHP_EOL;
        $middle = '';
        $max = 0;
        $iter = ((int)$n)-1;
        $test = ['++-++','+---+','-----'];

        for ($i = 0; $i < $n;) {
            $middle .=  $test[$i].PHP_EOL;
            if($max == false){
                $i++;
            }
            if($i==($n-1) || $max==true){
                $iter--;
                $max=true;
                $middle .=  $test[$i].PHP_EOL;
                $i=$i-1;
            }
            if($iter<=0){
                break;
            }
        }

        return $middle;
    }
}
