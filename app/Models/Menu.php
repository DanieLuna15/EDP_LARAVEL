<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Define el nombre de la tabla si es diferente de la convención de nombres de Laravel
    protected $table = "menus";

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'label',
        'icon',
        'route',
        'menu_id',
        'level',
        'order',
        'file',
        'estado',
        'usr_registrado',
        'usr_modificado',
        'usr_eliminado',
    ];

    protected $casts = [
        'estado' => 'integer',
    ];

    // Atributos adicionales que se adjuntarán al array del modelo
    protected $appends = ['icon_mdi', 'icon_menu'];

    /**
     * Obtiene el slug del ícono para usar en un componente de Vue.
     * Por ejemplo, 'mdiCog' se convierte en 'mdi-cog'.
     *
     * @return string
     */
    public function getIconMdiAttribute(): string
    {
        $icon = $this->attributes['icon'];
        $slug = Str::kebab($icon, '_');
        return $slug;
    }

    /**
     * Obtiene la ruta del ícono de Blade para usar en una vista.
     * Por ejemplo, 'mdiCog' se convierte en 'icons.mdiCog'.
     *
     * @return string
     */
    public function getIconMenuAttribute(): string
    {
        $icon = $this->attributes['icon'];
        return "icons." . $icon;
    }

    /**
     * Define la relación recursiva para los submenús.
     * Un menú tiene muchos hijos.
     *
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'menu_id', 'id')
            ->orderBy('order', 'asc');
    }

    /**
     * Define la relación con el menú padre.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    /**
     * Ámbito para obtener solo los menús de nivel superior.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTopLevel($query)
    {
        return $query->where('level', 0)->orWhereNull('menu_id');
    }

    public function subMenuN1()
    {
        return $this->hasMany(Menu::class)->where('level', '=', '1');
    }
}
