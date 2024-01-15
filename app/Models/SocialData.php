<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialData extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_platform',
        'total_visits',
        'page_views',
        'unique_visitors',
        'followers',
        'likes',
        'tweets',
        'priority',
    ];

    static function storeData($request) {

        $data = new self;
        $data->social_platform = request('social_platform');
        $data->total_visits = request('total_visits');
        $data->page_views = request('page_views');
        $data->unique_visitors = request('unique_visitors');
        $data->followers = request('followers');
        $data->likes = request('likes');
        $data->tweets = request('tweets');
        $data->priority = request('priority');

        $data->save();

        return $data;
    }

    static function updateData($request,$id) {

        $data = self::findorFail($id);
        $data->social_platform = request('social_platform');
        $data->total_visits = request('total_visits');
        $data->page_views = request('page_views');
        $data->unique_visitors = request('unique_visitors');
        $data->followers = request('followers');
        $data->likes = request('likes');
        $data->tweets = request('tweets');
        $data->priority = request('priority');

        $data->save();

        return $data;
    }
}
