<x-app-layout>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">{{$booking->purpose}}# {{$booking->id}}</h4>
                    <p class="card-description">Cattle Count:<code>{{count_cattle($booking->id)}}</code>
                    </p>
                    {{-- <blockquote class="blockquote">
                      <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    </blockquote> --}}
                  </div>
                  <div class="card-body">
                        @foreach (\App\Models\Cattle::where('booking_id', $booking->id) as $cow)
                            <blockquote class="blockquote blockquote-primary">
                                <p><b>Color: </b>{{$cow->color}}, <b>Breed:</b>{{$cow->breed}}, <b>More: </b>{{$cow->description}}</p>
                                <footer class="blockquote-footer">{{$cow->reference}}</footer>
                            </blockquote>
                        @endforeach
                  </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Slaughtering Details</h4>
                    <p class="card-description"> Date: <code>{{$detail->date}} </code>at <code>{{$detail->time}}</code>  </p>
                    <div class="row">
                        <div class="col-md-6">
                            <address>
                                @php
                                    $abattoir = get_abattoir($booking->abattoir_id);
                                @endphp
                                <p class="font-weight-bold">{{$abattoir->name}}</p>
                                <p>{{$abattoir->address}}</p>
                                <p> {{$abattoir->city}}</p>
                            </address>
                        </div>
                        <div class="col-md-6">
                            <address class="text-primary">
                                <p class="font-weight-bold">Slaughter Room</p>
                                <p class="mb-2"> {{$detail->slughter_room}} </p>
                            </address>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
