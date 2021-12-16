<?php
// ** Data User logged ** //
     $user = Auth::user();

	  ?>
 {{-- @extends('app')  --}}
  @extends('new_template.layouts.app') 

@section('title') {{ trans('users.account_settings') }} - @endsection

@section('content')
<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h1 class="title-site title-sm">{{ trans('users.account_settings') }}</h1>
      </div>
    </div>

<div class="container margin-bottom-40 account-new-form">

			<!-- Col MD -->
		<div class="col-md-12">

	<div class="wrap-center center-block">
			@if (Session::has('notification'))
			<div class="alert alert-success btn-sm alert-fonts" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            		{{ Session::get('notification') }}
            		</div>
            	@endif

			@include('errors.errors-forms')

			@include('users.navbar-edit')

		<!-- ***** FORM ***** -->
       <form action="{{ url('account') }}" method="post" name="form">

          	<input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">
        	<div class="col-md-6">
	           	<!-- ***** Form Group ***** -->
	            <div class="form-group has-feedback">
	            	<label class="font-default">{{ trans('misc.full_name_misc') }}</label>
	              <input type="text" class="form-control login-field custom-rounded" value="{{ e( $user->name ) }}" name="full_name" placeholder="{{ trans('misc.full_name_misc') }}" title="{{ trans('misc.full_name_misc') }}" autocomplete="off">
	             </div><!-- ***** Form Group ***** -->
           </div><!-- End Col MD-->


            <div class="col-md-6">
            	<!-- ***** Form Group ***** -->
            <div class="form-group has-feedback">
            	<label class="font-default">{{ trans('auth.email') }}</label>
              <input type="email" class="form-control login-field custom-rounded" value="{{$user->email}}" name="email" placeholder="{{ trans('auth.email') }}" title="{{ trans('auth.email') }}" autocomplete="off">
         </div><!-- ***** Form Group ***** -->
            </div><!-- End Col MD-->

        </div><!-- End row -->

			<div class="row">

				<div class="col-md-6">
					<!-- ***** Form Group ***** -->
          <div class="form-group has-feedback">
            <label class="font-default">{{ trans('misc.username_misc') }}</label>
            <input type="text" class="form-control login-field custom-rounded" value="{{$user->username}}" name="username" placeholder="{{ trans('misc.username_misc') }}" title="{{ trans('misc.username_misc') }}" autocomplete="off">
          </div>
          <!-- ***** Form Group ***** -->
				</div><!-- End Col MD-->

				<!--<div class="col-md-6">
          <div class="form-group has-feedback">
            <label class="font-default">{{ trans('misc.country') }}</label>
            <select name="countries_id" class="form-control" >
              <option value="">{{trans('misc.select_your_country')}}</option>
              @foreach(  App\Models\Countries::orderBy('country_name')->get() as $country )
                <option @if( $user->countries_id == $country->id ) selected="selected" @endif value="{{$country->id}}">{{ $country->country_name }}</option>
              @endforeach
            </select>
          </div>
        </div>-->
        <!-- End Col MD-->
        <div class="col-md-6">
					<!-- ***** Form Group ***** -->
          <div class="form-group has-feedback">
            <label class="font-default">{{ 'User Type' }}</label>
            <select name="user_type_id" class="form-control" >
              <option value="">Select User Type (Optional)</option>
              @foreach(  App\Models\Types::orderBy('type_name')->get() as $type )
                <option @if( $user->user_type_id == $type->types_id ) selected="selected" @endif value="{{$type->types_id}}">{{ $type->type_name }}</option>
              @endforeach
            </select>
          </div><!-- ***** Form Group ***** -->
        </div><!-- End Col MD-->
        
        <div class="col-md-12">
					<!-- ***** Form Group ***** -->
          <div class="form-group has-feedback">
            <label class="font-default">{{ '$ Per Hour' }}</label>
            <input type="text" class="form-control" id="perHour" name="perHour" value="{{ $user->per_hour }}" placeholder="{{ '$ Per Hour' }}">
          </div><!-- ***** Form Group ***** -->
        </div><!-- End Col MD-->

      </div><!-- End row -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group has-feedback">
            <label class="font-default">{{ trans('misc.country') }}</label>
            <select name="country_id" id="account_country_id" class="form-control" >
              <option value="">{{trans('misc.select_your_country')}}</option>
              {{-- @foreach(  App\Models\Country::where('is_active','=','1')->orderBy('country_name')->get() as $country ) --}}
              @foreach(  \DB::table('new_countries')->where('is_active','=','1')->orderBy('name')->get() as $country )
                {{-- <!--<option @if( $user->country_id == $country->id ) selected="selected" @endif value="{{$country->id}}">{{ $country->country_name }}</option>--> --}}
                <option @if( $user->country_id == $country->id ) selected="selected" @endif value="{{$country->id}}">{{ $country->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group has-feedback">
            <label class="font-default">{{ trans('misc.city') }}</label>
            <select name="city_id" id="account_city_id" class="form-control" >
              <option value="">{{trans('misc.select_your_city')}}</option>
              {{-- @foreach(  App\Models\Cities::where('is_active','=','1')->where('country_id','=', $user->country_id)->orderBy('city_name')->get() as $city ) --}}
              @foreach(  \DB::table('new_cities')->where('is_active','=','1')->where('country_id','=', $user->country_id)->orderBy('name')->get() as $city )
                {{-- <!--<option @if( $user->city_id == $city->id ) selected="selected" @endif value="{{$city->id}}">{{ $city->city_name }}</option>--> --}}
                <option @if( $user->city_id == $city->id ) selected="selected" @endif value="{{$city->id}}">{{ $city->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div> <?php /*?>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group has-feedback">
            <label class="font-default">{{ trans('misc.route') }}</label>
            <select name="route_id" id="account_route_id" class="js-example-basic-multiple-route form-control" multiple="multiple" data-placeholder="Select Route">
              @foreach(  App\Models\Routes::where('is_active','=','1')->where('city_id','=',$user->city_id)->orderBy('route_name')->get() as $route)
                @php
                  $getUserRoutes = $user->route_id;
                  $convertArray = explode(",",$getUserRoutes);


                @endphp
                <option <?php echo (in_array($route->id, $convertArray)) ? 'selected' : '';?> value="{{$route->id}}">{{ $route->route_name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>    <?php */?>
      <div class="form-group has-feedback">
            <label for="" class="font-default">Address</label>
            <input type="text" class="form-control"  name="Address" id="Address" placeholder=" " value="{{ $user->address }}" />
          </div>

          <div class="form-group has-feedback d-none">
            <label class="font-default" for="product_edit_tags_control">Latitude</label>
            <input type="text" class="form-control"  name="Lat" id="Lat" readonly value="{{ $user->lat }}" />
          </div>
          <div class="form-group has-feedback d-none">
            <label class="font-default" for="product_edit_tags_control">Longitude</label>
            <input type="text" class="form-control"  name="Long" id="Long" readonly value="{{ $user->lng }}" />
          </div>

			<!-- ***** Form Group ***** -->
            <div class="form-group has-feedback">
            	<label class="font-default">{{ trans('admin.paypal_account') }}</label>
              <input type="email" class="form-control login-field custom-rounded" value="{{$user->paypal_account}}" name="paypal_account" placeholder="{{ trans('admin.paypal_account') }}" title="{{ trans('admin.paypal_account') }}" autocomplete="off">
         </div><!-- ***** Form Group ***** -->

         <!-- ***** Form Group ***** -->
            <div class="form-group has-feedback">
            	<label class="font-default">{{ trans('misc.website_misc') }}</label>
              <input type="text" class="form-control login-field custom-rounded" value="{{$user->website}}" name="website" placeholder="{{ trans('misc.website_misc') }}" title="{{ trans('misc.website_misc') }}" autocomplete="off">
         </div><!-- ***** Form Group ***** -->

         <!-- ***** Form Group ***** -->
            <div class="form-group has-feedback">
            	<label class="font-default">Facebook</label>
              <input type="text" class="form-control login-field custom-rounded" value="{{$user->facebook}}" name="facebook" placeholder="https://www.facebook.com/username" title="https://www.facebook.com/Username" autocomplete="off">
         </div><!-- ***** Form Group ***** -->

         <!-- ***** Form Group ***** -->
            <div class="form-group has-feedback">
            	<label class="font-default">Twitter</label>
              <input type="text" class="form-control login-field custom-rounded" value="{{$user->twitter}}" name="twitter" placeholder="https://www.twitter.com/username" title="https://www.twitter.com/Username" autocomplete="off">
         </div><!-- ***** Form Group ***** -->

         <!-- ***** Form Group ***** -->
            <div class="form-group has-feedback">
            	<label class="font-default">Instagram</label>
              <input type="text" class="form-control login-field custom-rounded" value="{{$user->instagram}}" name="instagram" placeholder="https://instagram.com/username" title="https://instagram.com/username" autocomplete="off">
         </div><!-- ***** Form Group ***** -->

         <!-- ***** Form Group ***** -->
         <div class="form-group has-feedback">
            	<label class="font-default">Languages Speak</label>
              <input type="text" class="form-control login-field custom-rounded" value="{{$user->langauges_speak}}" name="langauges_speak" placeholder="English and some Spanish" autocomplete="off">
         </div><!-- ***** Form Group ***** -->

         <!-- ***** Form Group ***** -->
         <div class="form-group has-feedback">
            	<label class="font-default">Favourite Place to Shoot</label>
              <input type="text" class="form-control login-field custom-rounded" value="{{$user->fvt_place_to_shoot}}" name="fvt_place_to_shoot" placeholder="Grand Teton National Park " autocomplete="off">
         </div><!-- ***** Form Group ***** -->

         <!-- ***** Form Group ***** -->
         <div class="form-group has-feedback d-none">
            	<label class="font-default">Three Things</label>
              <input type="text" style="margin-bottom: 10px;" class="form-control login-field custom-rounded" value="{{$user->first_thing}}" name="first_thing" placeholder="First Thing" autocomplete="off">
              <input type="text" style="margin-bottom: 10px;" class="form-control login-field custom-rounded" value="{{$user->second_thing}}" name="second_thing" placeholder="Second Thing" autocomplete="off">
              <input type="text" style="margin-bottom: 10px;" class="form-control login-field custom-rounded" value="{{$user->third_thing}}" name="third_thing" placeholder="Third Thing" autocomplete="off">
         </div><!-- ***** Form Group ***** -->

          <div class="form-group has-feedback" id="map">
          </div>

         <!-- ***** Form Group ***** -->
            <div class="form-group has-feedback">
            	<label class="font-default">{{ trans('misc.description') }}</label>
            	<textarea name="description" rows="4" id="bio" class="form-control login-field custom-rounded">{{ e( $user->bio ) }}</textarea>
         </div><!-- ***** Form Group ***** -->


           <button type="submit" id="buttonSubmit" class="btn btn-block btn-lg btn-main custom-rounded">{{ trans('misc.save_changes') }}</button>

         @if( $user->id != 1 )
           <div class="btn-block text-center margin-top-20">
           		<a href="{{url('account/delete')}}" class="text-danger">{{trans('users.delete_account')}}</a>
           </div>
           @endif

       </form><!-- ***** END FORM ***** -->

</div><!-- wrap center -->

		</div><!-- /COL MD -->


 </div><!-- container -->

 <!-- container wrap-ui -->
<script>
  function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 37.4419,
                lng: -122.1419
            },
            zoom: 3
        });
        var input = document.getElementById('Address');
        var option = {
            componentRestrictions: {
                country: "usa"
            }
        }
        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.controls.push(input);

        var autocomplete = new google.maps.places.Autocomplete(input, option);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();

            /* If the place has a geometry, then present it on a map. */
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);
            window.address = place.formatted_address;
            console.log('address', place.formatted_address);
            var lat = place.geometry.location.lat();
            var long = place.geometry.location.lng();
            var latlng;
            latlng = new google.maps.LatLng(lat, long);

            var addressData = new google.maps.Geocoder().geocode({
                'latLng': latlng
            }, function(results, status) {
                var city = results[0].address_components[2].long_name;
                var state = results[0].address_components[5].long_name;
                var country = results[0].address_components[6].long_name;
                var zip = results[0].address_components[7].long_name;

                console.log('results', results);

                // document.getElementById('Country').value = country;
                // document.getElementById('State').value = state;
                // document.getElementById('City').value = city;
                // document.getElementById('Zip').value = zip;
                // $("#Country").focus();
                // $("#State").focus();
                // $("#City").focus();
                // $("#Zip").focus();
            });
            /* Location details */
            document.getElementById('Address').value = place.formatted_address;
            document.getElementById('Lat').value = place.geometry.location.lat();
            document.getElementById('Long').value = place.geometry.location.lng();
            // $("#Lat").focus();
            // $("#Long").focus();
        });
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyApZJShZfKfEazTmLxo7x9xXutaR-3RVhE&callback=initMap" async defer></script>
<script>
    // $(document).ready(function(){
        
		
		
    // });
    
    
</script>
@endsection
