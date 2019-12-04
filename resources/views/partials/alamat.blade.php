<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="address_address">Koordinat</label>
            <input type="text" id="address-input" name="address_address" class="form-control map-input">
            <input hidden type="text" name="address_latitude" id="address-latitude" value="0" />
            <input hidden type="text" name="address_longitude" id="address-longitude" value="0" />
            <div id="address-map-container" style="width:100%;height:400px; ">
                <div style="width: 100%; height: 100%" id="address-map"></div>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <label>Alamat <span class="text-danger">*</span></label>
    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="nama jalan" rows="1">{{ Request::segment(1)=='edit' ? old('alamat', $withdata['alamat'])  : old('alamat') }}</textarea>
    @error('alamat')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Latitude</label>
            <input type="text" class="form-control @error('latitude') is-invalid @enderror" placeholder="" name="latitude" id="latitude" value="{{ Request::segment(1)=='edit' ? old('latitude', $withdata['latitude']) : old('latitude') }}">
        </div>
        @error('latitude')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Longitude</label>
            <input type="text" class="form-control @error('longitude') is-invalid @enderror" placeholder="" name="longitude" id="longitude" value="{{ Request::segment(1)=='edit' ? old('longitude', $withdata['longitude']) : old('longitude') }}">
        </div>
        @error('longitude')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
            <select class="form-control @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi">
                <option value="">- Pilih -</option>
                @foreach ($provinsi as $item)
                    <option value="{{ $item->id }}" {{ Request::segment(1)=='edit' ? $item->id == $properti->id_provinsi ? 'selected' : '' : old('provinsi') == $item->id ? 'selected' : '' }}>{{ $item->text }}</option>
                @endforeach
            </select>
            @error('provinsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="kota">Kota/Kabupaten <span class="text-danger">*</span></label>
            <select class="form-control @error('kota') is-invalid @enderror" id="kota" name="kota">
                <option value="">- Pilih -</option>
                @if(Request::segment(1) ==  'edit' )
                    @foreach($kota as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $withdata['id_kota'] ? 'selected' : '' }}>{{ $item->text }}</option>
                    @endforeach
                @endif
            </select>
            @error('kota')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
            <select class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan">
                <option value="">- Pilih -</option>
                @if(Request::segment(1) ==  'edit' )
                    @foreach($kecamatan as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $withdata['id_kecamatan'] ? 'selected' : '' }}>{{ $item->text }}</option>
                    @endforeach
                @endif
            </select>
            @error('kecamatan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="kelurahan">Kelurahan/Desa <span class="text-danger">*</span></label>
            <select class="form-control @error('kecamatan') is-invalid @enderror" id="kelurahan" name="kelurahan">
                <option value="">- Pilih -</option>
                @if(Request::segment(1) ==  'edit' )
                    @foreach($kelurahan as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $withdata['id_kelurahan'] ? 'selected' : '' }}>{{ $item->text }}</option>
                    @endforeach
                @endif
            </select>
            @error('kelurahan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Kode Pos</label>
            <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" placeholder="" name="kode_pos" value="{{ Request::segment(1)=='edit' ? old('kode_pos', $withdata['kode_pos']) : old('kode_pos') }}">
        </div>
        @error('kode_pos')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-lg-6">
    </div>
</div>

@section('footer_script')
    @parent
    <script src="https://maps.googleapis.com/maps/api/js?key={{ $apikey }}&libraries=places&callback=initialize" async defer></script>
    <script>
        function initialize() {

            $('form').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });

            const locationInputs = document.getElementsByClassName("map-input");

            const autocompletes = [];
            const geocoder = new google.maps.Geocoder;  

            for (let i = 0; i < locationInputs.length; i++) {

                const input = locationInputs[i];
                const fieldKey = input.id.replace("-input", "");
                const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';

                const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || 0;
                const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 0;

                const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                    center: {lat: latitude, lng: longitude},
                    zoom: 13
                });
                const marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
                    position: {lat: latitude, lng: longitude},
                    animation: google.maps.Animation.DROP,
                });

                markerCoords(marker);
                marker.setVisible(isEdit);

                const autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.key = fieldKey;
                autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});
            }

            for (let i = 0; i < autocompletes.length; i++) {
                const input = autocompletes[i].input;
                const autocomplete = autocompletes[i].autocomplete;
                const map = autocompletes[i].map;
                const marker = autocompletes[i].marker;

                google.maps.event.addListener(autocomplete, 'place_changed', function () {
                    marker.setVisible(false);
                    const place = autocomplete.getPlace();

                    geocoder.geocode({'placeId': place.place_id}, function (results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            const lat = results[0].geometry.location.lat();
                            const lng = results[0].geometry.location.lng();
                            setLocationCoordinates(autocomplete.key, lat, lng);
                        }
                    });

                    if (!place.geometry) {
                        window.alert("No details available for input: '" + place.name + "'");
                        input.value = "";
                        return;
                    }

                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }
                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);
                });
                
            }
        }

        function setLocationCoordinates(key, lat, lng) {
            const latitudeField = document.getElementById(key + "-" + "latitude");
            const longitudeField = document.getElementById(key + "-" + "longitude");
            latitudeField.value = lat;
            longitudeField.value = lng;
            $('#latitude').val(lat);
            $('#longitude').val(lng);
        }

        function markerCoords(marker){
            google.maps.event.addListener(marker, 'dragend', function(evt){
                // infoWindow.setOptions({
                //     content: '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>'
                // });
                // infoWindow.open(map, markerobject);
                $('#address-latitude, #latitude').val(evt.latLng.lat());
                $('#address-longitude, #longitude').val(evt.latLng.lng());
            });

        }

    </script>
@stop