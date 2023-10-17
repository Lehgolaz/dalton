<?php

namespace App\Http\Controllers;

use App\Models\Stores;
use App\Http\Requests\UpdateStoresRequest;
use App\Http\Requests\StoreStoresRequest;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Stores::paginate(10);

        return response()->json(['data' => $stores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoresRequest $request)
    {
        $data = $request->validated();

        $store = Stores::create($data);

        return response()->json($store, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = Stores::find($id);

        if (!$store) {
            return response()->json(['error' => 'Loja não encontrada.'], 404);
        }

        return response()->json(['data' => $store]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ZipCodeUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoresRequest $request, $id)
    {
        $store = Stores::find($id);

        if (!$store) {
            return response()->json(['error' => 'Loja não encontrada.'], 404);
        }

        $data = $request->validated();

        $store->update($data);

        return response()->json(['data' => $store]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Stores::find($id);

        if (!$store) {
            return response()->json(['error' => 'Loja não encontrada.'], 404);
        }

        // Verificar se há listas de preços associadas antes de excluir
        if ($store->priceList->count() > 0) {
            return response()->json(['error' => 'Esta loja possui listas de preços associadas e não pode ser excluída.'], 400);
        }

        $store->delete();

        return response()->json(['message' => 'Loja deletada com sucesso.'], 200);
    }
}