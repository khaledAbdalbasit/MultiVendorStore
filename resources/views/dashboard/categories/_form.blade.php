@if($errors->any())
<div class="alert alert-danger">
    <h3>Error Occured</h3>
    @foreach($errors->all() as $error)
    <ul>
        <li>{{$error}}</li>
    </ul>
    @endforeach
</div>
@endif
<div class="form-group">

    <x-form.input name="name" label="Category Name" class="form-control" role="input" value="{{$category->name}}" />
</div>
<div class="form-group">
    <label for="">Category parent</label>
    <select name="parent_id" class="form-control">
        <option value="">primary Catergory</option>
        @foreach($parents as $parent)
        <option value="{{$parent->id}}" @selected(old('parent_id',$category->parent_id)==$parent->id) >{{$parent->name}}</option>

        @endforeach
        <option value="NULL"></option>
    </select>
</div>

<div class="form-group">
    <label for="">Description</label>
    <x-form.textarea name="description" :value="$category->description" />
</div>

<div class="form-group">
    <x-form.label id="image">Image</x-form.label>
    <x-form.input type="file" name="image" accept="image/*" />
</div>

@if($category->image)
<img src="{{asset('storage/' . $category->image)}}" alt="" height="50">
@endif

<div class="form-group">
    <label for="">Status</label>
    <div>
        <x-form.radio name="status" :checked="$category->status" :options="['active'=>'Active','archived'=>'Archived']" />

    </div>

</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
