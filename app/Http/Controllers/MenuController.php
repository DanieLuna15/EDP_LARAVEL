<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuRol;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $includeInactive = $request->boolean('with_inactive', false);

        $query = Menu::with([
            'subMenuN1' => function ($builder) use ($includeInactive) {
                if ($includeInactive) {
                    $builder->where('estado', '!=', 0);
                } else {
                    $builder->where('estado', 1);
                }
                $builder->orderBy('order', 'asc');
            },
            'subMenuN1.children' => function ($builder) use ($includeInactive) {
                if ($includeInactive) {
                    $builder->where('estado', '!=', 0);
                } else {
                    $builder->where('estado', 1);
                }
                $builder->orderBy('order', 'asc');
            },
        ])->whereNull('menu_id')->orderBy('order', 'asc');

        if ($includeInactive) {
            $query->where('estado', '!=', 0);
        } else {
            $query->where('estado', 1);
        }

        return $query->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if (array_key_exists('estado', $input)) {
            $estado = (int) $input['estado'];
            $input['estado'] = in_array($estado, [0, 1, 2], true) ? $estado : 1;
        } else {
            $input['estado'] = 1;
        }
        return Menu::create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $menu  = Menu::findOrFail($id);

        if (array_key_exists('label', $input)) {
            $menu->label = $input['label'];
        }
        if (array_key_exists('icon', $input) && $input['icon']) {
            $menu->icon = $input['icon'];
        }
        if (array_key_exists('route', $input)) {
            $menu->route = $input['route'];
        }
        if (array_key_exists('estado', $input)) {
            $estado = (int) $input['estado'];
            $menu->estado = in_array($estado, [0, 1, 2], true) ? $estado : $menu->estado;
        }
        if (array_key_exists('order', $input)) {
            $menu->order = $input['order'];
        }
        if (array_key_exists('menu_id', $input)) {
            $menu->menu_id = $input['menu_id'];
        }
        if (array_key_exists('level', $input)) {
            $menu->level = $input['level'];
        }

        $menu->save();

        return $menu->fresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Desactivar (soft disable) cambiando estado = 0 en lugar de eliminar
        $menu = Menu::findOrFail($id);
        $menu->estado = 0;
        $menu->save();
        return response()->json(['status' => 'disabled', 'id' => $menu->id]);
    }
    public function cambiarOrden(Request $request)
    {
        $input = $request->all();

        $draggedId    = $input['dragged_id'];
        $draggedOrder = $input['dragged_order'];

        $relatedId    = $input['related_id'];
        $relatedOrder = $input['related_order'];

        $menu1 = Menu::find($draggedId);
        $menu2 = Menu::find($relatedId);

        $order1 = $menu1->order;
        $order2 = $menu2->order;

        $menu2->order = $order1;
        $menu1->order = $order2;

        $menu2->save();
        $menu1->save();

        return $menu1;
    }
}
