<?php

namespace App\Http\Controllers\Album;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AlbumRepository;

class AlbumController extends Controller
{
    protected $AlbumRepository;
    public function __construct(
        AlbumRepository $AlbumRepository
    )
    {
        $this->AlbumRepository = $AlbumRepository;
    }
    public function getAlbumByLop($lop_id){
        return $this->AlbumRepository->getAlbumByLop($lop_id);
    }

    // public function get3ImageFirst($lop_id){
    //     $first_album =  $this->AlbumRepository->getFirstAlbumLop($lop_id);
    //     $imageParse = json_decode($data[$i]['item_images']);

    // }
}
