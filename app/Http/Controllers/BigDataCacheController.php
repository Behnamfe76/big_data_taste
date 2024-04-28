<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBigDataCacheRequest;
use App\Http\Requests\UpdateBigDataCacheRequest;
use App\Models\BigDataCache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;

class BigDataCacheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->search) {
            if ($request->has('page')) {
                $redisKey = 'big_data_cached_page_' . $request->query('page') . '_search_' . $request->search;
            } else {
                $redisKey = 'big_data_cached_page_' . 1 . '_search_' . $request->search;
            }
            $expirationTimeInSeconds = 1800;

            if (Redis::exists($redisKey)) {
                $big_data = unserialize(Redis::get($redisKey));
            } else {
                $big_data = BigDataCache::query()
                    ->when($request->search, function ($query, $search) {
                        $query->where('title', 'LIKE', "%" . $search . "%");
                    })
                    ->select('id', 'title', 'body', 'image', 'country', 'city', 'address', 'created_at')
                    ->orderByDesc('created_at')
                    ->paginate(15)
                    ->withQueryString();

                Redis::setex($redisKey, $expirationTimeInSeconds,  serialize($big_data));
            }
        } else {
            if ($request->has('page')) {
                $redisKey = 'big_data_cached_page_' . $request->query('page');
            } else {
                $redisKey = 'big_data_cached_page_' . 1;
            }
            $expirationTimeInSeconds = 1800;

            if (Redis::exists($redisKey)) {
                $big_data = unserialize(Redis::get($redisKey));
            } else {
                $big_data = BigDataCache::select('id', 'title', 'body', 'image', 'country', 'city', 'address', 'created_at')
                    ->orderByDesc('created_at')
                    ->paginate(15)
                    ->withQueryString();

                Redis::setex($redisKey, $expirationTimeInSeconds,  serialize($big_data));
            }
        }

        return Inertia::render('CachedData/Index', [
            'data' => $big_data,
            'searchParam' => $request->search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CachedData/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBigDataCacheRequest $request)
    {
        BigDataCache::create([
            'title' => $request->title,
            'body' => 'Rerum repellat harum tempore exercitationem. Harum vel qui eius commodi velit fugiat. Maxime et laudantium voluptas aut laboriosam. Iusto provident quam est et sed.',
            'image' => '/var/folders/ln/c8y8x9ys4xbgwn0z62ctwkq00000gn/T/67e86ec524a099e8b51c80dcf872d87c.png',
            'country' => 'france',
            'city' => 'paris',
            'address' => 'Rerum voluptatem',
            'email' => 'behnam@gmail.com',
            'test5' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
            'test6' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
            'test7' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
            'test8' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
            'test9' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
            'test10' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
            'test11' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
            'test12' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
            'test13' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(BigDataCache $bigDataCache)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = BigDataCache::find($id);
        return Inertia::render('CachedData/Edit', [
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBigDataCacheRequest $request, $id)
    {
        BigDataCache::find($id)->update([
            'title' => $request->title,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        BigDataCache::find($id)->delete();
    }
}
