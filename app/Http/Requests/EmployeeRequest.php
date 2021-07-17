<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => ['required', 'min:2', 'max: 100', 'string'],
            'cpf' => ['required', 'size:11', 'string'],
            'data_contratacao' => ['required', 'string'],
            'logradouro' => ['required', 'min:2', 'max:255', 'string'],
            'numero' => ['required', 'max:20', 'string'],
            'bairro' => ['required', 'max:50', 'string'],
            'cidade' => ['required', 'max:50', 'string'],
            'complemento' => ['max:50', 'string'],
            'cep' => ['required', 'size:8', 'string'],
            'estado' => ['required', 'size:2', 'string']
        ];
    }

    public function validationData()
    {
        $dados = $this->all();

        $dados['cpf'] = str_replace(['.', '-'], '', $dados['cpf']);
        $dados['cep'] = str_replace('-', '', $dados['cep']);
        $dados['data_contratacao'] = Carbon::createFromFormat('d/m/Y', $dados['data_contratacao'])
                                                ->toDateString();

        $this->replace($dados);

        return $dados;
    }
}
