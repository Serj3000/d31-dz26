@extends('adminlte.dashboard')

@section('adminpanel')

    <h2>Categories Index (List)</h2>
    <h3>location: "~views/admins/categories/index_category.blade.php (list_category.blade.php)"</h3>
        <nav>
            <a class="btn btn-info btn-sm" href="{{route('categories.index')}}">
                <i class="fas fa-folder"> hillel-31 </i>
            </a>
            <a class="btn btn-info btn-sm" href="{{route('categories.create')}}">
                <i class="fas fa-folder"> Create </i>
            </a>
            <a class="btn btn-info btn-sm" href="{{route('categories.edit', ['category'=>\App\Category::all()->first()])}}">
                <i class="fas fa-folder"> Edit -> Update </i>
            </a>
        </nav>
    <hr>
    <br>
        <div>
            @if(\Session::has('success'))
                <span style="color: green">{{\Session::get('success')}}</span>
            @endif
        </div>
    <br>
{{-- -------------------------------------------------------------------------------------------------------------------------------- --}}
            {{-- <table width="100%" border="1">
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Edit</th>
                        <th>Drop</th>
                        <br>
                    </tr>
                @foreach($categories as $category)
                    <tr>
                        <td width="5%">{{$category->id}}</td>
                        <td width="30%">{{$category->name}}</td>
                        <td width="25%">{{$category->slug}}</td>
                        <td width="12%">{{$category->created_at}}</td>
                        <td width="12%">{{$category->updated_at}}</td>
                        <td width="8%"><a href="{{route('categories.edit', ['category'=>$category->id])}}"> Update </a></td>
                        <td width="8%">
                            <form method="POST" action="{{route('categories.destroy', ['category'=>$category->id])}}">
                                @method('delete')
                                @csrf

                                <input type="submit" value="x">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table> --}}
{{-- -------------------------------------------------------------------------------------------------------------------------------- --}}

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Categories</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects" width="100%">
              <thead>
                  <tr>
                      <th style="width: 2%">
                          #id
                      </th>
                      <th style="width: 25%">
                          Name
                      </th>
                      <th style="width: 15%">
                          Slug
                      </th>
                      <th style="width: 14%">
                          Created
                      </th>
                      <th style="width: 14%">
                          Updated
                      </th>
                      <th style="width: 10%">
                      </th>
                      <th style="width: 10%">
                      </th>
                      <th style="width: 10%">
                      </th>
                  </tr>
              </thead>

              <tbody>

                @foreach($categories as $category)
                    <tr>
                        <td>
                            {{$category->id}}
                        </td>
                        <td>
                            <a>
                                {{$category->name}}
                            </a>
                            <br/>
                            <small>
                                {{$category->created_at}}
                            </small>
                        </td>
                        <td>
                            {{$category->slug}}
                        </td>
                        <td>
                            {{$category->created_at}}
                        </td>
                        <td>
                            {{$category->updated_at}}
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-info btn-sm" href="{{route('categories.index')}}">
                                <i class="fas fa-folder"> Show </i>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{route('categories.edit', ['category'=>$category->id])}}">
                                <i class="fas fa-pencil-alt"> Update </i>
                            </a>
                        </td>
                        <td>
                            <form method="POST" action="{{route('categories.destroy', ['category'=>$category->id])}}">
                                @method('delete')
                                <button class="btn btn-danger btn-sm" type="submit" value="Delete">
                                    <i class="fas fa-pencil-alt"> Delete </i>
                                </button>
                                {{-- <input class="btn btn-danger btn-sm fas fa-pencil-alt" type="submit" value="Delete"> --}}
                                @csrf
                            </form>
                        </td>
                    </tr>
                @endforeach

              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection
