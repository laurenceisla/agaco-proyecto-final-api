<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\Venta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        $query = Venta::query();

        switch (auth()->user()->perfil->nombre) {
            case 'VENDEDOR':
                $query = $query->where('vendedor_id', auth()->id());
            case 'COORDINADOR':
                $query = $query->orderBy('fecha_compra');
                break;
            case 'TRANSPORTISTA':
            case 'ESPECIALISTA':
                $query = $query->whereHas('servicios', function (Builder  $inner) {
                    $inner->where('operador_id', auth()->id())->orderBy('fecha_servicio');
                });
                break;
        }

        return $query->paginate(10);
    }

    public function registrar(Request $request)
    {
        $this->authorize('registrar-venta');

        $data = $request->validate([
            'tipo_documento_id' => 'required|exists:App\Models\TipoDocumentoIdentidad,id',
            'nro_documento' => 'required|digits_between:8,15',
            'ape_paterno' => 'required|string',
            'ape_materno' => 'required|string',
            'nombres' => 'required|string',
            'telefono' => 'required|integer',
            'direccion' => 'required|string',
            'distrito_id' => 'required|exists:App\Models\Distrito,id',
            'producto_id' => 'required|exists:App\Models\Producto,id',
            'fecha_compra' => 'required|date',
            'solicita_entrega' => 'boolean',
            'solicita_armado' => 'boolean',
        ]);

        $cliente = Cliente::updateOrCreate(
            [
                'tipo_documento_id' => $data['tipo_documento_id'],
                'nro_documento' => $data['nro_documento'],
            ],
            [
                'ape_paterno' => $data['ape_paterno'],
                'ape_materno' => $data['ape_materno'],
                'nombres' => $data['nombres'],
                'telefono' => $data['telefono'],
                'direccion' => $data['direccion'],
                'distrito_id' => $data['distrito_id'],
            ]
        );

        $venta = new Venta;

        $venta->cliente_id = $cliente->id;
        $venta->vendedor_id = auth()->user()->id;
        $venta->producto_id = $data['producto_id'];
        $venta->telefono = $data['telefono'];
        $venta->direccion = $data['direccion'];
        $venta->distrito_id = $data['distrito_id'];
        $venta->fecha_compra = $data['fecha_compra'];
        $venta->solicita_entrega = $data['solicita_entrega'];
        $venta->solicita_armado = $data['solicita_armado'];

        $venta->save();

        return [
            "message" => "Se realizó la venta con éxito"
        ];
    }

    public function show(Request $request, $id)
    {
        return Venta::findOrFail($id);
    }

    public function asignarOperador(Request $request)
    {
        $this->authorize('asignar-operador');

        $data = $request->validate([
            'venta_id' => 'required|integer|exists:App\Models\Venta,id',
            'servicio_id' => 'integer|nullable',
            'tipo_servicio_id' => 'required|integer|exists:App\Models\TipoServicio,id',
            'operador_id' => 'required|integer|exists:App\Models\User,id',
            'fecha_servicio' => 'required|date',
        ]);

        $servicio = Servicio::find($data['servicio_id']) ?? new Servicio;

        $servicio->venta_id = $data['venta_id'];
        $servicio->tipo_servicio_id = $data['tipo_servicio_id'];
        $servicio->operador_id = $data['operador_id'];
        $servicio->fecha_servicio = $data['fecha_servicio'];

        if (!$servicio->nro_conformidad_servicio) {
            $servicio->nro_conformidad_servicio = $this->generarNroServicio();
        }

        $servicio->save();

        return [
            "message" => "Se asignó operador con éxito"
        ];
    }

    public function cerrarServicio(Request $request, $id)
    {
        $servicio = Servicio::findOrFail($id);

        $this->authorize('cerrar-servicio', $servicio);

        $data = $request->validate([
            /*'hay_error_servicio' => 'nullable',
            'observaciones' => 'nullable',*/
            'fecha_cierre' => 'required|date|after:fecha_servicio',
        ]);

        /*$servicio->hay_error_servicio = $data['hay_error_servicio'] ?? false;
        $servicio->observaciones = $data['observaciones'];*/
        $servicio->hay_error_servicio = false;
        $servicio->observaciones = 'Sin observaciones';
        $servicio->fecha_cierre = $data['fecha_cierre'];

        $servicio->save();

        return [
            "message" => "Se completó el servicio con éxito"
        ];
    }

    protected function generarNroServicio()
    {
        $servicio = Servicio::orderBy('nro_conformidad_servicio', 'desc')->first();
        $ultimoNumero = $servicio ? $servicio->nro_conformidad_servicio : 0;

        return str_pad($ultimoNumero + 1, 6, '0', STR_PAD_LEFT);
    }
}
