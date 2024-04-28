<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBigDataRequest;
use App\Http\Requests\UpdateBigDataRequest;
use App\Models\BigData;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class BigDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $big_data = BigData::query()
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('title', 'LIKE', "%" . $search . "%");
            })
            ->select('id', 'title', 'body', 'image', 'country', 'city', 'address', 'created_at')
            ->orderByDesc('created_at')
            ->paginate(5)
            ->withQueryString();
        return Inertia::render('OrdinaryData/Index', [
            'data' => $big_data,
            'searchParam' => $request->search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('OrdinaryData/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBigDataRequest $request)
    {
        BigData::create([
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
    public function show(BigData $bigData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = BigData::find($id);
        return Inertia::render('OrdinaryData/Edit', [
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBigDataRequest $request, $id)
    {
        BigData::find($id)->update([
            'title' => $request->title,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        BigData::find($id)->delete();
    }
}
