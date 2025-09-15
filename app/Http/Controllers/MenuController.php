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
    public function index()
    {
        $menus = Menu::with([
            'subMenuN1' => function ($query) {
                $query->where('estado', true)->orderBy('order', 'asc');
            },
            // Cargar nietos (nivel 2) de cada submenú
            'subMenuN1.children' => function ($query) {
                $query->where('estado', true)->orderBy('order', 'asc');
            },
        ])->whereNull('menu_id')->where('estado', true)->orderBy('order', 'asc')->get();
        return $menus;
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
        $input       = $request->all();
        $menu        = Menu::find($id);
        $menu->label = $input['label'];
        $menu->icon  = $input['icon'];
        $menu->route = $input['route'];
        $menu->save();
        return $menu;
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
        $menu->estado = false;
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
