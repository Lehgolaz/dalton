<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityStoreRequest;
use App\Models\Entity;
use App\Http\Requests\StoreEntityRequest;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entities = Entity::paginate(10);

        return response()->json(['data' => $entities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEntityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEntityRequest $request)
    {
        $data = $request->validated();

        $entity = Entity::create($data);

        return response()->json($entity, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entity = Entity::find($id);

        if (!$entity) {
            return response()->json(['error' => 'Entidade não encontrada.'], 404);
        }

        return response()->json(['data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EntityStoreRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EntityStoreRequest $request, $id)
    {
        $entity = Entity::find($id);

        if (!$entity) {
            return response()->json(['error' => 'Entidade não encontrada.'], 404);
        }

        $data = $request->validated();

        $entity->update($data);

        return response()->json(['data' => $entity]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entity = Entity::find($id);

        if (!$entity) {
            return response()->json(['error' => 'Entidade não encontrada.'], 404);
        }

        // Verificar se há endereços associados antes de excluir
        if ($entity->addresses->count() > 0) {
            return response()->json(['error' => 'Esta entidade possui endereços associados e não pode ser excluída.'], 400);
        }

        $entity->delete();

        return response()->json(['message' => 'Entidade deletada com sucesso.'], 200);
    }
}