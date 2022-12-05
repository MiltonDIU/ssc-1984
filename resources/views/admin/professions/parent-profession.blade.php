@foreach(\App\Models\Profession::parentProfession($id) as $id2 => $item)
    @if($user==null)
        <option value="{{ $id2 }}" {{ in_array($id2, old('professions', [])) ? 'selected' : '' }}>{{ $item.'  -  '.$profession }}</option>
    @else
        <option value="{{ $id2 }}" {{ (in_array($id2, old('professions', [])) || $user->professions->contains($id2)) ? 'selected' : '' }}>{{ $item .'  -  '.$profession }}</option>
    @endif
@endforeach
