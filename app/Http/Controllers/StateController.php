<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Http\Requests\StateStoreRequest;
use App\Http\Requests\StateUpdateRequest;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::paginate(10);

        return response()->json(['data' => $states]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StateStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateStoreRequest $request)
    {
        $data = $request->validated();

        $state = State::create($data);

        return response()->json($state, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $state = State::find($id);

        if (!$state) {
            return response()->json(['error' => 'Estado não encontrado.'], 404);
        }

        return response()->json(['data' => $state]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StateUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StateUpdateRequest $request, $id)
    {
        $state = State::find($id);

        if (!$state) {
            return response()->json(['error' => 'Estado não encontrado.'], 404);
        }

        $data = $request->validated();

        $state->update($data);

        return response()->json(['data' => $state]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = State::find($id);

        if (!$state) {
            return response()->json(['error' => 'Estado não encontrado.'], 404);
        }

        // Verificar se há cidades associadas antes de excluir
        if ($state->cities->count() > 0) {
            return response()->json(['error' => 'Este estado possui cidades associadas e não pode ser excluído.'], 400);
        }

        $state->delete();

        return response()->json(['message' => 'Estado deletado com sucesso.'], 200);
    }
}