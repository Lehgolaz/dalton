<?php

namespace App\Http\Controllers;

use App\Models\PriceList;
use App\Http\Requests\PriceListStoreRequest;
use App\Http\Requests\PriceListUpdateRequest;

class PriceListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $priceLists = PriceList::paginate(10);

        return response()->json(['data' => $priceLists]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PriceListStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PriceListStoreRequest $request)
    {
        $data = $request->validated();

        $priceList = PriceList::create($data);

        return response()->json($priceList, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $priceList = PriceList::find($id);

        if (!$priceList) {
            return response()->json(['error' => 'Lista de Preços não encontrada.'], 404);
        }

        return response()->json(['data' => $priceList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PriceListUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PriceListUpdateRequest $request, $id)
    {
        $priceList = PriceList::find($id);

        if (!$priceList) {
            return response()->json(['error' => 'Lista de Preços não encontrada.'], 404);
        }

        $data = $request->validated();

        $priceList->update($data);

        return response()->json(['data' => $priceList]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $priceList = PriceList::find($id);

        if (!$priceList) {
            return response()->json(['error' => 'Lista de Preços não encontrada.'], 404);
        }

        // Verificar se há detalhes de orçamento associados antes de excluir
        if ($priceList->budgetDetails->count() > 0) {
            return response()->json(['error' => 'Esta Lista de Preços possui detalhes de orçamento associados e não pode ser excluída.'], 400);
        }

        $priceList->delete();

        return response()->json(['message' => 'Lista de Preços deletada com sucesso.'], 200);
    }
}