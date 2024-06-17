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
      $obj['id'] = $this->GameId ?? null;
      $obj['status'] = $this->Status ?? null;
      $obj['season'] = $this->Season ?? null;
      $obj['away_team'] = $this->AwayTeam ?? null;
      $obj['home_team'] = $this->HomeTeam ?? null;
      $obj['away_team_id'] = $this->AwayTeamID ?? null;
      $obj['home_team_id'] = $this->HomeTeamID ?? null;
      $obj['away_team_score'] = $this->AwayTeamScore ?? null;
      $obj['home_team_score'] = $this->HomeTeamScore ?? null;
      $obj['updated'] = $this->Updated ?? null;
      $obj['game_end_datetime'] = $this->GameEndDateTime ?? null;
      $obj['datetime'] = $this->DateTime ?? null;
      $data[] = $obj;
    }

    $this->merge($data);
  }
}
