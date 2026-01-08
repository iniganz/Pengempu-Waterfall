 @extends('admin.layout.index')

 @section('content')
     <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3 Maindiv" id="">
        <h1 class="h2 ">Welcome Back, {{ auth()->user()->name }}</h1>
     </div>
 @endsection

