@extends('layouts.default')

@section('title', 'Dashboard')

@section('styles') 
@endsection

@section('content')

<div class="row top_tiles">  
          <a href="{{ route('role.index') }}">
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa fa-shopping-cart"></i></div>
                  <div class="count">&nbsp;</div>
                  <h3>Role</h3>
                </div>
              </div>
            
        </a>
      
</div>
          
@endsection
@section('js')    
@endsection