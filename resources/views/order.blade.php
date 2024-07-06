@extends('Layout.app')
@push('title')
    <title>Orders</title>
@endpush

@section('body')
    {{-- Adding the External Script  --}}
    <script type="text/javascript" src="{{ asset('js/wishlist.js') }}"></script>

    @if (session('message'))
        <p id="message_data" class="text-center mt-5 mb-5 text-blue-500 font-semibold p-2 m-2 rounded-xl bg-blue-100">
            {{ session('message') }}
        </p>
    @endif

    <div class="p-2 mt-10 mb-10">
        <div class="mt-5">
            <h1 class="font-bold text-xl">Orders</h1>
            @forelse ($orders as $value)
                <div class="bg-slate-100 rounded-xl p-2 m-4">
                    <p>Total Amount : ₹{{ $value->total_amount }}</p>
                    <p>Payment Mode : {{ $value->payment_mode }}</p>
                    <p>Order Status : {{ $value->order_status }}</p>
                    <p> Payment Status : {{ $value->payment_status }}</p>
                    @php
                        $OrderDate = substr($value->created_at, 0, 10);
                        // echo "<p>Order Date : $date</p>";
                    @endphp
                    <p>Order Date : {{ get_format_date($OrderDate, 'd-M-Y') }}</p>

                    <form action="{{ url('/order/cancel/' . $value->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="text-sm cursor-pointer bg-red-500 text-white font-medium p-1 rounded-lg"
                            value="Cancel Order">
                    </form>

                </div>
            @empty
                <p class="font-semibold text-slate-500">No Orders Found!!</p>
            @endforelse
        </div>
    </div>

    {{-- <script>
        const message = document.getElementById('message_data');
        console.log(message);
        setTimeout(() => {
            message.style.display = 'none';
        }, 3000);
    </script> --}}
@endsection
