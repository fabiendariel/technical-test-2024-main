<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreGameRequest extends FormRequest
{

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      '*.GameId' => ['required', 'integer'],
      '*.Status' => ['required', Rule::in('Final')],
      '*.Season' => ['required', 'integer'],
      '*.AwayTeam' => ['required'],
      '*.HomeTeam' => ['required'],
      '*.AwayTeamID' => ['required', 'integer'],
      '*.HomeTeamID' => ['required', 'integer'],
      '*.AwayTeamScore' => ['required', 'integer'],
      '*.HomeTeamScore' => ['required', 'integer'],
      '*.Updated' => ['required', 'date_format:Y-m-d H:i:s'],
      '*.GameEndDateTime' => ['required', 'date_format:Y-m-d H:i:s'],
      '*.DateTime' => ['required', 'date_format:Y-m-d H:i:s'],
    ];
  }

  protected function prepareForValidation()
  {
    $data = [];

    foreach ($this->toArray() as $obj) {
      $obj['GameId'] = $this->GameId ?? null;
      $obj['Status'] = $this->Status ?? null;
      $obj['Season'] = $this->Season ?? null;
      $obj['AwayTeam'] = $this->AwayTeam ?? null;
      $obj['HomeTeam'] = $this->HomeTeam ?? null;
      $obj['AwayTeamID'] = $this->AwayTeamID ?? null;
      $obj['HomeTeamID'] = $this->HomeTeamID ?? null;
      $obj['AwayTeamScore'] = $this->AwayTeamScore ?? null;
      $obj['HomeTeamScore'] = $this->HomeTeamScore ?? null;
      $obj['Updated'] = $this->Updated ?? null;
      $obj['GameEndDateTime'] = $this->GameEndDateTime ?? null;
      $obj['DateTime'] = $this->DateTime->format('Y-m-d') ?? null;
      $data[] = $obj;
    }

    $this->merge($data);
  }
}
