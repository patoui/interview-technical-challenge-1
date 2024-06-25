<?php

namespace App\Http\Requests;

use App\Enums\ParkingSpotType;
use App\Enums\VehicleType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreParkingSpotRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // TODO: add appropriate authorization
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'vehicle_type' => ['required', Rule::enum(VehicleType::class)],
            'license_plate' => ['required', 'string', 'max:8'],
        ];
    }

    public function vehicleType(): VehicleType
    {
        return VehicleType::from($this->vehicle_type);
    }
}
