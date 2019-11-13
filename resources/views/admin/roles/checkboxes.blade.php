@foreach($roles as $role)
    <div class="checkbox">
        <label>
            <input name="roles[]" type="checkbox" value="{{$role->name}}"
            {{$model->roles->contains($role->id)
              || collect(old('roles'))->contains($role->name)
              ? 'checked' : '' }}>
            {{--{{$user->roles->contains($role->id)? 'checked' : '' }}>--}}
            {{ $role->name }}   <br>
            <small class="text-muted">{{$role->permissions->pluck('name')->implode(', ')}}</small>
        </label>
    </div>
@endforeach